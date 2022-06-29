<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Tax extends Model
{
    use HasFactory;

    protected $fillable = [
        'tax_name', 'tax_rate', 'type', 'geo_zone_id', 'status'
    ];

    /**
     * Get the status name
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function statusName(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => $attributes['status'] == 1 ? 'Active' : 'Inactive',
        );
    }

    public function geoZone()
    {
        return $this->belongsTo(GeoZone::class);
    }
}
