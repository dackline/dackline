<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuotationStatusTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'quotation_status_id',
    ];

    public function quotationStatus()
    {
        return $this->belongsTo(QuotationStatus::class);
    }
}
