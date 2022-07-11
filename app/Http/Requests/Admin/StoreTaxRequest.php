<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTaxRequest extends FormRequest
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
            'taxName' => ['required'],
            'taxRate' => ['required', 'numeric'],
            'type' => ['required', Rule::in(['fixed_amount', 'percentage'])],
            'geoZoneId' => ['required'],
            'status' => ['required']
        ];
    }
}
