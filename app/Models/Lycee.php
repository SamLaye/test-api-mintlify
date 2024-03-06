<?php

namespace App\Models;

use App\Models\Commune;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lycee extends Model
{
    use HasFactory;
      protected $table = 'lycee';

      protected $fillable = [
        'nom',
        'adresse',
        'code_lyc',
        'commune_id',
    ];

     public function lycee () {
        return $this->belongsTo(Commune::class);
    }
}
