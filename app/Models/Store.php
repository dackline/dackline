<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'url', 'meta_title', 'meta_description', 'meta_keywords', 'email', 'address', 'phone', 'language_id', 'country_id', 'tax_id', 'default'
    ];

    public function language() {
        return $this->belongsTo(Language::class);
    }

    public function country() {
        return $this->belongsTo(Country::class);
    }

    public function tax() {
        return $this->belongsTo(Tax::class);
    }
}
