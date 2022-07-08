<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCustomField extends Model
{
    use HasFactory;

    protected $fillable = [
        //general
        'supplier_id', 'manufacture_date', 'width', 'size', 'purchase_price',
        //wheel
        'wheel_color', 'wheel_et', 'wheel_center_bore', 'wheel_max_load', 'wheel_pcd',
        // tyre
        'tyre_holohation_mark', 'tyre_profile', 'tyre_construction_type', 'tyre_load_index', 'tyre_speed_rating', 'tyre_c_flag', 'tyre_category_info',
        'tyre_runflat_rtf', 'tyre_snowigan', 'tyre_studded', 'tyre_label_roll', 'tyre_label_wet', 'tyre_label_noise_1', 'tyre_label_noise_2',
    ];

    protected $casts = [
        'wheel_pcd' => 'array'
    ];
}
