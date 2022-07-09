<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable;
use Astrotomic\Translatable\Translatable as TranslatableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerGroup extends Model implements Translatable
{
    use HasFactory, TranslatableTrait;

    public $translationModel = CustomerGroupTranslation::class;

    public $translatedAttributes = [
        'name', 'description',
    ];
}
