<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelationEmpPermis extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'relation_emp_permis';
    protected $fillable = ["employer_id", "permis_id"];
}
