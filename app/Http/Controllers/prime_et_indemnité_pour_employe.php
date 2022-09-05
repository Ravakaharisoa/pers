<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;


class prime_et_indemnité_pour_employe extends Controller
{
    public function insertformprime_indemnite()
    {
        return view('detail_salarie');
    }

    public function insertprime_indemnite(Request $request)
    {
        $employer_id = $request->input("employer_id");
        $prime = $request->input('primes');
        $montant_prime = $request->input('montant_prime');
        $devise_prime = $request->input('devise_prime');
        $data = array('employer_id' => $employer_id, "prime_indemnite_id" => $prime, "montant" => $montant_prime, "devise_id" => $devise_prime);
        DB::table('pers_prime_indemnites')->insert($data);
        echo "Record inserted successfully.<br/>";
    }
}
