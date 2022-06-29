<?php

namespace App\Http\Requests;

use Astrotomic\Translatable\Validation\RuleFactory;
use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
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
            '%name%' => ['required'],
            '%description%' => ['nullable'],
            '%metaTitle%' => ['required'],
            '%metaDescription%' => ['nullable'],
            '%titleTag%' => ['nullable'],
            '%altTag%' => ['nullable'],
            'sortOrder' => ['nullable', 'numeric'],
            'parentId' => ['nullable'],
            'storeId' => ['required', 'min:1'],
            'designTemplate' => ['nullable'],
            'image' => ['nullable'],
            'status' => ['required', 'numeric'],
        ]);

        return $rules;
    }
}
