<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id', 'locale', 'product_name', 'description', 'meta_title', 'meta_description', 'seo_h1_tag'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
