<?php
namespace App\Traits\Admin;

use App\Models\OrderData;
use App\Models\QuotationData;

trait DetermineOrderTypeTrait
{
    private $orderType;

    public function __construct()
    {
        $this->orderType = $this->getType();
    }

    private function getType() {
        $name = optional(request()->route())->getName();
        return \Illuminate\Support\Str::contains($name, 'quotations') ? QuotationData::class : OrderData::class;
    }

    private function isOrder() {
        return $this->orderType == OrderData::class ? true : false;
    }
}
