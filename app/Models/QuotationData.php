<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class QuotationData extends Model
{
    use HasFactory;

    protected $fillable = [
        'quotation_status_id'
    ];

    public function order(): MorphOne
    {
        return $this->morphOne(Order::class, 'orderable');
    }

    public function quotationStatus()
    {
        return $this->belongsTo(QuotationStatus::class);
    }
}
