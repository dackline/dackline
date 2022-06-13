<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'code', 'symbol_left', 'symbol_right', 'decimal_places', 'value', 'status'
    ];
}
