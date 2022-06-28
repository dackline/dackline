<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OptionValueDetail extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'option_id', 'option_value_id', 'locale', 'name'
    ];

    public function option()
    {
        return $this->belongsTo(Option::class);
    }

    public function optionValue()
    {
        return $this->belongsTo(OptionValue::class);
    }
}
