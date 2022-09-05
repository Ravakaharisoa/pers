<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoriqueFonction extends Model
{
    use HasFactory;
    protected $table = "pers_historique_fonctions";
    protected $fillable =["employer_id","ancien_fonction","new_fonction","ancien_statut_emploi_id","new_statut_emploi_id","ancien_categorie_emploi_id","new_categorie_emploi_id","ancien_service_id	new_service_id","ancien_dept_id","new_dept_id","ancien_branche_id","new_branche_id","evenement_id","date_changement","date_permanance","date_fin_adhesion"];
}

