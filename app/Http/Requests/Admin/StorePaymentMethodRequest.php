<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StorePaymentMethodRequest extends FormRequest
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
            'name' => ['required'],
            'description' => ['nullable'],
            'total' => ['nullable', 'numeric'],
            'cost' => ['nullable', 'numeric'],
            'storeId' => ['required'],
            'geoZoneId' => ['required'],
            'status' => ['required']
        ];
    }
}