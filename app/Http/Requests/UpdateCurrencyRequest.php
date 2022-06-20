<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCurrencyRequest extends FormRequest
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
            'currencyTitle' => ['required'],
            'code' => ['required'],
            'symbolLeft' => ['nullable'],
            'symbolRight' => ['nullable'],
            'decimalPlaces' => ['nullable', 'numeric'],
            'value' => ['nullable', 'numeric'],
            'status' => ['required']
        ];
    }
}
