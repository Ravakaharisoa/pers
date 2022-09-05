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
use App\Models\PersonneACharge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use DateTime;
use File;

class PersController extends Controller
{
    public function __construct()
    {

        $this->middleware(['auth']);
        $this->middleware(function ($request, $next) {
            if (Auth::user()->exists == false) return redirect()->route('sign-in');
                return $next($request);
        });
    }

    public function getDetailPers()
    {
        $current_route = request()->path();
        if ($current_route == 'detail+personnel')
            if (Gate::allows('isReferent')) {
                return view('responsable.employe.detail_pers')->with($this->dataDetailPers());
            }
        else {
            if (Gate::allows('isReferent'))
                return response()->Json($this->dataDetailPers());
        }
    }
    public function updateDetailPers(Request $req, $id) {
        $data = Employer::find($id);
        $data->nom_emp = $req->nom_stagiaire;
        $data->prenom_emp = $req->prenom_stagiaire;
        $data->date_naissance_emp = $req->date_naissance;
        $data->genre_id = $req->genre_id;
        $data->cin_emp = $req->numCin;
        $data->passport = $req->passport;
        if ($req->hasfile('image')) {
            $imagePath = public_path('images/employes/'.$data->photos);
            if (File::exists($imagePath)) unlink($imagePath);
            $image = $req->file('image');
            $ext = $image->getClientOriginalExtension();
            $imgName = time() . '.' . $ext;
            $image->move('images/employes/', $imgName);
            $data->photos = $imgName;
        }
        $all_permis_emp = DB::select('select id, permis_id from relation_emp_permis
        where employer_id = ? order by permis_id', [$id]);
        if ($req->numPermis!=null && $req['categorie']!=null) {
            $data->num_permis = $req->numPermis;
            $cmpt = 0;
            foreach ($req['categorie'] as $key => $value) {
                if ($cmpt < count($all_permis_emp)) {
                    $one_permis = RelationEmpPermis::find($all_permis_emp[$cmpt]->id);
                    $one_permis->permis_id = $key;
                    $one_permis->save();
                }
                else {
                    $input = ["employer_id" => $id, "permis_id" => $key];
                    RelationEmpPermis::create($input);
                }
                $cmpt++;
            }
            if (count($req['categorie']) < count($all_permis_emp)) {
                $len = count($all_permis_emp) - count($req['categorie']);
                for ($i=0; $i < $len; $i++) {
                    DB::table('relation_emp_permis')->where('id', $all_permis_emp[$cmpt++]->id)->delete();
                }
            }
        }
        else {
            $data->num_permis = null;
            DB::table('relation_emp_permis')->where('employer_id', $id)->delete();
        }

        $data->save();
        Alert::success('Donnée enregistré');
        return back();
    }

    public function updateOrganismeSocials(Request $req, $id) {
        $data = Employer::find($id);
        $data->num_cnaps = $req->num_cnaps;
        $data->num_ostie = $req->num_ostie;
        $data->save();
        Alert::success('Donnée enregistré');
        return back();
    }

    public function updateContact(Request $req, $id) {
        $data = Employer::find($id);
        $data->nationalite_id = $req->nationalite;
        $data->adresse_region = $req->region;
        $data->adresse_ville = $req->ville;
        $data->adresse_quartier = $req->quartier;
        $data->adresse_code_postal = $req->code_postal;
        $data->adresse_lot = $req->lot;
        $data->status_matri_id = $req->status_matri_id;
        if ($req->status_matri_id == 2)
        $data->date_mariage = $req->date_mariage;
        else
        $data->date_mariage = null;
        $data->telephone_emp = $req->tel;
        $data->email_emp = $req->email;
        $data->save();
        Alert::success('Donnée enregistré');
        return back();
    }

    public function setPersCharge(Request $req) {
        $ddn = new DateTime($req['date_naissance']);
        $ldate = new DateTime('NOW');
        $age = $ldate->diff($ddn);
        if ($ddn<=$ldate) { 
            $isExist = $age->format('%d') + ($age->format('%m') * 30) + ($age->format('%y') * 365);
        }
        else {
            $isExist = -1;
        }
        if ($isExist>=0 && $isExist<7665) {
            if ($req["idPers"]==null) {
                $input = $req->all();
                PersonneACharge::create($input);
            }
            else {
                DB::update('UPDATE pers_contact_urgences SET nom=?, prenom=?, relation_id=? 
                where pers_a_charge_id=?', [$req->nom, $req->prenom, $req->relation_id, $req["idPers"]]);
                $data = PersonneAcharge::find($req["idPers"]);
                $data->employer_id = $req->employer_id;
                $data->nom = $req->nom;
                $data->prenom = $req->prenom;
                $data->prenom = $req->prenom;
                $data->date_naissance = $req->date_naissance;
                $data->relation_id = $req->relation_id;
                $data->contact_urgence = $req->contact_urgence;
                $data->save();
            }
            Alert::success('Donnée enregistré');
        }
        else Alert::error('Personne à charge doit être entre 0 à 21 ans');
        return back();
    }

    public function deletePersCharge(Request $req) {
        DB::table('pers_personne_a_charges')->where('id', $req['pers_a_charge_id'])->delete();
        DB::table('pers_contact_urgences')->where('pers_a_charge_id', $req['pers_a_charge_id'])->delete();
        Alert::success('Donnée supprimé');
        return back();
    }

    public function refreshContactUrgence(Request $req) {
        $input = $req->all();
        switch ($req['input_contact_urgence']) {
            case "add": {
                $input['pers_a_charge_id'] = $input['contact_pers_a_charge_id'];
                $cuPers = DB::select('SELECT pers_a_charge_id from pers_contact_urgences where pers_a_charge_id=?', [$input['pers_a_charge_id']]);
                if ($cuPers==null) {
                    if ($input['contact_urgence_id']==null) {
                        $persACharge = PersonneACharge::find($input['pers_a_charge_id']);
                        if ($persACharge!=null && !$persACharge['contact_urgence']) {
                            $persACharge->contact_urgence = true;
                            $persACharge->save();
                        }
                        ContactUrgence::create($input);
                    }
                    else {
                        $data = ContactUrgence::find($input['contact_urgence_id']);
                        $data->nom = $input['nom'];
                        $data->prenom = $input['prenom'];
                        $data->relation_id = $input['relation_id'];
                        $data->tel_fixe = $input['tel_fixe'];
                        $data->tel_mobile = $input['tel_mobile'];
                        $data->tel_travail = $input['tel_travail'];
                        $data->pers_a_charge_id = $input['pers_a_charge_id'];
                        if ($input['suppr_pers_a_charge_id']!=null) {
                            $persACharge = PersonneACharge::find($input['suppr_pers_a_charge_id']);
                            if ($persACharge!=null && $persACharge['contact_urgence']) {
                                $persACharge->contact_urgence = false;
                                $persACharge->save();
                            }
                        }
                        $persACharge = PersonneACharge::find($input['pers_a_charge_id']);
                        if ($persACharge!=null && !$persACharge['contact_urgence']) {
                            $persACharge->contact_urgence = true;
                            $persACharge->save();
                        }
                        $data->save();
                    }
                }
                Alert::success('Donnée enregistré');
                break;
            }
            case "on": {
                $persACharge = PersonneACharge::find($input['pers_a_charge_id']);
                $persACharge->contact_urgence = true;
                $persACharge->save();
                ContactUrgence::create($input);
                Alert::success('Donnée enregistré');
                break;
            }
            case "off": {
                $persACharge = PersonneACharge::find($input['pers_a_charge_id']);
                $persACharge->contact_urgence = false;
                $persACharge->save();
                DB::table('pers_contact_urgences')->where('pers_a_charge_id', $input['pers_a_charge_id'])->delete();
                Alert::success('Donnée supprimé');
                break;
            }
        }

        return back();
    }

    public function deleteContactUrgence(Request $req) {
        $persACharge = PersonneACharge::find($req['cu_pers_a_charge_id']);
        if ($persACharge!=null) {
            $persACharge->contact_urgence = false;
            $persACharge->save();
        }
        DB::table('pers_contact_urgences')->where('id', $req['contact_urgence_id'])->delete();
        Alert::success('Donnée supprimé');
        return back();
    }

    private function dataDetailPers() {
        $user_id = Auth::user()->id;
        $etp_id = Employer::where('user_id',$user_id)->where('prioriter',1)->value('entreprise_id');
        $referent_id = Employer::where('user_id',$user_id)->where('entreprise_id',$etp_id)->value('id');
        $date = new DateTime();
        $date = date($date->format('Y')-21). '-' . date($date->format('m')) . '-' . date($date->format('d'));
        $id_pers_a_charge = DB::select('SELECT id FROM pers_personne_a_charges WHERE date_naissance<=?', [$date]);
        for ($i=0; $i < count($id_pers_a_charge); $i++) { 
            DB::update('UPDATE pers_contact_urgences SET  pers_a_charge_id=null
            WHERE pers_a_charge_id=?', [$id_pers_a_charge[$i]->id]);
        }
        DB::table('pers_personne_a_charges')->where('employer_id', $referent_id)->where('date_naissance', '<=', $date)->delete();
        $data = [
            "employer_id"=>$referent_id,
            "genres" => Genre::all(),
            "statutMatris" => StatutMatrimoniale::all(),
            "pers_relations" => PersRelation::all(),
            "all_categ_permis" => Permis::all(),
            "date_mariage" => Employer::where('id',$referent_id)->value('date_mariage'),
            "contact" => collect(DB::select('select nationalite_stagiaire, region, ville,
            quartier, code_postal, lot, telephone_stagiaire, mail_stagiaire from v_employe where id = ?',
            [$referent_id]))->first(),
            "nationalites" => Nationalite::all(),
            "emp_all_permis" => DB::select('SELECT DISTINCT permis_id
            FROM relation_emp_permis WHERE employer_id = ?
         ', [$referent_id]),
            "pers_a_charges" => DB::select('select id, nom,
            prenom, date_naissance, YEAR(date_naissance) as year, relation_id, contact_urgence, created_at, updated_at from pers_personne_a_charges where employer_id = ?',
            [$referent_id]),
            "identite" => collect(DB::select('select num_permis, passport, num_cnaps, num_ostie
            from employers where id = ?', [$referent_id]))->first(),
            "contact_urgences" => DB::select('select id, nom, prenom,
            relation_id, tel_fixe, tel_mobile, tel_travail, pers_a_charge_id from pers_contact_urgences where employer_id = ?',
            [$referent_id]),
            "stagiaire"=> collect(DB::select('select id, entreprise_id, matricule, nom_stagiaire,
            prenom_stagiaire, genre_id, nationalite_id, status_matri_id, date_naissance,
            cin, photos from v_employe where entreprise_id = ? AND id= ?', [$etp_id ,$referent_id]))->first(),
            "materiels"=> DB::select('select id,nom_emp,prenom_emp,code ,description,lien_image,num_serie,Date_Format(date, "%d-%m-%Y") as date, date_fin from v_materiels where employer_id=? order by date_fin asc, date desc',[$referent_id]),
            "type_materiels"=>DB::select('select id,description from pers_type_materiels')
        ];
        return $data;
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
}
