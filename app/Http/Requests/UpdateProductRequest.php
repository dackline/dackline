<?php

namespace App\Http\Requests;

use Astrotomic\Translatable\Validation\RuleFactory;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            '%productName%' => ['required'],
            '%description%' => ['nullable'],
            '%metaTitle%' => ['required'],
            '%metaDescription%' => ['nullable'],
            '%seoH1Tag%' => ['nullable'],
            'articleNr' => ['required'],
            'ean' => ['nullable'],
            'sku' => ['nullable'],
            'location' => ['nullable'],
            'price' => ['nullable', 'numeric'],
            'taxId' => ['nullable'],
            'manufacturerId' => ['nullable'],
            'url' => ['nullable'],
            'designTemplate' => ['nullable'],
            'quantity' => ['nullable', 'numeric', 'integer'],
            'minimumQuantity' => ['nullable', 'numeric', 'integer'],
            'subtract' => ['nullable'],
            'stockStatusId' => ['nullable'],
            'dateAvailable' => ['nullable', 'date', 'date_format:Y-m-d'],
            'weight' => ['nullable', 'numeric'],
            'sortOrder' => ['nullable', 'numeric'],
            'status' => ['required'],
            'storeId' => ['required', 'array', 'min:1'],
            'categoryId' => ['nullable', 'array'],
            'image' => ['nullable'],
            'productImage' => ['nullable', 'array'],
        ]);

        return $rules;
    }
}
