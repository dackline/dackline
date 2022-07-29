<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuotationStatus extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    protected $fillable = [
        'value'
    ];

    protected $translatedAttributes = [
        'name',
    ];
}
