<?php

namespace App\Http\Requests\Admin;

use Astrotomic\Translatable\Validation\RuleFactory;
use Illuminate\Foundation\Http\FormRequest;

class UpdateInformationRequest extends FormRequest
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
            '%title%' => ['required'],
            '%description%' => ['required'],
            '%metaTitle%' => ['required'],
            '%metaDescription%' => ['nullable'],
            '%url%' => ['nullable'],
            'sortOrder' => ['nullable', 'numeric'],
            'footer' => ['nullable', 'numeric'],
            'storeId' => ['nullable'],
        ]);

        return $rules;
    }
}
