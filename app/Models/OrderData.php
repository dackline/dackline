<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class OrderData extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_status_id'
    ];

    public function order(): MorphOne
    {
        return $this->morphOne(Order::class, 'orderable');
    }

    public function orderStatus()
    {
        return $this->belongsTo(OrderStatus::class);
    }
}
