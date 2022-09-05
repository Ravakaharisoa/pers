<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use App\Models\Evenement;
use App\Models\Devise;
use App\Models\Entreprise;
use App\Models\Genre;
use App\Models\Permis;
use App\Models\RelationEmpPermis;
use App\Models\Nationalite;
use App\Models\ContactUrgence;
use App\Models\StatutMatrimoniale;
use App\Models\PersRelation;
use App\Models\Responsable;
use App\Models\PersonneACharge;
use App\Models\Disciplinaire;
use App\Models\Allergie;
use App\Models\Salaire;
use App\Models\Sanction;
use App\Models\Contrat;
use App\Models\CategorieEmploi;
use App\Models\GroupeEmploi;
use App\Models\HistoriqueFonction;
use App\Models\HistoriqueSalaire;
use App\Models\HitoriqueFonction;
use App\Models\StatutEmploi;
use App\Models\TypeContrat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use DateTime;

class DetailEmployeController extends Controller
{
    public function __construct()
    {

        $this->middleware(['auth']);
        $this->middleware(function ($request, $next) {
            if (Auth::user()->exists == false) return redirect()->route('sign-in');
            return $next($request);
        });
    }

    public function getDetailEmploye($id)
    {
        $user_id = Auth::user()->id;
        if (Gate::allows('isReferent')) {
            $etp_id = Responsable::where('user_id', $user_id)->value('entreprise_id');
            $referent_id = $id;
            $date = new DateTime();
            $date = date($date->format('Y')-21). '-' . date($date->format('m')) . '-' . date($date->format('d'));
            $id_pers_a_charge = DB::select('SELECT id FROM pers_personne_a_charges WHERE date_naissance<=?', [$date]);
            for ($i=0; $i < count($id_pers_a_charge); $i++) {
                DB::update('UPDATE pers_contact_urgences SET  pers_a_charge_id=null
                WHERE pers_a_charge_id=?', [$id_pers_a_charge[$i]->id]);
            }
            DB::table('pers_personne_a_charges')->where('employer_id', $referent_id)->where('date_naissance', '<=', $date)->delete();
            $data = [
                "employer_id" => $referent_id,
                "genres" => Genre::all(),
                "statutMatris" => StatutMatrimoniale::all(),
                "pers_relations" => PersRelation::all(),
                "all_categ_permis" => Permis::all(),
                "date_mariage" => Employer::where('id',$referent_id)->value('date_mariage'),
                "contact" => collect(DB::select('select nationalite_stagiaire, region, ville,
                quartier, code_postal, lot, telephone_stagiaire, mail_stagiaire from v_employe where id = ?',
                    [$referent_id]
                ))->first(),
                "nationalites" => Nationalite::all(),
                "emp_all_permis" => DB::select('SELECT DISTINCT permis_id
                FROM relation_emp_permis WHERE employer_id = ?
                ', [$referent_id]),
                "pers_a_charges" => DB::select('select id, nom,prenom, date_naissance, YEAR(date_naissance) as year, relation_id, contact_urgence, created_at, updated_at from pers_personne_a_charges where employer_id = ?',
                    [$referent_id]
                ),
                "identite" => collect(DB::select('select num_permis, passport, num_cnaps, num_ostie
                from employers where id = ?', [$referent_id]))->first(),
                "contact_urgences" => DB::select(
                    'select id, nom, prenom,
                relation_id, tel_fixe, tel_mobile, tel_travail, pers_a_charge_id from pers_contact_urgences where employer_id = ?',
                    [$referent_id]
                ),
                "stagiaire" => collect(DB::select('select id, entreprise_id, matricule,photos, nom_stagiaire,
                prenom_stagiaire, genre_id, nationalite_id, status_matri_id, date_naissance,
                cin from v_employe where entreprise_id = ? AND id= ?', [$etp_id, $referent_id]))->first(),
                "materiels" => DB::select('select id,nom_emp,prenom_emp,code ,description,lien_image,num_serie,date,date_fin from v_materiels where employer_id=? order by date_fin asc, date desc', [$referent_id]),
                "type_materiels" => DB::select('select id,description from pers_type_materiels')

            ];
            return view('employers.details_employers.informations')->with($data);
        }
    }
    public function ajoutMateriel(Request $req){
        $user_id = Auth::user()->id;
        if (Gate::allows('isReferent')) {
            $materiel = DB::insert('insert into pers_materiels (employer_id,description_id,num_serie,date) values (?,?,?,?)', [$req->employer_id,$req->materiel,$req->num_serie,$req->date_recup]);
            return back();
        }
    }
    public function rendreMateriel($id){
        $user_id = Auth::user()->id;
        if (Gate::allows('isReferent')) {
            $date_now=date('Y-m-d');
            $materiel =DB::table('pers_materiels')->where('id',$id)->update(["date_fin"=>$date_now]);
            return back();
        }
    }

    public function getDetailEmplois($id)
    {

        $user_id = Auth::user()->id;

        if (Gate::allows('isReferent')) {

            $etp_id = Responsable::where('user_id', $user_id)->value('entreprise_id');
            $secteur_id = Entreprise::where('id', $etp_id)->value('secteur_id');
            $old_fonct = collect(DB::select('select fonction_id,fonction_stagiaire,categorie_emploi_id,categorie_emploi_stagiaire,statut_emploi_id,
            statut_emploi_stagiaire,service_id,nom_service,branche_id,departement_entreprises_id,nom_departement,branche_id,nom_branche from v_employe where id = ?', [$id]))->first();
            $contrats = DB::table('pers_contrats')->where('employer_id', $id)->latest()->first();
            $old_fonct = collect(DB::select('select fonction_id,fonction_stagiaire,categorie_emploi_id,categorie_emploi_stagiaire,statut_emploi_id,
            statut_emploi_stagiaire,service_id,nom_service,branche_id,departement_entreprises_id,nom_departement,branche_id,nom_branche,groupe_emploi_id,
            groupe_emploi from v_employe where id = ?', [$id]))->first();
            $demission = DB::table('pers_demissions')->where('employer_id', $id)->latest()->first();
            $data = [
                "employer_id" => $id,
                "old_fonct" => $old_fonct,
                "demission" => $demission,
                "statut_emplois" => StatutEmploi::all(),
                "catg_emplois" => CategorieEmploi::all(),
                "departements" => DB::select('select id,nom_departement,entreprise_id from departement_entreprises where entreprise_id = ?', [$etp_id]),
                "events" => Evenement::all(),
                "services" => DB::select('select id,nom_service,entreprise_id from services where entreprise_id = ?', [$etp_id]),
                "devises" => Devise::all(),
                "contrat" => $contrats,
                "types_contrat" => TypeContrat::all(),
                "branches" => DB::select('select id,entreprise_id,nom_branche	from branches where entreprise_id = ?', [$etp_id]),
                "fonctions" => DB::select('select id,nom_fonction from fonctions where secteur_id = ?', [$secteur_id]),
                "histo_emplois" => DB::select('select histo_emploi_id,ancien_fonction,new_fonct,evenement,date_changement_fonction from v_historique_emploi where employer_id = ?', [$id])
            ];
            return view('employers.details_employers.details_emplois')->with($data);
        }
    }

    public function getDetailSalaires($id)
    {
        $user_id = Auth::user()->id;
        if (Gate::allows('isReferent')) {
            $etp_id = Responsable::where('user_id', $user_id)->value('entreprise_id');
            $employe_id = $id;
            $old_salaire = collect(DB::select('select employer_id,montant,devise_id from pers_salaire_bases where employer_id =?', [$employe_id]))->first();
            $salaires = DB::select('select employer_id,id,ancien_montant,nouveau_montant,date_modification,
                devise,evenement,valeur_pourcent,description from v_historique_salaire  where employer_id = ?', [$employe_id]);
            $primes = DB::table('paie_prime_indemnites')->distinct()->get();
            $avantage_nature = DB::select('select employer_id,montant,devise,designation from v_pers_avantage_nature  where employer_id = ?', [$employe_id]);
            $primes_employe = DB::select('select employer_id,montant,devise,nom_prime from v_pers_prime_indemnite where employer_id=? ', [$employe_id]);
            $avantages = DB::table('paie_avantage_en_natures')->distinct()->get();
            if ($old_salaire) {
                $montant = $old_salaire;
            } else {
                $montant = null;
            }

            if ($salaires) {
                $salaire = $salaires;
            } else {
                $salaire = null;
            }
            $data = [
                "employer_id" => $employe_id,
                "primes_employe" => $primes_employe,
                "avantage_natures" => $avantage_nature,
                "events" => Evenement::all(),
                "primes" => $primes,
                "avantages" => $avantages,
                "devises" => Devise::all(),
                "anc_salaire" => $montant,
                "salaires" => $salaires
            ];
            return view('employers.details_employers.details_salaires')->with($data);
        }
    }

    public function getDetailSanction($id)
    {
        $user_id = Auth::user()->id;
        if (Gate::allows('isReferent')) {
            $etp_id = Employer::where('user_id', $user_id)->where('prioriter', 1)->value('entreprise_id');
            $employe_id = $id;
            $sanctions = DB::select('select id,nom_saction from pers_sanctions');
            $mes_dis = DB::select('select id,nom_discipline from pers_mesure_disciplinaires');
            $mes_admin = DB::select('select id, descriptions from pers_mesure_administratives');
            $encours = 0;
            $supprimer = 1;

            $date_deb = DB::select('select id,date_sanction,duree_sanction from pers_historique_sanctions where employer_id=? and supprimer=?', [$employe_id, $encours]);

            foreach ($date_deb as  $d_d) {
                $diff = $d_d->duree_sanction;
                $date_now = (DB::select(' SELECT CAST(NOW() AS DATE) as dt'));
                $date_fin = date('Y-m-d', strtotime($d_d->date_sanction . ' + ' . $diff . ' day'));
                $id = $d_d->id;
                if ($date_fin <= $date_now[0]->dt) {
                    DB::table('pers_historique_sanctions')->where('id', $id)->update(["supprimer" => 1]);
                }
            }
            $data = [

                "mes_admin" => $mes_admin,
                "mes_dis" => $mes_dis,
                "sanctions" => $sanctions,
                "employer_id" => $employe_id,
                "histo_sanctions" => DB::select('select id,employer_id,type,nom_emp,prenom_emp,admin_id,description,discipline_id,discipline,sanction_id,nom_saction,date_sanction,duree_sanction,supprimer,statut from v_historique_sanctions where employer_id=? and supprimer=? order by date_sanction desc', [$employe_id, $encours]),
                "histo_sanctions2" => DB::select('select id,employer_id,type,nom_emp,prenom_emp,admin_id,description,discipline_id,discipline,sanction_id,nom_saction,date_sanction,duree_sanction,supprimer,statut from v_historique_sanctions where employer_id=? and supprimer=? order by date_sanction desc', [$employe_id, $supprimer])

            ];

            return view('responsable.sanction.detail_sanctions')->with($data);
        }
    }
    public function ajoutSanction(Request $req)
    {
        $user_id = Auth::user()->id;

        if (Gate::allows('isReferent')) {

            $duree = $req->duree_sanction;
            $unite = $req->unite;
            if ($unite == 2) {
                $duree_en_jours = $duree * 30;
            } else if ($unite == 3) {
                $duree_en_jours = $duree * 365;
            } else if ($unite == 4) {
                $duree_en_jours = $duree * 7;
            } else {
                $duree_en_jours = $duree * 1;
            }


            // // if(!($req->description_disc)->isEmpty())
            $sanction = DB::insert('insert into pers_historique_sanctions (employer_id,type,description_id,discipline_id,sanction_id,date_sanction,duree_sanction) values (?,?,?,?,?,?,?)', [$req->employer_id, $req->mesure, $req->description_admin, $req->description_disc, $req->sanction, $req->date_sanction, $duree_en_jours]);
            return back();
        }
    }
    public function changeSupprimer($id)
    {
        $user_id = Auth::user()->id;

        if (Gate::allows('isReferent')) {

            $sanction = DB::table('pers_historique_sanctions')->where('id', $id)->update(["supprimer" => 1]);
            return back();
        }
    }
    public function modifierSanction(Request $req)
    {
        $user_id = Auth::user()->id;



        if (Gate::allows('isReferent')) {
            // duree en jours//
            $duree = $req->duree_sanction2;
            $unite = $req->unite2;
            if ($unite == 2) {
                $duree_en_jours = $duree * 30;
            } else if ($unite == 3) {
                $duree_en_jours = $duree * 365;
            } else if ($unite == 4) {
                $duree_en_jours = $duree * 7;
            } else {
                $duree_en_jours = $duree * 1;
            }
            //
            $id = $req->id2;
            $type = $req->mesure2;
            $description = $req->description_admin2;
            $discipline = $req->description_disc2;
            $sanction = $req->sanction2;
            $date = $req->date_sanction2;



            $res = DB::table('pers_historique_sanctions')->where('id', $id)->update(
                [
                    "type" => $type,
                    "description_id" => $description,
                    "discipline_id" => $discipline,
                    "sanction_id" =>  $sanction,
                    "date_sanction" => $date,
                    "duree_sanction" => $duree_en_jours
                ]
            );
            return back();
        }
    }
    public function restaurerSanction($id)
    {
        $user_id = Auth::user()->id;

        if (Gate::allows('isReferent')) {

            $sanction_restaure = DB::table('pers_historique_sanctions')->where('id', $id)->update(["supprimer" => 0]);
            return back();
        }
    }
}
