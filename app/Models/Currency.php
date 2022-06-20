<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'code', 'symbol_left', 'symbol_right', 'decimal_places', 'value', 'status'
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
}
