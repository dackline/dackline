<?php

namespace App\Http\Requests;

use Astrotomic\Translatable\Validation\RuleFactory;
use Illuminate\Foundation\Http\FormRequest;

class UpdateOptionRequest extends FormRequest
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
            'type' => ['required'],
            'sortOrder' => ['nullable', 'numeric'],
            'optionValues' => ['required', 'array', 'min:1'],
            'optionValues.*.%name%' => ['required'],
            'optionValues.*.sortOrder' => ['nullable', 'numeric'],
        ]);

        return $rules;
    }
}
