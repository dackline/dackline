<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_id', 'store_name', 'store_url',
        'customer_id', 'customer_group_id', 'firstname', 'lastname', 'email', 'email_invoice', 'phone', 'company', 'vat_nr',
        'payment_firstname', 'payment_lastname', 'payment_company', 'payment_address_1', 'payment_address_2', 'payment_city', 'payment_postcode', 'payment_country', 'payment_country_id',
        'payment_method', 'payment_method_id',
        'shipping_firstname', 'shipping_lastname', 'shipping_company', 'shipping_address_1', 'shipping_address_2', 'shipping_city', 'shipping_postcode', 'shipping_country', 'shipping_country_id',
        'shipping_method', 'shipping_method_id',
        'comment', 'total', 'order_status_id', 'ip', 'delivery_date',
        'currency_id', 'currency_code', 'currency_value'
    ];

    public function products()
    {
        return $this->hasMany(OrderProduct::class);
    }
}
