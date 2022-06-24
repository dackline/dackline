<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStoreRequest extends FormRequest
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
            'storeName' => ['required'],
            'storeUrl' => ['required'],
            'metaTitle' => ['required'],
            'metaDescription' => ['nullable'],
            'metaKeywords' => ['nullable'],
            'email' => ['required'],
            'address' => ['required'],
            'phone' => ['required'],
            'currencyId' => ['required', 'exists:currencies,id'],
            'countryId' => ['required', 'exists:countries,id'],
            'taxId' => ['required', 'exists:taxes,id'],
            'default' => ['nullable'],
        ];
    }
}
