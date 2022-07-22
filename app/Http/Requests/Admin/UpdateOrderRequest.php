<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderRequest extends FormRequest
{
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
        return [
            'shippingMethodId' => ['required', 'exists:shipping_methods,id'],
            'paymentMethodId' => ['required', 'exists:payment_methods,id'],
            'orderStatusId' => ['required', 'exists:order_statuses,id'],
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
            'delivery_date' => ['nullable', 'date'],

            'products' => ['nullable', 'array']
        ];
    }
}
