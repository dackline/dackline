<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerRequest extends FormRequest
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
            'customerGroupId' => ['required'],
            'countryId' => ['required'],
            'firstName' => ['required'],
            'lastName' => ['required'],
            'email' => ['required', 'email'],
            'emailInvoice' => ['nullable', 'email'],
            'phone' => ['required'],
            'companyName' => ['nullable'],
            'vatNr' => ['nullable'],

            // address
            'addresses' => ['nullable', 'array'],
            'addresses.*.addressLabel' => ['required'],
            'addresses.*.firstName' => ['required'],
            'addresses.*.lastName' => ['required'],
            'addresses.*.companyName' => ['nullable'],
            'addresses.*.phone' => ['nullable'],
            'addresses.*.address1' => ['required'],
            'addresses.*.address2' => ['nullable'],
            'addresses.*.city' => ['required'],
            'addresses.*.zipcode' => ['required'],
            'addresses.*.countryId' => ['required'],
            'addresses.*.default' => ['nullable'],
        ];
    }
}
