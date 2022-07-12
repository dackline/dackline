<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ShippingMethod extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'total', 'cost', 'geo_zone_id', 'store_id', 'status'
    ];

    public function geoZone(): BelongsTo
    {
        return $this->belongsTo(GeoZone::class);
    }

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }
}
