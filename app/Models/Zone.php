<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'code', 'country_id', 'status'
    ];

    public function country() {
        return $this->belongsTo(Country::class);
    }

    protected function statusName(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => $attributes['status'] == 1 ? 'Active' : 'Inactive',
        );
    }
}
