<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use App\Models\Entreprise;
use App\Models\Responsable;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Exception;
use Illuminate\Support\Facades\Mail;

class EmployerController extends Controller
{
    public function __construct()
    {

        $this->middleware(['auth']);
        $this->middleware(function ($request, $next) {
            if (Auth::user()->exists == false) return redirect()->route('sign-in');
            return $next($request);
        });
    }

    public function verify_matricule_stg(Request $req)
    {
        $data = Employer::where('matricule_emp',$req->valiny)->get();
        return response()->json($data);
    }

    public function verify_email_stg(Request $req)
    {
        $data = User::where('email',$req->valiny)->get();
        return response()->json($data);
    }

    public function verify_cin_stg(Request $req)
    {
        $msg = [];
        $user_id = Auth::user()->id;
        $entreprise_id = Responsable::where('user_id',$user_id)->value('entreprise_id');
        $data = Employer::where('cin_emp',$req->valiny)->where('activiter',true)->where('entreprise_id','!=',$entreprise_id )->get();

        if (count($data) > 0) { // verify cin dans autre etp si mbola actif
            $msg = [
                "error" => "CIN existe déjà"
            ];
        } else {
            $data2 =Employer::where('cin_emp',$req->valiny)->where('entreprise_id',$entreprise_id )->value('cin_emp');
            $msg = [
                "success" => "CIN validé"
            ];
            if (count($data2) > 0) {
                $msg = [
                    "error" => "CIN existe déjà"
                ];
            } else {
                $msg = [
                    "success" => "CIN validé"
                ];
            }
        }
        return response()->json($msg);
    }

    public function save_multi_stagiaire(Request $req)
    {
        $user_id = Auth::user()->id;
        $stg = new Employer();
        $totale_valide = 0;

        for ($i = 0; $i < count($req["email_emp_"]); $i += 1) {

            $doner["matricule_emp"] = $req["matricule_"][$i];
            $doner["nom_emp"]  = $req["nom_"][$i];
            $doner["prenom_emp"]  = $req["prenom_"][$i];
            $doner["cin_emp"]  = $req["cin_"][$i];
            $doner["email_emp"]  = $req["email_"][$i];
            // $doner["tel"]  = $req["tel_"][$i];
            if ($req["matricule_"][$i] != null && $req["nom_"][$i] != null) {
                $totale_valide += 1;

                if (
                    $req["cin_"][$i] != null
                    && $req["email_"][$i] != null
                ) {
                    $verify = Employer::where('email_emp',$req["email_"][$i])->value('email_emp');

                    if (count($verify) <= 0) {

                        $user = new User();
                        $user->name = $req["nom_"][$i];
                        $user->email = $req["email_"][$i];
                        $user->cin = $req["cin_"][$i];
                        $ch1 = "0000";
                        $user->password = Hash::make($ch1);
                        $user->save();
                        $user_stg_id = User::where('email',$req["email_"][$i])->value('id');
                        if (Gate::allows('isReferent')) {
                            $entreprise_id = responsable::where('user_id', $user_id)->value('entreprise_id');
                            $etp = Entreprise::where('id',$entreprise_id)->value('id');

                            $stg->insert_multi($doner, $user_stg_id, $entreprise_id);

                            Mail::to($doner['email_emp'])->send(new \App\Mail\Nouveau_compte_employer($doner["nom_emp"] . ' ' . $doner["prenom_emp"], $doner['email_emp'], $etp->nom_etp));
                        }
                    } else {
                        return back()->with('error', "erreur,l'une des données existes déjà!");
                    }
                } else {
                    return back()->with('error', "l'une des champs sont est invalid!");
                }
            } else {
                return back()->with('error', "matricule ou autre champs vide");
            }
        }

        $msg = $totale_valide . " nouveaux employés ont été ajouter  avec succès!";
        return back()->with('success', $msg);
    }
}
