<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderTotal extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id', 'code', 'title', 'value', 'sort_order'
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
