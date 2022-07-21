<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id', 'type', 'message', 'order_status'
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}