<?php

namespace App\Http\Controllers;

use App\Models\Secteur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use App\Models\NouveauCompte;
use App\Models\RoleUser;
use App\Models\Entreprise;
use App\Models\Responsable;
use Exception;
use Image;
use App\Models\User;


class CreateCompteController extends Controller
{
    public function __construct()
    {
        $this->new_compte = new NouveauCompte();

        $this->user = new User();
    }

    public function index()
    {
        $data = [
            "secteurs"=>Secteur::all()
        ];
        return view('create_compte.create_compte')->with($data);
    }

    public function nouveau_compte_entreprise(Request $req)
    {
        $this->middleware(['auth']);
        $this->middleware(function ($request, $next) {
            if (Auth::user()->exists == false) return redirect()->route('sign-in');
            return $next($request);
        });
        // $this->new_compte->validation_form_etp($req);
        $qst_IA_robot = 27 - 16;
        $value_confident = $req->value_confident;
        $val_resp_robot = $req->val_robot;
        if ($qst_IA_robot == $val_resp_robot) {

            if ($value_confident == 1) // il approuve les règlement
            {
                // ======== entreprise
                $date = date('d-m-y');
                $data["logo_etp"]  = str_replace(' ', '_', $req->name_etp .  '' . $req->tel_etp . '' . $date . '.' . $req->file('logo_etp')->extension());

                $url_logo = URL::to('/')."/images/entreprises/".$data["logo_etp"];

                $data["nom_etp"] = $req->name_etp;
                $data["email_etp"] = $req->email_resp_etp;
                // $data["tel_etp"] = $req->tel_resp_etp;
                // $data["web_etp"] = $req->web_etp;
                $data["nif"] = $req->nif;
                $data["secteur_id"] = $req->secteur_id;

                // ======= responsable
                $resp["matricule_emp"] = $req->matricule_resp_etp;
                $resp["nom_emp"] = $req->nom_resp_etp;
                $resp["prenom_emp"] = $req->prenom_resp_etp;
                $resp["cin_emp"] = $req->cin_resp_etp;
                $resp["email_emp"] = $req->email_resp_etp;

                $verify = $this->new_compte->verify_etp($req->name_etp, $req->email_resp_etp);
                $verify_etp_nif = DB::table('entreprises')->where('nif', $req->nif)->first();
                $verify_resp_cin = DB::table('users')->where('cin', $req->cin_resp_etp)->first();
                $verify_resp_mail =  DB::table('users')->where('email', $req->email_resp_etp)->first();


                if ($verify == null) { // etp n'existe pas
                    if ($verify_etp_nif == null) {
                        if ($verify_resp_cin == null) {
                            if ($verify_resp_mail == null) {
                                    $this->user->name = $req->nom_resp_etp . " " . $req->prenom_resp_etp;
                                    $this->user->email = $req->email_resp_etp;
                                    $this->user->cin = $req->cin_resp_etp;
                                    // $this->user->telephone = $req->tel_resp_etp;
                                    $ch1 = "0000";
                                    $this->user->password = Hash::make($ch1);
                                    $this->user->save();

                                    $user_id = User::where('email', $req->email_resp_etp)->value('id');
                                    $this->new_compte->insert_ETP($data, $url_logo);

                                    $etp_id = Entreprise::where("email_etp",$req->email_resp_etp)->value("id");
                                    $resp_etp = Responsable::where("entreprise_id",$etp_id)->get();
                                    $this->new_compte->insert_resp_ETP($resp, $etp_id, $user_id);
                                    DB::beginTransaction();
                                    try {
                                        DB::insert('insert into role_users (user_id, role_id,prioriter,activiter) values (?,?,?,?)', [$user_id, "2",true, true]);
                                        DB::insert('insert into role_users (user_id, role_id,prioriter,activiter) values (?,?,?,?)', [$user_id, "3",false, false]);
                                        DB::commit();
                                    } catch (Exception $e) {
                                        DB::rollback();
                                        echo $e->getMessage();
                                    }

                                    //============= save image

                                    // $this->img->store_image("entreprise", $data["logo_etp"], $req->file('logo_etp')->getContent());
                                    $etp =  DB::table('entreprises')->where('email_etp', $req->email_resp_etp)->first();
                                    $name = $req->nom_resp_etp . ' ' . $req->prenom_resp_etp;

                                        //imager  resize
                                        $image = $req->file('logo_etp');

                                        $image_name = $data["logo_etp"];

                                        $destinationPath = public_path('images/entreprises');

                                        $resize_image = Image::make($image->getRealPath());

                                        $resize_image->resize(256, 128, function($constraint){
                                            $constraint->aspectRatio();
                                        })->save($destinationPath . '/' .  $image_name);

                                        $image->move($destinationPath, $image_name);
                          //          Mail::to($req->email_resp_etp)->send(new save_new_compte_etp_Mail($name, $req->email_resp_etp, $etp->nom_etp));
                                    // $req->logo_etp->move(public_path('images/entreprises'), $data["logo_etp"]);  //save image cfp
                                    return redirect()->route('sign-in');
                                    if (Gate::allows('isSuperAdminPrincipale')) {
                                        return back();
                                    } else {
                                        return redirect()->route('sign-in');
                                    }
                                // } else {
                                //     return back()->with('error', 'télephone existe déjà!');
                                // }
                            } else {
                                return back()->with('error', 'email existe déjà!');
                            }
                        } else {
                            return back()->with('error', 'CIN existe déjà!');
                        }
                    } else {
                        return back()->with('error', 'NIF existe déjà!');
                    }
                } else {
                    return back()->with('error', 'Organisation de Formation existe déjà!');
                }
            } else {
                return back()->with('error', 'vous ne pouvez pas crée un compte sans accepter notre règle confidentiel, merci :-) !');
            }
        } else {
            return back()->with('error', 'désolé, les robots ne sont pas autorisé sur ce plateforme :-) !');
        }
    }

    public function affichage_role(Request  $request)
    {
        $user_id = $request->id_user;
        $liste_role = DB::select('select role_id,role_description,user_id,activiter from v_user_role where user_id = ?', [$user_id]);
        return response()->json($liste_role);
    }

    public function change_role_user(Request $rq, $user_id, $role_id)
    {
        $role_user = new RoleUser();
        return $role_user->update_role_user($user_id, $role_id);
    }
}
