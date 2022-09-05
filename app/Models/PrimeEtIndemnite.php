<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrimeEtIndemnite extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'paie_prime_indemnites';
}
