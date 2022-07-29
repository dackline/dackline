<?php
namespace App\Traits\Admin;

trait CalculateOrderTotalsTrait
{
    public function getSubtotal()
    {
        return $this->products->reduce(function($carry, $product) {
            return $carry + ((int)$product->pivot->quantity * (float)$product->pivot->price);
        }, 0);
    }

    public function getShipping()
    {
        return $this->shippingMethod ? (float)$this->shippingMethod->cost : 0;
    }

    public function getDiscount()
    {
        return $this->products->reduce(function($carry, $product) {
            $discountPercent = (float)$product->pivot->discount_percent;
            $total = (int)$product->pivot->quantity * (float)$product->pivot->price;
            return $carry + ($total * ($discountPercent / 100));
        }, 0);
    }

    public function getTaxes()
    {
        return $this->products->reduce(function($carry, $product) {
            if(!$product->tax)
                return $carry + 0;

            $taxType = $product->tax->type;
            $taxRate = $product->tax->tax_rate;
            $total = (int)$product->pivot->quantity * (float)$product->pivot->price;
            $total = $taxType == 'percentage'
                        ? $total * ($taxRate) / 100
                        : $taxRate;

            return $carry + $total;
        }, 0);
    }

    public function getTotal()
    {
        $subtotal = $this->getSubtotal();
        $shipping = $this->getShipping();
        $discount = $this->getDiscount();
        $taxes = $this->getTaxes();

        return $subtotal + $shipping - $discount + $taxes;
    }

    public function getTotals()
    {
        $available_totals = config('dackline.available_totals');

        $totals = [];
        foreach($available_totals as $total) {
            $method_name = 'get'. ucfirst($total['code']);
            $value = $this->{$method_name}();
            $totals[] = [
                'title' => $total['name'],
                'value' => $value,
            ];
        }

        return $totals;
    }
}
