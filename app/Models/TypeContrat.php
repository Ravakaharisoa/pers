<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeContrat extends Model
{
    use HasFactory;
    protected $table = "pers_type_contrats";
    protected $fillable = ["type_contrat","reference"];
}
