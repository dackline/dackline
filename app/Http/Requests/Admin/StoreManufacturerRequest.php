<?php

namespace App\Http\Requests\Admin;

use Astrotomic\Translatable\Validation\RuleFactory;
use Illuminate\Foundation\Http\FormRequest;

class StoreManufacturerRequest extends FormRequest
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
        $rules = RuleFactory::make([
            'name' => ['required'],
            'sortOrder' => ['nullable', 'numeric'],
            'storeId' => ['required', 'array', 'min:1'],
            'designTemplate' => ['nullable'],
            'image' => ['nullable'],
            'status' => ['required'],
            '%description%' => ['nullable'],
            '%metaTitle%' => ['nullable'],
            '%metaDescription%' => ['nullable'],
            '%url%' => ['nullable'],

        ]);

        return $rules;
    }
}
