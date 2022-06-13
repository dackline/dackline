<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'image', 'store_id', 'sort_order', 'status'
    ];

    public function store() {
        return $this->belongsTo(Store::class);
    }

    public function manufacturerDescriptions() {
        return $this->hasMany(ManufacturerDescription::class);
    }
}
