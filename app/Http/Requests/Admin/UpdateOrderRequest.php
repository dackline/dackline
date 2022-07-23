<?php

namespace App\Http\Requests\Admin;

use App\Models\OrderData;
use App\Models\QuotationData;
use App\Traits\Admin\DetermineOrderTypeTrait;
use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderRequest extends FormRequest
{
    use DetermineOrderTypeTrait;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [
            'shippingMethodId' => ['required', 'exists:shipping_methods,id'],
            'paymentMethodId' => ['required', 'exists:payment_methods,id'],
            'assigneeId' => ['nullable', 'exists:users,id'],

            'customerId' => ['required'],
            'customerFirstName' => ['required'],
            'customerLastName' => ['required'],
            'customerEmail' => ['required', 'email'],
            'customerEmailInvoice' => ['required', 'email'],
            'customerPhone' => ['nullable'],
            'customerCompanyName' => ['nullable'],
            'customerVatNr' => ['nullable'],

            'shippingFirstName' => ['required'],
            'shippingLastName' => ['required'],
            'shippingCompanyName' => ['required'],
            'shippingPhone' => ['required'],
            'shippingCountryId' => ['required'],
            'shippingAddress1' => ['required'],
            'shippingAddress2' => ['nullable'],
            'shippingCity' => ['required'],
            'shippingZipcode' => ['required'],

            'paymentFirstName' => ['required'],
            'paymentLastName' => ['required'],
            'paymentCompanyName' => ['required'],
            'paymentPhone' => ['required'],
            'paymentCountryId' => ['required'],
            'paymentAddress1' => ['required'],
            'paymentAddress2' => ['nullable'],
            'paymentCity' => ['required'],
            'paymentZipcode' => ['required'],

            'comment' => ['nullable'],
            'total' => ['nullable', 'numeric'],
            'deliveryDate' => ['nullable', 'date'],

            'products' => ['nullable', 'array']
        ];

        if($this->orderType == OrderData::class) {
            $rules['orderStatusId'] =  ['required', 'exists:order_statuses,id'];
        }

        if($this->orderType == QuotationData::class) {
            $rules['quotationStatusId'] =  ['required', 'exists:quotation_statuses,id'];
        }

        return $rules;
    }
}
