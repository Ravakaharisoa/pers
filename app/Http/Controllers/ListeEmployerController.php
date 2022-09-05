<?php

namespace App\Http\Controllers;

use App\Models\ChefDepartement;
use App\Models\Responsable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;

class ListeEmployerController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware(function ($request, $next) {
            if (Auth::user()->exists == false) return redirect()->route('sign-in');
            return $next($request);
        });
    }

    public function listes_employes_par_grille()
    {
        $user_id = Auth::user()->id;
        if (Gate::allows('isReferent')) {
            $etp_id = Responsable::where('user_id',$user_id)->value('entreprise_id');
            $employers = DB::select('select id,entreprise_id,matricule,nom_stagiaire,prenom_stagiaire,mail_stagiaire,
            telephone_stagiaire,nom_service,nom_departement,photos,fonction_stagiaire,activiter from v_employe where entreprise_id = ?', [$etp_id]);
            $data = [
                "employers"=>$employers,
                "departements"=>DB::select('select id,nom_departement from departement_entreprises where entreprise_id = ?', [$etp_id]),
                "branches"=>DB::select('select id,nom_branche from branches where entreprise_id = ?', [$etp_id]),
                "test" => DB::select('select distinct(LEFT(nom_stagiaire,1)) test_init from v_employe where entreprise_id = ? order by test_init asc',[$etp_id])
            ];
            return view('employers.listes.employe_par_grille')->with($data);
        }
        // if(Gate::allows('isManager')){
        //     $etp_id = ChefDepartement::where('user_id',$user_id)->value('entreprise_id');
        //     return view('manager.employers.liste_employe');
        // }
    }

    public function liste_employe_par_liste()
    {
        $user_id = Auth::user()->id;
        if (Gate::allows('isReferent')) {
            $etp_id = Responsable::where('user_id',$user_id)->value('entreprise_id');
            $employers = DB::select('select id,entreprise_id,matricule,nom_stagiaire,prenom_stagiaire,mail_stagiaire,
            telephone_stagiaire,nom_service,nom_departement,photos,fonction_stagiaire,activiter from v_employe where entreprise_id = ?', [$etp_id]);
            $data = [
                "employers"=>$employers,
                "departements"=>DB::select('select id,nom_departement from departement_entreprises where entreprise_id = ?', [$etp_id]),
                "branches"=>DB::select('select id,nom_branche from branches where entreprise_id = ?', [$etp_id]),
                "test" => DB::select('select distinct(LEFT(nom_stagiaire,1)) test_init from v_employe where entreprise_id = ? order by test_init asc',[$etp_id])
            ];
            return view('employers.listes.employe_par_liste')->with($data);
        }
        // if(Gate::allows('isManager')){
        //     $etp_id = ChefDepartement::where('user_id',$user_id)->value('entreprise_id');
        //     return view('manager.employers.liste_employe');
        // }
    }

    public function recherche_departement($id)
    {
        $user_id = Auth::user()->id;
        if (Gate::allows('isReferent')) {
            $etp_id = Responsable::where('user_id',$user_id)->value('entreprise_id');
            $employers = DB::select('select id,entreprise_id,matricule,nom_stagiaire,prenom_stagiaire,mail_stagiaire,
            telephone_stagiaire,nom_service,nom_departement,photos,fonction_stagiaire,activiter from v_employe where entreprise_id = ? AND departement_entreprises_id = ?', [$etp_id,$id]);
            $data = [
                "employers"=>$employers,
                "departements"=>DB::select('select id,nom_departement from departement_entreprises where entreprise_id = ?', [$etp_id]),
                "branches"=>DB::select('select id,nom_branche from branches where entreprise_id = ?', [$etp_id]),
                "test" => DB::select('select distinct(LEFT(nom_stagiaire,1)) test_init from v_employe where entreprise_id = ? order by test_init asc',[$etp_id])
            ];
            return view('employers.listes.employer_dept')->with($data);
        }
    }

    public function recherche_branche($id)
    {
        $user_id = Auth::user()->id;
        if (Gate::allows('isReferent')) {
            $etp_id = Responsable::where('user_id',$user_id)->value('entreprise_id');
            $employers = DB::select('select id,entreprise_id,matricule,nom_stagiaire,prenom_stagiaire,mail_stagiaire,
            telephone_stagiaire,nom_service,nom_departement,photos,fonction_stagiaire,activiter from v_employe where entreprise_id = ? AND branche_id = ?', [$etp_id,$id]);
            $data = [
                "employers"=>$employers,
                "departements"=>DB::select('select id,nom_departement from departement_entreprises where entreprise_id = ?', [$etp_id]),
                "branches"=>DB::select('select id,nom_branche from branches where entreprise_id = ?', [$etp_id]),
                "test" => DB::select('select distinct(LEFT(nom_stagiaire,1)) test_init from v_employe where entreprise_id = ? order by test_init asc',[$etp_id])
            ];
            return view('employers.listes.employer_branche')->with($data);
        }
    }
}
