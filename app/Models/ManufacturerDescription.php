<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManufacturerDescription extends Model
{
    use HasFactory;

    protected $fillabel = [
        'manufacturer_id', 'language_id', 'description', 'meta_title', 'meta_description', 'url'
    ];

    public function manufacturer() {
        return $this->belongsTo(Manufacturer::class);
    }

    public function language() {
        return $this->belongsTo(Language::class);
    }
}
