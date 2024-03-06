<?php

namespace App\Models;

use App\Models\Commune;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Hopital extends Model
{
    use HasFactory;
    protected $table = 'hopitaux';
    protected $fillable = [
        'nom',
        'adresse',
        'commune_id'
    ];
    public function commune()
    {
        return $this->belongsTo(Commune::class);
    }
}

