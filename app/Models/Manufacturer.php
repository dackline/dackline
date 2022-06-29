<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    public $translationModel = ManufacturerDetail::class;

    public $translatedAttributes = [
        'description', 'meta_title', 'meta_description', 'url'
    ];

    protected $fillable = [
        'name', 'image', 'sort_order', 'status', 'design_template'
    ];

    public function stores()
    {
        return $this->belongsToMany(Store::class);
    }
}
