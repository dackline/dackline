<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OptionValue extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    public $translationModel = OptionValueDetail::class;

    public $translatedAttributes = [
        'name',
    ];

    protected $fillable = [
        'option_id', 'sort_order'
    ];

    public function option()
    {
        return $this->belongsTo(Option::class);
    }

    public function optionValueDetails()
    {
        return $this->hasMany(OptionValueDetail::class);
    }
}
