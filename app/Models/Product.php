<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Product extends Model implements TranslatableContract, HasMedia
{
    use HasFactory, Translatable, InteractsWithMedia;

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

    public function productOptions()
    {
        return $this->hasMany(ProductOption::class);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('product-image');
        $this->addMediaCollection('additional-images');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(100)
            ->height(100);
    }
}
