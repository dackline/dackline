<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeoZone extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description'
    ];

    public function zones()
    {
        return $this->belongsToMany(Zone::class)->withPivot('id', 'country_id');
    }
}
