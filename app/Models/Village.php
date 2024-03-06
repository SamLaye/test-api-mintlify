<?php

namespace App\Models;

use App\Models\Commune;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Village extends Model
{
    use HasFactory;
      protected $table = 'villages';

    protected $fillable = [
        'nom',
        'code_vill',
        'commune_id',
        'population_masculine',
        'population_feminine',
        'population',
        'superficie_km2',
        'taux_scolarisation_globale',
        'incidence_pauvrete',
        'taux_alphabetisation_general',
        'taux_enregistrement_etat_civil',
    ];

     public function arrondissement () {
        return $this->belongsTo(Commune::class);
    }
}
