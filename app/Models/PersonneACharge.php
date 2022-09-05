<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonneACharge extends Model
{
    use HasFactory;
    protected $table = "pers_personne_a_charges";
    protected $fillable = ["employer_id", "nom", "prenom", "relation_id", "contact_urgence", "date_naissance", "relation"];
}
