<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerGroupTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_group_id', 'locale', 'description', 'name',
    ];
}
