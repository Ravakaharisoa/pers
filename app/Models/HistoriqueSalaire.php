<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoriqueSalaire extends Model
{
    use HasFactory;
    protected $table ="pers_historique_salaires";
    protected $fillable =["employer_id","ancien_montant","nouveau_montant","devise_id","evenement_id","date_modification"];
}
