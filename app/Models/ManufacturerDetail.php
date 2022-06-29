<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManufacturerDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'manufacturer_id', 'locale', 'description', 'meta_title', 'meta_description', 'url'
    ];

    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class);
    }
}
