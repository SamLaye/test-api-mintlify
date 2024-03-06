<?php

namespace App\Models;

use App\Models\Departement;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arrondissement extends Model
{
    use HasFactory;

    protected $table = 'arrondissements';

    protected $fillable = [
        'nom',
        'code_arr',
        'code_dept',
        'departement_id',
        'population_masculine',
        'population_feminine',
        'population',
        'superficie_km2',
        'taux_scolarisation_globale',
        'incidence_pauvrete',
        'taux_alphabetisation_general',
        'taux_enregistrement_etat_civil',
        
    ];

    public function departement () {
        return $this->belongsTo(Departement::class);
    }
}
