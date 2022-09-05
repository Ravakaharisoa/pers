<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Employer extends Model
{
    use HasFactory;
    protected $table = "employers";

    public function checkEmail($email)
    {
        $mail = Employer::where("email_emp", $email)->get();
        if (count($mail) > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function checkMatricule($matricule)
    {
        $mat = Employer::where("matricule_emp", $matricule)->get();
        if (count($mat) > 0) {
            return true;
        } else {
            return false;
        }
    }
public function insert_multi($doner, $user_id,$entreprise_id)
    {
        $data = [
            $doner["matricule_emp"],$doner["nom_emp"],$doner["prenom_emp"],$doner["cin_emp"],$doner["email_emp"],
            $entreprise_id,$user_id
        ];
        DB::insert('insert into employers (matricule_emp,nom_emp,prenom_emp,cin_emp,email_emp,entreprise_id,user_id,created_at) values (?,?,?,?,?,?,?,NOW())', $data);
        DB::commit();
    }

}
