<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOptionValue extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_option_id', 'product_id', 'option_id', 'option_value_id', 'quantity', 'subtract', 'price', 'price_prefix', 'weight', 'weight_prefix'
    ];

    public function productOption()
    {
        return $this->belongsTo(ProductOption::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function option()
    {
        return $this->belongsTo(Option::class);
    }

    public function optionValue()
    {
        return $this->belongsTo(OptionValue::class);
    }
}
