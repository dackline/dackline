<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Information extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    public $translationModel = InformationDetail::class;

    public $translatedAttributes = [
        'title', 'description', 'meta_title', 'meta_description', 'url'
    ];

    protected $fillable = [
        'sort_order', 'status', 'design_template', 'footer'
    ];

    public function stores()
    {
        return $this->belongsToMany(Store::class);
    }
}
