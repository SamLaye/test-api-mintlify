<?php

namespace App\Models;

use App\Models\Arrondissement;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commune extends Model
{
    use HasFactory;
      protected $table = 'communes';

    protected $fillable = [
        'nom',
        'code_com',
        'arrondissement_id',
        'code_arr',
        'type',
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
        return $this->belongsTo(Arrondissement::class);
    }
}
