<?php

namespace App\Models;

use App\Models\Commune;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ecole extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'adresse',
        'commune_id',
    ];

    protected $table = 'ecoles';

    public function ecole () {
        return $this->belongsTo(Commune::class);
    }

    // Autres méthodes, accesseurs, mutateurs, etc., si nécessaire
}
