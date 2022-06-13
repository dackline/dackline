<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZoneToGeoZone extends Model
{
    use HasFactory;

    protected $fillable = [
        'geo_zone_id', 'country_id', 'zone_id',
    ];

    public function country() {
        return $this->belongsTo(Country::class);
    }

    public function zone() {
        return $this->belongsTo(Zone::class);
    }
}
