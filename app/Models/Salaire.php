<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salaire extends Model
{
    use HasFactory;
    protected $table = "pers_salaire_bases";
    protected $fillable = ["employer_id","montant","devise_id"];
}
