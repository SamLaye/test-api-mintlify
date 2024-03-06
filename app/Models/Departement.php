<?php

namespace App\Models;

use App\Models\Region;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departement extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'code_dept',
        'region_id',
        'code_reg',
    ];

    public function region() {
        return $this->belongsTo(Region::class);
    }
}
