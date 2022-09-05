<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use App\Models\Employer;
use App\Models\Entreprise;
use App\Models\Responsable;
use Illuminate\Http\Request;
use App\Models\Role;
use Carbon\Carbon;
use Exception;


class EmployeurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'nom_emp.required' => 'le Nom ne doit pas être null',
            'matricule_emp.unique'=>'matricule déjà existe',
            'email_emp.required' => 'invalid',
            'cin_emp.required' => 'invalid',
            'cin_emp.unique'=>'CIN déjà existe',
            'fonction_emp.required' => 'invalid',
            'telephone_emp.required' => 'invalid',
            'telephone_emp.unique'=>'Contact déjà existe',
            'email_emp.email' => 'email est invalid',
            'email_emp.unique'=>'email déjà existe'
        ];
        $critereForm = [
            'nom_emp' => 'required',
            'matricule_emp' => 'unique:employers',
            'email_emp' => 'required|email|unique:employers',
            'cin_emp' => 'required|unique:employers',
            'fonction_emp' => 'required',
            'telephone_emp' => 'required|unique:employers'
        ];
        $request->validate($critereForm, $rules);
        $user = new User();
        // dd($request->input());
        $matricule = $request->matricule_emp;
        $nom = $request->nom_emp;
        $prenom = $request->prenom_emp;
        $cin = $request->cin_emp;
        $fonction = $request->fonction_emp;
        $mail = $request->email_emp;
        $phone = $request->telephone_emp;
        $fonction_employer=null;

        if (Gate::allows('isReferent')) {
            $entreprise_id = Responsable::where('user_id',Auth::user()->id)->value('entreprise_id');
            $current_month = Carbon::now()->month;
            $nb_stagiaire = DB::select('SELECT * from stagiaires where entreprise_id = ? and MONTH(created_at) = ? ',[ $entreprise_id ,$current_month]);
            $nb_referent =  DB::select('SELECT * from responsables where entreprise_id = ? and MONTH(created_at) = ? ',[ $entreprise_id ,$current_month]);
            $abonnement_etp =  collect(DB::select('select * from v_abonnement_facture_entreprise where entreprise_id = ? order by facture_id desc limit 1',[$entreprise_id]))->first();

            $resp = collect(DB::select('select * from responsables where user_id = ?', [Auth::user()->id]))->first();
            $entreprise = collect(DB::select('select * from entreprises where id = ?', [$entreprise_id]))->first();
            $email_resp= $resp->email_resp;
            $nom_etp=$entreprise->nom_etp;
            $nom_resp = $resp->nom_resp;
            $prenom_resp = $resp->prenom_resp;


            $user->name = $request->nom_emp . " " . $request->prenom_emp;
            $user->email = $request->email_emp;
            $user->cin = $cin;
            $ch1 = "0000";
            $user->password = Hash::make($ch1);
            $user->telephone = $phone;
            $user->save();
            $user_id = User::where('email',$mail)->value('id');

            if($abonnement_etp !=null){

                if($abonnement_etp[0]->max_emp <= count($nb_stagiaire) && $abonnement_etp[0]->illimite = 0) {
                    return back()->with('error', "Vous avez atteint le nombre maximum d'employé, veuillez upgrader votre compte pour ajouter plus d'employé");
                }
                else{
                    $fonction_employer = Role::where('id','3')->value('role_description');

                    DB::beginTransaction();
                    try {
                        DB::insert('insert into role_users (user_id, role_id,prioriter,activiter) values (?,?,?,?)', [$user_id,"3",false,true]);

                        // $data = [$matricule, $nom, $prenom, $cin, $mail, $phone, $fonction, $entreprise_id, $user_id];
                        DB::insert("insert into employers(matricule_emp,nom_emp,prenom_emp,cin_emp,email_emp,telephone_emp,fonction_id,
                    entreprise_id,user_id,activiter,created_at) values(?,?,?,?,?,?,?,?,?,?,?)", [$matricule, $nom, $prenom, $cin, $mail, $phone, $fonction, $entreprise_id, $user_id,true,NOW()]);

                        DB::commit();
                    } catch (Exception $e) {
                        DB::rollback();
                        echo $e->getMessage();
                    }
                }
            }
            else{
                $fonction_employer = Role::where('id','3')->value('role_description');
                DB::beginTransaction();
                try {
                    // dd($request->all());

                    DB::insert('insert into role_users (user_id, role_id,prioriter,activiter) values (?,?,?,?)', [$user_id,"3",false,true]);

                    DB::insert("insert into employers(matricule_emp,nom_emp,prenom_emp,cin_emp,email_emp,telephone_emp,fonction_id,
                    entreprise_id,user_id,activiter,created_at) values(?,?,?,?,?,?,?,?,?,?,?)", [$matricule, $nom, $prenom, $cin, $mail, $phone, $fonction, $entreprise_id, $user_id,true,NOW()]);
                    DB::commit();
                } catch (Exception $e) {
                    DB::rollback();
                    echo $e->getMessage();
                }

            }
            // return response()->json(['success'=>'Form is successfully submitted!']);
            Mail::to($request->email_emp)->send(new \App\Mail\create_compte_new_employer_mail($email_resp,$nom_etp,$nom_resp,$prenom_resp ,$mail, $nom,$prenom,$fonction_employer));
            return back()->with('success',"Employé enregistré avec succès !");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
