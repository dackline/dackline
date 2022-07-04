<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Manufacturer;
use App\Models\Option;
use App\Models\Product;
use App\Models\StockStatus;
use App\Models\Store;
use App\Models\Tax;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate(10);

        $breadcrumbs = [
            ['link' => route('dashboard'), 'name' => "Dashboard"], ['name' => "Products"]
        ];

        return view('products.list', compact('products', 'breadcrumbs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product = new Product();
        $taxes = Tax::all();
        $stockStatuses = StockStatus::all();
        $manufacturers = Manufacturer::all();
        $stores = Store::all();
        $categories = Category::fullName();
        $options = Option::with('values', 'values.translations', 'translations')->get();
        $productOptions = [];

        $breadcrumbs = [
            ['link' => route('products.index'), 'name' => "Products"], ['name' => "Create"]
        ];

        return view('products.form', compact('product', 'breadcrumbs', 'taxes', 'stockStatuses', 'manufacturers', 'stores', 'categories', 'options', 'productOptions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        $locales = app('translatable.locales')->all();

        $validated = $request->validated();

        $data = [
            'article_nr' => $validated['articleNr'],
            'ean' => $validated['ean'],
            'sku' => $validated['sku'],
            'location' => $validated['location'],
            'price' => (float)$validated['price'],
            'tax_id' => $validated['taxId'] ?: null,
            'manufacturer_id' => $validated['manufacturerId'] ?: null,
            'url' => $validated['url'],
            'design_template' => $validated['designTemplate'],
            'quantity' => (int)$validated['quantity'],
            'minimum_quantity' => (int)$validated['minimumQuantity'],
            'subtract' => isset($validated['subtract']) ? 1 : 0,
            'stock_status_id' => $validated['stockStatusId'] ?: null,
            'date_available' => $validated['dateAvailable'],
            'weight' => (float)$validated['weight'],
            'sort_order' => (int)$validated['sortOrder'],
            'status' => (int)$validated['status'],
        ];

        foreach($locales as $locale) {
            $data[$locale]['product_name'] = $validated[$locale]['productName'];
            $data[$locale]['description'] = $validated[$locale]['description'];
            $data[$locale]['meta_title'] = $validated[$locale]['metaTitle'];
            $data[$locale]['meta_description'] = $validated[$locale]['metaDescription'];
            $data[$locale]['seo_h1_tag'] = $validated[$locale]['seoH1Tag'];
        }

        $product = Product::create($data);

        // Update product to store
        if(isset($validated['storeId']) && count($validated['storeId']) > 0) {
            $product->stores()->attach($validated['storeId']);
        }

        // Update categories to store
        if(isset($validated['categoryId']) && count($validated['categoryId']) > 0) {
            $product->categories()->attach($validated['categoryId']);
        }

        // product options
        if($request->has('productOption') && count($request->input('productOption')) > 0) {
            foreach($request->input('productOption') as $productOptionItem) {
                $productOption = $product->productOptions()->create([
                    'option_id' => $productOptionItem['optionId'],
                    'value' => '',
                    'required' => $productOptionItem['required'],
                ]);

                foreach($productOptionItem['productOptionValue'] as $productOptionValueItem) {
                    $productOption->productOptionValues()->create([
                        'product_option_id' => $productOption->id,
                        'product_id' => $product->id,
                        'option_id' => $productOptionItem['optionId'],
                        'option_value_id' => $productOptionValueItem['optionValueId'],
                        'quantity' => (int)$productOptionValueItem['quantity'],
                        'subtract' => (int)$productOptionValueItem['subtract'],
                        'price' => (float)$productOptionValueItem['price'],
                        'price_prefix' => $productOptionValueItem['pricePrefix'],
                        'weight' => (float)$productOptionValueItem['weight'],
                        'weight_prefix' => $productOptionValueItem['weightPrefix'],
                    ]);
                }
            }
        }

        return redirect(route('products.index'))->with('success', __('Product Created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $taxes = Tax::all();
        $stockStatuses = StockStatus::all();
        $manufacturers = Manufacturer::all();
        $stores = Store::all();
        $categories = Category::fullName();
        $options = Option::with('values', 'values.translations', 'translations')->get();

        $product->with(['productOptions', 'productOptions.option', 'productOptions.productOptionValues']);

        // format product options
        $productOptions = [];
        foreach($product->productOptions as $productOption) {
            $productOptionValues = [];

            foreach($productOption->productOptionValues as $productOptionValue) {
                $productOptionValues[] = [
                    'productOptionId' => $productOptionValue->product_option_id,
                    'productId' => $productOptionValue->product_id,
                    'optionId' => $productOptionValue->option_id,
                    'optionValueId' => $productOptionValue->option_value_id,
                    'optionValue' => '',
                    'quantity' => $productOptionValue->quantity,
                    'subtract' => $productOptionValue->subtract,
                    'price' => $productOptionValue->price,
                    'pricePrefix' => $productOptionValue->price_prefix,
                    'weight' => $productOptionValue->weight,
                    'weightPrefix' => $productOptionValue->weight_prefix,
                ];
            }

            $productOptions[] = [
                'id' => $productOption->id,
                'optionId' => $productOption->option_id,
                'type' => '',
                'name' => $productOption->option->name,
                'required' => $productOption->required,
                'optionValues' => $productOptionValues,
            ];
        }

        $breadcrumbs = [
            ['link' => route('products.index'), 'name' => "Products"], ['name' => "Edit"]
        ];

        return view('products.form', compact('product', 'breadcrumbs', 'taxes', 'stockStatuses', 'manufacturers', 'stores', 'categories', 'options', 'productOptions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $locales = app('translatable.locales')->all();

        $validated = $request->validated();

        $data = [
            'article_nr' => $validated['articleNr'],
            'ean' => $validated['ean'],
            'sku' => $validated['sku'],
            'location' => $validated['location'],
            'price' => (float)$validated['price'],
            'tax_id' => $validated['taxId'] ?: null,
            'manufacturer_id' => $validated['manufacturerId'] ?: null,
            'url' => $validated['url'],
            'design_template' => $validated['designTemplate'],
            'quantity' => (int)$validated['quantity'],
            'minimum_quantity' => (int)$validated['minimumQuantity'],
            'subtract' => isset($validated['subtract']) ? 1 : 0,
            'stock_status_id' => $validated['stockStatusId'] ?: null,
            'date_available' => $validated['dateAvailable'],
            'weight' => (float)$validated['weight'],
            'sort_order' => (int)$validated['sortOrder'],
            'status' => (int)$validated['status'],
        ];

        foreach($locales as $locale) {
            $data[$locale]['product_name'] = $validated[$locale]['productName'];
            $data[$locale]['description'] = $validated[$locale]['description'];
            $data[$locale]['meta_title'] = $validated[$locale]['metaTitle'];
            $data[$locale]['meta_description'] = $validated[$locale]['metaDescription'];
            $data[$locale]['seo_h1_tag'] = $validated[$locale]['seoH1Tag'];
        }

        $product->update($data);

        // Update product to store
        $product->stores()->detach();
        if(isset($validated['storeId']) && count($validated['storeId']) > 0) {
            $product->stores()->attach($validated['storeId']);
        }

        // Update categories to store
        $product->categories()->detach();
        if(isset($validated['categoryId']) && count($validated['categoryId']) > 0) {
            $product->categories()->attach($validated['categoryId']);
        }

        // product options
        $product->load('productOptions');
        foreach($product->productOptions as $productOption) {
            $productOption->productOptionValues()->delete();
            $productOption->delete();
        }

        if($request->has('productOption') && count($request->input('productOption')) > 0) {
            foreach($request->input('productOption') as $productOptionItem) {
                $productOption = $product->productOptions()->create([
                    'option_id' => $productOptionItem['optionId'],
                    'value' => '',
                    'required' => $productOptionItem['required'],
                ]);

                foreach($productOptionItem['productOptionValue'] as $productOptionValueItem) {
                    $productOption->productOptionValues()->create([
                        'product_option_id' => $productOption->id,
                        'product_id' => $product->id,
                        'option_id' => $productOptionItem['optionId'],
                        'option_value_id' => $productOptionValueItem['optionValueId'],
                        'quantity' => (int)$productOptionValueItem['quantity'],
                        'subtract' => (int)$productOptionValueItem['subtract'],
                        'price' => (float)$productOptionValueItem['price'],
                        'price_prefix' => $productOptionValueItem['pricePrefix'],
                        'weight' => (float)$productOptionValueItem['weight'],
                        'weight_prefix' => $productOptionValueItem['weightPrefix'],
                    ]);
                }
            }
        }

        return redirect(route('products.index'))->with('success', __('Product Updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->deleteTranslations();

        $product->delete();

        return redirect()->back()->with('success', __('Product Deleted.'));
    }
}
