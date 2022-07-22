<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_id', 'store_name', 'store_url',
        'customer_id', 'customer_group_id', 'firstname', 'lastname', 'email', 'email_invoice', 'phone', 'company', 'vat_nr',
        'payment_firstname', 'payment_lastname', 'payment_company', 'payment_phone', 'payment_address_1', 'payment_address_2', 'payment_city', 'payment_zipcode', 'payment_country', 'payment_country_id',
        'payment_method', 'payment_method_id',
        'shipping_firstname', 'shipping_lastname', 'shipping_company', 'shipping_phone', 'shipping_address_1', 'shipping_address_2', 'shipping_city', 'shipping_zipcode', 'shipping_country', 'shipping_country_id',
        'shipping_method', 'shipping_method_id',
        'comment', 'total', 'order_status_id', 'ip', 'delivery_date', 'assignee_id',
        'currency_id', 'currency_code', 'currency_value'
    ];

    protected function fullNameWithCompany(): Attribute
    {
        return Attribute::make(
            get: fn($value, $attributes) => $attributes['company'] ? implode(' ', [ucfirst($attributes['firstname']), ucfirst($attributes['lastname'])]) . ' ('. $attributes['company'] .')': implode(' ', [ucfirst($attributes['firstname']), ucfirst($attributes['lastname'])]),
        );
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_products')->withPivot(['name', 'article_nr', 'quantity', 'price', 'total', 'tax', 'discount', 'discount_percent']);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function shippingMethod()
    {
        return $this->belongsTo(ShippingMethod::class);
    }

    public function orderStatus()
    {
        return $this->belongsTo(OrderStatus::class);
    }

    public function assignee()
    {
        return $this->belongsTo(User::class, 'assignee_id');
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function histories()
    {
        return $this->hasMany(OrderHistory::class);
    }
}
