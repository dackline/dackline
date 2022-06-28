<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    public $translationModel = OptionDetail::class;

    public $translatedAttributes = [
        'name',
    ];

    protected $fillable = [
        'type', 'sort_order'
    ];

    public function values()
    {
        return $this->hasMany(OptionValue::class);
    }
}
