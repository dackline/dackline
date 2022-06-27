<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id', 'locale', 'name', 'title_tag', 'alt_tag', 'description', 'meta_title', 'meta_description'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
