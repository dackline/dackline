<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockStatusTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'stock_status_id',
    ];

    public function stockStatus()
    {
        return $this->belongsTo(StockStatus::class);
    }
}
