<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;

class Category extends Model implements TranslatableContract
{
    use HasFactory, Translatable, HasRecursiveRelationships;

    public $translationModel = CategoryDetail::class;

    public $translatedAttributes = [
        'name', 'title_tag', 'alt_tag', 'description', 'meta_title', 'meta_description',
    ];

    protected $fillable = [
        'parent_id', 'image', 'sort_order', 'status', 'design_template'
    ];

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

    public function scopeFullName($query)
    {
        $categories = $query->with(['ancestorsAndSelf', 'ancestorsAndSelf.translations','translations'])->get();

        return $categories->map(function($category) {
            return [
                'id' => $category->id,
                'name' => implode(' > ', $category->ancestorsAndSelf->reverse()->map(fn($item) => $item->name)->toArray())
            ];
        })->sortBy([
            fn($a, $b) => $a['name'] <=> $b['name']
        ]);
    }
}
