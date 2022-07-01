<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    protected $translatedAttributes = [
        'product_name', 'description', 'meta_title', 'meta_description', 'seo_h1_tag'
    ];

    protected $fillable = [
        'article_nr','ean','sku','location','price','tax_id', 'manufacturer_id', 'url','design_template','quantity','minimum_quantity','subtract','stock_status_id','date_available','weight','sort_order','status',
    ];

    public function stores()
    {
        return $this->belongsToMany(Store::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
