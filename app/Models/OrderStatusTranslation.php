<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderStatusTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'order_status_id',
    ];

    public function orderStatus()
    {
        return $this->belongsTo(OrderStatus::class);
    }
}
