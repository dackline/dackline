<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStoreRequest;
use App\Http\Requests\UpdateStoreRequest;
use App\Models\Country;
use App\Models\Currency;
use App\Models\Store;
use App\Models\Tax;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stores = Store::paginate(10);

        $breadcrumbs = [
            ['link' => route('dashboard'), 'name' => "Dashboard"], ['name' => "Stores"]
        ];

        return view('stores.list', compact('stores', 'breadcrumbs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::all(['id', 'name']);
        $currencies = Currency::all(['id', 'title']);
        $taxes = Tax::all(['id', 'tax_name']);

        $store = new Store();

        $breadcrumbs = [
            ['link' => route('stores.index'), 'name' => "Stores"], ['name' => "Create"]
        ];

        return view('stores.form', compact('store', 'breadcrumbs', 'countries', 'currencies', 'taxes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStoreRequest $request)
    {
        $data = $request->validated();

        $store = Store::create([
            'store_name' => $data['storeName'],
            'store_url' => $data['storeUrl'],
            'meta_title' => $data['metaTitle'],
            'meta_description' => $data['metaDescription'],
            'meta_keywords' => $data['metaKeywords'],
            'email' => $data['email'],
            'address' => $data['address'],
            'phone' => $data['phone'],
            'currency_id' => $data['currencyId'],
            'country_id' => $data['countryId'],
            'tax_id' => $data['taxId'],
            'default' => $request->has('default') ? 1 : 0,
        ]);

        // remove other default store
        if($request->has('default')) {
            Store::whereNotIn('id', [$store->id])
                ->update([
                    'default' => 0
                ]);
        }

        return redirect(route('stores.index'))->with('success', __('Store Created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function show(Store $store)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function edit(Store $store)
    {
        $countries = Country::all(['id', 'name']);
        $currencies = Currency::all(['id', 'title']);
        $taxes = Tax::all(['id', 'tax_name']);

        $store->with(['country', 'currency', 'tax']);

        $breadcrumbs = [
            ['link' => route('stores.index'), 'name' => "Stores"], ['name' => "Edit Store"]
        ];

        return view('stores.form', compact('store', 'breadcrumbs', 'countries', 'currencies', 'taxes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStoreRequest  $request
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStoreRequest $request, Store $store)
    {
        $data = $request->validated();

        $store->update([
            'store_name' => $data['storeName'],
            'store_url' => $data['storeUrl'],
            'meta_title' => $data['metaTitle'],
            'meta_description' => $data['metaDescription'],
            'meta_keywords' => $data['metaKeywords'],
            'email' => $data['email'],
            'address' => $data['address'],
            'phone' => $data['phone'],
            'currency_id' => $data['currencyId'],
            'country_id' => $data['countryId'],
            'tax_id' => $data['taxId'],
            'default' => $request->has('default') ? 1 : 0,
        ]);

        // remove other default store
        if($request->has('default')) {
            Store::whereNotIn('id', [$store->id])
                ->update([
                    'default' => 0
                ]);
        }

        return redirect(route('stores.index'))->with('success', __('Store Updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function destroy(Store $store)
    {
        // do not allow user to delete default store
        if($store->default) {
            return redirect()->back()->with('error', __('Unable to delete default store.'));
        }

        $store->delete();

        return redirect()->back()->with('success', __('Store deleted.'));
    }
}
