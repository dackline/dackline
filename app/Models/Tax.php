<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
    use HasFactory;

    protected $fillable = [
        'tax_name', 'tax_rate', 'type', 'geo_zone_id'
    ];

    public function geoZone() {
        return $this->belongsTo(GeoZone::class);
    }
}
