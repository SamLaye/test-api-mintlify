<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    
    use HasFactory;

    protected $table = 'regions';

    protected $fillable = [
        'nom',
        'code_reg',
        'superficie_km2',
        'population_masculine',
        'population_feminine',
        'population',
        'incidence_pauvrete',
        'taux_scolarisation_globale',
        'taux_alphabetisation_general',
        'taux_enregistrement_etat_civil'
    ];
}
