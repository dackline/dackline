<?php

namespace App\Http\Requests\Admin;

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
            'mpn' => ['nullable'],
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

            'supplierId' => ['nullable'],
            'manufactureDate' => ['nullable'],
            'width' => ['nullable'],
            'size' => ['nullable'],
            'purchasePrice' => ['nullable'],
            'wheelColor' => ['nullable'],
            'wheelEt' => ['nullable'],
            'wheelCenterBore' => ['nullable'],
            'wheelMaxLoad' => ['nullable'],
            'wheelPcd1' => ['nullable'],
            'wheelPcd2' => ['nullable'],
            'wheelPcd3' => ['nullable'],
            'wheelPcd4' => ['nullable'],
            'wheelPcd5' => ['nullable'],
            'wheelPcd6' => ['nullable'],
            'wheelPcd7' => ['nullable'],
            'wheelPcd8' => ['nullable'],
            'wheelPcd9' => ['nullable'],
            'wheelPcd10' => ['nullable'],
            'wheelPcd11' => ['nullable'],
            'wheelPcd12' => ['nullable'],
            'wheelPcd13' => ['nullable'],
            'wheelPcd14' => ['nullable'],
            'wheelPcd15' => ['nullable'],
            'wheelPcd16' => ['nullable'],
            'tyreHolohationMark' => ['nullable'],
            'tyreRunflatRtf' => ['nullable'],
            'tyreProfile' => ['nullable'],
            'tyreSnowigan' => ['nullable'],
            'tyreConstructionType' => ['nullable'],
            'tyreStudded' => ['nullable'],
            'tyreLoadIndex' => ['nullable'],
            'tyreLabelRoll' => ['nullable'],
            'tyreSpeedRating' => ['nullable'],
            'tyreLabelWet' => ['nullable'],
            'tyreCFlag' => ['nullable'],
            'tyreLabelNoise1' => ['nullable'],
            'tyreCategoryInfo' => ['nullable'],
            'tyreLabelNoise2' => ['nullable'],
        ]);

        return $rules;
    }
}
