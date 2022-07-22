<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_group_id', 'country_id', 'first_name', 'last_name', 'email', 'email_invoice', 'phone', 'company_name', 'vat_nr', 'user_id'
    ];

    protected $appends = ['full_name'];

    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: fn($value, $attributes) => implode(' ', [ucfirst($attributes['first_name']), ucfirst($attributes['last_name'])]),
        );
    }

    public function customerGroup()
    {
        return $this->belongsTo(CustomerGroup::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function addresses()
    {
        return $this->hasMany(CustomerAddress::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
