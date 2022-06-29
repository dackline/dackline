<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    public $translationModel = CategoryDetail::class;

    public $translatedAttributes = [
        'name', 'title_tag', 'alt_tag', 'description', 'meta_title', 'meta_description',
    ];

    protected $fillable = [
        'parent_id', 'image', 'sort_order', 'status', 'design_template'
    ];

    public function parent() {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function stores()
    {
        return $this->belongsToMany(Store::class);
    }

    public function scopeActive($query, $except = [])
    {
        return $query
            ->where('status', 1)
            ->whereNotIn('id', $except);
    }
}
