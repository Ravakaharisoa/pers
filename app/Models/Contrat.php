<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrat extends Model
{
    use HasFactory;
    protected $table ="pers_contrats";
    protected $fillables = ["type_contrat_id","employer_id","date_embauche","date_fin","date_permanence","description",	"nom_fichier"];
}
