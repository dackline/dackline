<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformationDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'information_id', 'title', 'description', 'meta_title', 'meta_description', 'url'
    ];

    public function information()
    {
        return $this->belongsTo(Information::class);
    }
}
