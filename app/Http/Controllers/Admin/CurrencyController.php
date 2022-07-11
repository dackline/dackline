<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\StoreCurrencyRequest;
use App\Http\Requests\Admin\UpdateCurrencyRequest;
use App\Models\Currency;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currencies = Currency::paginate(10);

        $breadcrumbs = [
            ['link' => route('admin::dashboard'), 'name' => "Dashboard"], ['name' => "Currencies"]
        ];

        return view('admin.currencies.list', compact('currencies', 'breadcrumbs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $currency = new Currency();

        $breadcrumbs = [
            ['link' => route('admin::currencies.index'), 'name' => "Currencies"], ['name' => "Create"]
        ];

        return view('admin.currencies.form', compact('currency', 'breadcrumbs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Admin\StoreCurrencyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCurrencyRequest $request)
    {
        $data = $request->validated();

        $currency = Currency::create([
            'title' => $data['currencyTitle'],
            'code' => $data['code'],
            'symbol_left' => $data['symbolLeft'],
            'symbol_right' => $data['symbolRight'],
            'decimal_places' => $data['decimalPlaces'],
            'value' => $data['value'],
            'status' => $data['status']
        ]);

        return redirect(route('admin::currencies.index'))->with('success', __('Currency Created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function show(Currency $currency)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function edit(Currency $currency)
    {
        $breadcrumbs = [
            ['link' => route('admin::currencies.index'), 'name' => "Currencies"], ['name' => "Edit Currency"]
        ];

        return view('admin.currencies.form', compact('currency', 'breadcrumbs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\UpdateCurrencyRequest  $request
     * @param  \App\Models\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCurrencyRequest $request, Currency $currency)
    {
        $data = $request->validated();

        $currency = $currency->update([
            'title' => $data['currencyTitle'],
            'code' => $data['code'],
            'symbol_left' => $data['symbolLeft'],
            'symbol_right' => $data['symbolRight'],
            'decimal_places' => $data['decimalPlaces'],
            'value' => $data['value'],
            'status' => $data['status']
        ]);

        return redirect(route('admin::currencies.index'))->with('success', __('Currency Updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function destroy(Currency $currency)
    {
        $currency->delete();

        return redirect()->back()->with('success', __('Currency Deleted.'));
    }
}
