<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use App\Models\Disciplinaire;
use App\Models\Allergie;
use App\Models\Evenement;
use App\Models\Devise;
use App\Models\Entreprise;
use App\Models\Salaire;
use App\Models\Sanction;
use App\Models\Genre;
use App\Models\CategorieEmploi;
use App\Models\Contrat;
use App\Models\Nationalite;
use App\Models\ChefDepartement;
use App\Models\ContactUrgence;
use App\Models\Fonction;
use App\Models\GroupeEmploi;
use App\Models\HistoriqueFonction;
use App\Models\StatutMatrimoniale;
use App\Models\HistoriqueSalaire;
use App\Models\ListeEmploye;
use App\Models\PersonneACharge;
use App\Models\Responsable;
use App\Models\StatutEmploi;
use App\Models\TypeContrat;
use App\Models\Demission;
use App\Models\PrimeEtIndemnite;
use App\Models\AvantageEnNature;
use Exception;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{
    public function insertformprime_indemnite()
    {
        return view('detail_salarie');
    }

    public function insertprime_indemnite(Request $request)
    {
        $employer_id = $request->employer_id;
        $prime = $request->primes;
        $montant_prime = $request->montant_prime;
        $devise_prime = $request->devise_prime;
        DB::insert(
            'insert into pers_prime_indemnites (employer_id,prime_indemnite_id,montant,devise_id,created_at,updated_at) values (?, ?,?,?,?,?)',
            [$employer_id, $prime, $montant_prime, $devise_prime, NOW(), NOW()]
        );

        return response()->json(['success' => "Prime enregistrée avec succès!"]);
    }
    public function insertformAvantageEnNature()
    {
        return view('detail_salarie');
    }

    public function insertAvantageEnNature(Request $request)
    {
        $employer_id_avantage = $request->employer_id_Avantage;
        $Avantage_en_nature = $request->Avantage_en_nature;
        $montant = $request->montant;
        $devise = $request->devise;
        // $data = array('employer_id' => $employer_id, 'avantage_nature_id' => $Avantage_en_nature, 'montant' => $montant, 'devise_id' => $devise, 'created_at' => NOW(), 'updated_at' => NOW());
        // DB::table('pers_avantage_en_nature')->insert($data);
        DB::insert(
            'insert into pers_avantage_en_nature (employer_id,avantage_nature_id, montant,devise_id,created_at,updated_at) values (?, ?,?,?,?,?)',
            [$employer_id_avantage, $Avantage_en_nature, $montant, $devise, NOW(), NOW()]
        );
        return response()->json(['success' => "Avantage en nature enregistrée avec succès!"]);
    }
    public function insertform()
    {
        return view('detail_salarie');
    }

    public function insert(Request $request)
    {
        $employer_id = $request->input("employer_id");
        $prime = $request->input('primes');
        $montant_prime = $request->input('montant_prime');
        $devise_prime = $request->input('devise_prime');
        $data = array('employer_id' => $employer_id, "prime_indemnite_id" => $prime, "montant" => $montant_prime, "devise_id" => $devise_prime);
        DB::table('pers_prime_indemnites')->insert($data);
        echo "Record inserted successfully.<br/>";
    }
    public function __construct()
    {

        $this->middleware(['auth']);
        $this->middleware(function ($request, $next) {
            if (Auth::user()->exists == false) return redirect()->route('sign-in');
            return $next($request);
        });
    }

    public function index()
    {
        $user_id = Auth::user()->id;
        $etp_id = Responsable::where('user_id',$user_id)->value('entreprise_id');
        if (Gate::allows('isReferent')) {

        $jours=15;
        $date_now=(DB::select(' SELECT CAST(NOW() AS DATE) as dt'));
        $date_notif_fin=date('Y-m-d', strtotime($date_now[0]->dt.' + '.$jours.' day'));
        $contrats=DB::select('select id,reference from pers_type_contrats');
        $types=[];
        foreach($contrats as $contrat){
            $types[]=DB::select('select count(*) as '.$contrat->reference.' from pers_contrats where type_contrat_id=?',[$contrat->id]);
        }
        $cmpt = 0;
        $str = "";
        $value="";
        while (current($types)) {
            $tmp =  key($types[$cmpt][0]);

            $str .= key($types[$cmpt][0]).",";
            $value .= $types[$cmpt][0]->$tmp.",";
            next($types);
            $cmpt++;
        }
        //Récupération des départements
        $departements=DB::select('select id, nom_departement from departement_entreprises');
        $types_departements=[];
        foreach($departements as $departement){
            $types_departements[]=DB::select('select count(*) as "'.$departement->nom_departement.'" from v_employe where departement_entreprises_id=?',[$departement->id]);
        }

        $compteur=0;
        $string="";
        $valeur="";
        while (current($types_departements)) {
            $tempo =  key($types_departements[$compteur][0]);

            $string .= key($types_departements[$compteur][0]).",";
            $valeur .= $types_departements[$compteur][0]->$tempo.",";
            next($types_departements);
            $compteur++;
        }

        $data=[
            "str"=>$str,
            "value"=>$value,
            "types"=>$types,
            "string"=>$string,
            "valeur"=>$valeur,
            "types_departements"=>$types_departements,
            "date_now"=>$date_now,
            "employers"=>DB::select('select * from employers where entreprise_id=?',[$etp_id]),
            "femme"=>DB::select('select count(*) as nbr from employers where genre_id=? and entreprise_id=?',[1,$etp_id]),
            "homme"=>DB::select('select count(*) as nbr from employers where genre_id=? and entreprise_id=?',[2,$etp_id]),
            "fin_contrat"=>DB::select('select * from pers_contrats where date_fin between ? and ?',[$date_now[0]->dt,$date_notif_fin])

        ];


            $jours=15;
            $date_now=(DB::select(' SELECT CAST(NOW() AS DATE) as dt'));
            $date_notif_fin=date('Y-m-d', strtotime($date_now[0]->dt.' + '.$jours.' day'));
            $contrats=DB::select('select id,reference from pers_type_contrats');
            $types=[];

            // Nombre de nouveau employers
            $current_month = Carbon::now()->month;
            $nb_new_employer = collect(DB::select('select count(id) as new_employers from employers where entreprise_id = ? and MONTH(created_at) = ? ',[ $etp_id ,$current_month]))->first();

            //Nombre des employés démisionnés
            $current_year = Carbon::now()->year;
            $nb_employer_demissionne = collect(DB::select('select count(id) as new_employers from employers where entreprise_id = ? and YEAR(created_at) = ? ',[ $etp_id ,$current_year]))->first();

            foreach($contrats as $contrat){
                $types[]=DB::select('select count(*) as '.$contrat->reference.' from pers_contrats where type_contrat_id=?',[$contrat->id]);
            }

            $cmpt = 0;
            $str = "";
            $value="";
            while (current($types)) {
                $tmp =  key($types[$cmpt][0]);

                $str .= key($types[$cmpt][0]).",";
                $value .= $types[$cmpt][0]->$tmp.",";
                next($types);
                $cmpt++;
            }

            //Récupération des départements
            $departements=DB::select('select id, nom_departement from departement_entreprises');
            $types_departements=[];
            foreach($departements as $departement){
                $types_departements[]=DB::select('select count(*) as "'.$departement->nom_departement.'" from v_employe where departement_entreprises_id=?',[$departement->id]);
            }

            $compteur=0;
            $string="";
            $valeur="";

            while (current($types_departements)) {
                $tempo =  key($types_departements[$compteur][0]);

                $string .= key($types_departements[$compteur][0]).",";
                $valeur .= $types_departements[$compteur][0]->$tempo.",";
                next($types_departements);
                $compteur++;
            }

            $data=[
                "str"=>$str,
                "value"=>$value,
                "types"=>$types,
                "string"=>$string,
                "valeur"=>$valeur,
                "types_departements"=>$types_departements,
                "date_now"=>$date_now,
                "employers"=>DB::select('select * from employers where entreprise_id=?',[$etp_id]),
                "femme"=>DB::select('select count(*) as nbr from employers where genre_id=? and entreprise_id=?',[1,$etp_id]),
                "homme"=>DB::select('select count(*) as nbr from employers where genre_id=? and entreprise_id=?',[2,$etp_id]),
                "fin_contrat"=>DB::select('select * from pers_contrats where date_fin between ? and ?',[$date_now[0]->dt,$date_notif_fin])

            ];


            return view('responsable.dasboard.home')->with($data);
        }
    }

    public function liste_employe()
    {
        $user_id = Auth::user()->id;
        if (Gate::allows('isReferent')) {

            $etp_id = Responsable::where('user_id', $user_id)->value('entreprise_id');
            $employers = DB::select('select id,entreprise_id,matricule,nom_stagiaire,prenom_stagiaire,mail_stagiaire,
            telephone_stagiaire,nom_service,nom_departement,photos,fonction_stagiaire,activiter from v_employe where entreprise_id = ?', [$etp_id]);
            $secteur_id = Entreprise::where('id',$etp_id)->value('secteur_id');
            $demissions = DB::select('select matricule,nom_stagiaire,prenom_stagiaire,genre_stagiaire,fonction_stagiaire,mail_stagiaire,telephone_stagiaire,photos,nom_departement,nom_service,activiter,date_demission,ancien_entreprise from v_liste_employe_demissioner where ancien_entreprise = ?', [$etp_id]);
            $data = [
                "employers"=>$employers,
                "employer_demissions"=> $demissions,
                "nombre_recherche"=>count($employers),
                "fonctions"=>DB::select('select id,nom_fonction from fonctions where secteur_id = ?', [$secteur_id]),
                "departements"=>DB::select('select id,nom_departement from departement_entreprises where entreprise_id = ?', [$etp_id]),
                "branches"=>DB::select('select id,nom_branche from branches where entreprise_id = ?', [$etp_id]),
                "test" => DB::select('select distinct(LEFT(nom_stagiaire,1)) test_init from v_employe where entreprise_id = ? order by test_init asc',[$etp_id])
            ];
            return view('responsable.employe.liste')->with($data);
        }
        if (Gate::allows('isManager')) {
            $etp_id = ChefDepartement::where('user_id', $user_id)->value('entreprise_id');
            return view('manager.employers.liste_employe');
        }
    }


    public function ajout_historique_emploi(Request $req)
    {
        $user_id = Auth::user()->id;
        if (Gate::allows('isReferent')) {
            $etp_id = Responsable::where('user_id', $user_id)->value('entreprise_id');
            $employer_id = Employer::where('user_id', $user_id)->where('entreprise_id', $etp_id)->value('id');

            try {
                if ($req->statut_emploi_id) {
                    $newStatut = $req->statut_emploi_id;
                } else {
                    $newStatut = $req->ancien_statut;
                }

                if ($req->catg_emploi_id) {
                    $newCatg = $req->catg_emploi_id;
                } else {
                    $newCatg = $req->ancien_catg;
                }

                if ($req->groupe_emploi_id) {
                    $newGroupe = $req->groupe_emploi_id;
                } else {
                    $newGroupe = $req->ancien_groupe;
                }

                if ($req->service_id) {
                    $newService = $req->service_id;
                } else {
                    $newService = $req->ancien_service;
                }
                if ($req->dept_id) {
                    $newDept = $req->dept_id;
                } else {
                    $newDept = $req->ancien_dept;
                }
                if ($req->branche_id) {
                    $newBranche = $req->branche_id;
                } else {
                    $newBranche = $req->ancien_branche;
                }
                DB::beginTransaction();
                if ($req->fonction_id) {
                    $newfonction = $req->fonction_id;
                    DB::table('employers')->where('id', $req->employer_id)->update([
                        "service_id" => $newService, "branche_id" => $newBranche,
                        "departement_entreprises_id" => $newDept, "fonction_id" => $newfonction, "categorie_emploi_id" => $newCatg, "statut_emploi_id" => $newStatut, "groupe_emploi_id" => $newGroupe
                    ]);
                }

                DB::insert(
                    'insert into pers_historique_employers (employer_id,ancien_fonction,fonction_id,evenement_id,statut_emploi_id,categ_emploi_id,dept_id,branche_id,service_id,date_changement_fonction,groupe_emploi_id
                ) values (?, ?,?,?,?,?,?,?,?,?,?)',
                    [$req->employer_id, $req->ancien_fonct, $newfonction, $req->evenement_emploi, $newStatut, $newCatg, $newDept, $newBranche, $newService, $req->date_changement, $newGroupe]
                );

                DB::commit();
                return back();
            } catch (Exception $e) {
                DB::rollback();
            }
        }
    }

    // Create detailsPers
    public function storePersCharge(Request $request)
    {

        $insert = $request->all();
        PersonneACharge::create($insert);
        return back();
    }

    public function storeContactUrgence(Request $request)
    {

        $insert = $request->all();
        ContactUrgence::create($insert);
        return back();
    }

    public function nouveau_historique_salaire(Request $req)
    {
        $user_id = Auth::user()->id;

        if (Gate::allows('isReferent')) {

            $etp_id = Responsable::where('user_id', $user_id)->value('entreprise_id');
            $old_salaire = Salaire::where('employer_id', $req->employer_id)->value('montant');
            $date_creat = now();
            try {
                DB::beginTransaction();
                if ($old_salaire) {
                    DB::table('pers_salaire_bases')->where('employer_id', $req->employer_id)->update(['montant' => $req->new_montant]);
                } else {
                    DB::insert(
                        'insert into pers_salaire_bases (employer_id,montant,devise_id,created_at,updated_at) values (?,?,?,?,?)',
                        [$req->employer_id, $req->new_montant, $req->devise_id, $date_creat, $date_creat]
                    );
                }
                // if($req->evenement){
                DB::insert(
                    'insert into pers_historique_salaires (employer_id,ancien_montant,nouveau_montant,description,devise_id,
                        evenement_id,date_modification,created_at,updated_at) values (?,?,?,?,?,?,?,?,?)',
                    [$req->employer_id, $req->old_montant, $req->new_montant, $req->descr_change, $req->devise_id, $req->evenement, $req->date_changement, $date_creat, $date_creat]
                );


                // }
                // else{
                //     $newEvent = new Evenement();
                //     $newEvent->description = $req->autre_event;
                //     $newEvent->save();
                // }
                DB::commit();
                return back();
            } catch (Exception $e) {
                DB::rollback();
                echo $e->getMessage();
            }
        }
    }


    public function getDetailPers()
    {
        $user_id = Auth::user()->id;

        if (Gate::allows('isReferent')) {
            $etp_id = Responsable::where('user_id', $user_id)->value('entreprise_id');
            $referent_id = Employer::where('user_id', $user_id)->where('entreprise_id', $etp_id)->value('id');
            $data = [
                "genres" => Genre::all(),
                "employer_id" => $referent_id,
                "statutMatris" => StatutMatrimoniale::all(),
                "nationalites" => Nationalite::all(),
                "pers_a_charges" => PersonneACharge::all(),
                "stagiaire" => collect(DB::select('select id,entreprise_id,matricule,nom_stagiaire,prenom_stagiaire,genre_id,nationalite_id,
                status_matri_id,date_naissance,cin from v_employe where entreprise_id = ? AND id= ?', [$etp_id, $referent_id]))->first()
            ];
            return view('responsable.employe.detail_pers')->with($data);
        }
    }

    public function getDetailSalaire()
    {
        $user_id = Auth::user()->id;

        if (Gate::allows('isReferent')) {
            $etp_id = Responsable::where('user_id', $user_id)->value('entreprise_id');
            $employe_id = Employer::where('user_id', $user_id)->where('entreprise_id', $etp_id)->value('id');
            $old_salaire = collect(DB::select('select employer_id,montant,devise_id from pers_salaire_bases where employer_id =?', [$employe_id]))->first();
            $salaires = DB::select('select employer_id,id,ancien_montant,nouveau_montant,date_modification, devise,reference,evenement,valeur_pourcent,description from v_historique_salaire  where employer_id = ?', [$employe_id]);
            $primes = DB::table('paie_prime_indemnites')->distinct()->get();
            $avantages = DB::table('paie_avantage_en_natures')->distinct()->get();
            $current_month = Carbon::now()->month();
            $primes_employe = DB::select('select employer_id,montant,devise,nom_prime from v_pers_prime_indemnite where employer_id=? ', [$employe_id]);
            $avantage_nature = DB::select('select employer_id,montant,devise,designation from v_pers_avantage_nature  where employer_id = ?', [$employe_id]);
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
                "events" => Evenement::all(),
                "primes_employe" => $primes_employe,
                "avantage_natures" => $avantage_nature,
                "primes" => $primes,
                "avantages" => $avantages,
                "devises" => Devise::all(),
                "anc_salaire" => $montant,
                "salaires" => $salaire
            ];
            return view('responsable.salaire_employe.detail_salaire')->with($data);
        }
    }

    public function nouveau_contrat(Request $req)
    {

        $user_id = Auth::user()->id;

        if (Gate::allows('isReferent')) {

            $etp_id = Responsable::where('user_id', $user_id)->value('entreprise_id');
            $matricule = Employer::where('id', $req->employer_id)->where('entreprise_id', $etp_id)->value('matricule_emp');
            $etp_id = Responsable::where('user_id',$user_id)->value('entreprise_id');
            $matricule = Employer::where('id',$req->employer_id)->where('entreprise_id',$etp_id)->value('matricule_emp');
            $date = date('d-m-Y');
            $contrat = new Contrat();
            if ($req->hasFile('contrat_file')) {
                if ($req->file('contrat_file')->isValid()) {
                    $extension = $req->contrat_file->extension();

                    $nomImage = "contrat-" . $matricule . "-" . $date . "." . $extension;
                    $contrat->type_contrat_id = $req->type_contrat;
                    $contrat->employer_id = $req->employer_id;
                    $contrat->date_embauche = $req->debut_contrat;
                    $contrat->date_fin = $req->fin_contrat;
                    $contrat->date_permanence = $req->date_perm;
                    $contrat->description = $req->description;
                    $contrat->entreprise_id = $etp_id;
                    $contrat-> nom_fichier =  $nomImage;
                    $saveContrat = $contrat->save();
                    if ($saveContrat) {
                        $destinationPath = public_path('/contrats/employers/');
                        $req->contrat_file->move($destinationPath, $nomImage);
                    }
                }
                return back()->with('success', 'Nouveau contrat bien enregistré !');
            } else {
                return back();
            }
        }
    }

    public function getDetailEmploi()
    {

        $user_id = Auth::user()->id;

        if (Gate::allows('isReferent')) {

            $etp_id = Responsable::where('user_id', $user_id)->value('entreprise_id');
            $secteur_id = Entreprise::where('id', $etp_id)->value('secteur_id');
            $employe_id = Employer::where('user_id', $user_id)->where('entreprise_id', $etp_id)->value('id');
            $old_fonct = collect(DB::select('select fonction_id,fonction_stagiaire,categorie_emploi_id,categorie_emploi_stagiaire,statut_emploi_id,
            statut_emploi_stagiaire,service_id,nom_service,branche_id,departement_entreprises_id,nom_departement,branche_id,nom_branche from v_employe where id = ?', [$employe_id]))->first();
            $contrats = DB::table('pers_contrats')->where('employer_id', $employe_id)->latest()->first();
            $old_fonct = collect(DB::select('select fonction_id,fonction_stagiaire,categorie_emploi_id,categorie_emploi_stagiaire,statut_emploi_id,
            statut_emploi_stagiaire,service_id,nom_service,branche_id,departement_entreprises_id,nom_departement,branche_id,nom_branche,groupe_emploi_id,
            groupe_emploi from v_employe where id = ?', [$employe_id]))->first();
            $demission = DB::table('pers_demissions')->where('employer_id', $employe_id)->latest()->first();
            $data = [
                "employer_id" => $employe_id,
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
                "histo_emplois" => DB::select('select histo_emploi_id,ancien_fonction,new_fonct,evenement,date_changement_fonction from v_historique_emploi where employer_id = ?', [$employe_id])
            ];
            return view('responsable.job_employe.detail_emplois')->with($data);
        }
    }

    public function getGroupeEmploi($id)
    {
        $user_id = Auth::user()->id;

        if (Gate::allows('isReferent')) {
            $etp_id = Responsable::where('user_id', $user_id)->value('entreprise_id');
            // $data = DB::select('select groupe_emploi_id,groupe_emploi from v_groupe_categ_emploi where categ_id = ?', [$id]);
            $data = [
                "groupe" => DB::select('select groupe_emploi_id,groupe_emploi from v_groupe_categ_emploi where categ_id = ?', [$id]),
                "groupes" => DB::select('select id,groupe_emploi from pers_groupe_emplois order by id DESC limit 2')
            ];

            return response()->json($data);
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
    // public function getDureeSanction($id)
    // {
    //    $duree=Sanction::where('id',$id)->value('duree');
    //    return response()->json($duree);
    // }


    public function infoamation_sanitaire(Request $request)
    {
        $user_id = Auth::user()->id;
        $etp_id = Employer::where('user_id', $user_id)->where('prioriter', 1)->value('entreprise_id');
        $employe_id = Employer::where('user_id', $user_id)->where('entreprise_id', $etp_id)->value('id');
        // requette
        if (Gate::allows('isReferent')) {
            $allgerie = $request->input('inlineRadioOptions');
            $typeAllergie = $request->input('typeAllergie');
            if ($allgerie == 2) {
                $allgerie = $typeAllergie;
            }
            $groupe_sanguin = $request->input('RadioOptions');
            $intolérance = $request->input('intolérance');
            $typeintolerance = $request->input('typeintolerance');
            if ($intolérance == 4) {
                $intolérance = $typeintolerance;
            }
            $maladie_chronique = $request->input('maladie_chronique');
            $allergie = DB::Allergie('pers_allergies')->get();
            DB::insert('insert into pers_information_sanitaires (employer_id, allergie_id , groupe_sanguin_id ,  intolerance_id ,maladie_id) values(?,?,?,?,?)', [$employe_id, $allgerie, $groupe_sanguin, $intolérance, $maladie_chronique]);
            $allergie = DB::table('pers_allergies')->select('id', 'nom_allergie')->get();
            return back();
        }
    }

    public function getDetailSanction()
    {
        $user_id = Auth::user()->id;
        if (Gate::allows('isReferent')) {
            $etp_id = Employer::where('user_id', $user_id)->where('prioriter', 1)->value('entreprise_id');
            $employe_id = Employer::where('user_id', $user_id)->where('entreprise_id', $etp_id)->value('id');
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

    // Ajouter prime et indemnité
    public function addPrime(Request $req)
    {
        // $id_employer = DB::select('select * from employers where id');
        if ($count[0]->nbr == 0) {
            $code = DB::table('paie_prime_indemnites')->latest('code')->first();
            $prime = new PrimeEtIndemnite();
            $prime->code = intval($code->code) + 1;
            $prime->designation = $req->d_prime_et_indemnite;
            $prime->save();
            Alert::success('Donnée enregistré');
        } else {
            Alert::error($req->d_prime_et_indemnite . ' déjà existe');
        }
        return back();
    }

    //Ajouter Avantage en nature
    public function addAvNat(Request $req)
    {
        $count = DB::select('SELECT  count(id) as nbr FROM paie_avantage_en_natures WHERE designation=?', [$req->d_avantage_en_nature]);
        if ($count[0]->nbr == 0) {
            $code = DB::table('paie_avantage_en_natures')->latest('code')->first();
            $avNat = new AvantageEnNature();
            $avNat->code = intval($code->code) + 1;
            $avNat->designation = $req->d_avantage_en_nature;
            $avNat->save();
            Alert::success('Donnée enregistré');
        } else {
            Alert::error($req->d_avantage_en_nature . ' déjà existe');
        }
        return back();
    }

    public function mettre_demission(Request $req)
    {
        $user_id = Auth::user()->id;
        if (Gate::allows('isReferent')) {

            $etp_id = Responsable::where('user_id', $user_id)->value('entreprise_id');
            $matricule = Employer::where('id', $req->employer_id)->where('entreprise_id', $etp_id)->value('matricule_emp');
            $date = date('d-m-Y');
            $entreprise_id = 0;
            $activer = 0;
            $employer_user_id = Employer::where('id',$req->employer_id)->where('entreprise_id',$etp_id)->value('user_id');
            try {
                DB::beginTransaction();
                DB::table('employers')->where('id',$req->employer_id)->update(['entreprise_id'=>$etp_id,'activiter'=>$activer]);
                $demission = new Demission();
                if ($req->hasFile('lettre_dem')) {
                    if ($req->file('lettre_dem')->isValid()) {
                        $extension = $req->lettre_dem->extension();

                        $nomImage = "demission-" . $matricule . "-" . $date . "." . $extension;
                        $demission->nom_fichier =  $nomImage;
                        $demission->contrat_id = $req->num_contrat;
                        $demission->employer_id = $req->employer_id;
                        $demission->date_demission = $req->date_demission;
                        $demission->entreprise_id= $etp_id;
                        $saveDemission = $demission->save();
                        if ($saveDemission) {
                            $destinationPath = public_path('/demissions/employers/');
                            $req->lettre_dem->move($destinationPath, $nomImage);
                        }
                    }
                }
                DB::commit();
                return back();
            } catch (Exception $e) {
                DB::rollback();
                echo $e->getMessage();
            }
        }
    }
}
