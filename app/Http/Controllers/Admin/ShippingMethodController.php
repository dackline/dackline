<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreShippingMethodRequest;
use App\Http\Requests\UpdateShippingMethodRequest;
use App\Models\GeoZone;
use App\Models\ShippingMethod;
use App\Models\Store;
use Illuminate\Http\RedirectResponse;

class ShippingMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shippingMethods = ShippingMethod::paginate(10);

        $breadcrumbs = [
            ['link' => route('admin::dashboard'), 'name' => __('Dashboard')], ['name' => __('Shipping Methods')]
        ];

        return view('admin.shipping-methods.list', compact('breadcrumbs', 'shippingMethods'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $shippingMethod = new ShippingMethod();
        $stores = Store::all();
        $geoZones = GeoZone::all();

        $breadcrumbs = [
            ['link' => route('admin::shipping-methods.index'), 'name' => __('Shipping Methods')], ['name' => __('Create')]
        ];

        return view('admin.shipping-methods.form', compact('shippingMethod', 'breadcrumbs', 'stores', 'geoZones'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Admin\StoreShippingMethodRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreShippingMethodRequest $request): \Illuminate\Http\RedirectResponse
    {
        $validated = $request->validated();

        $shippingMethod = ShippingMethod::create([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'total' => (float)$validated['total'],
            'cost' => (float)$validated['cost'],
            'store_id' => $validated['storeId'] ?? null,
            'geo_zone_id' => $validated['geoZoneId'] ?? null,
            'status' => (int)$validated['status'],
        ]);

        return redirect(route('admin::shipping-methods.index'))->with('success', __('Shipping Method Created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  ShippingMethod  $shippingMethod
     * @return \Illuminate\Http\Response
     */
    public function show(ShippingMethod $shippingMethod)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ShippingMethod  $shippingMethod
     * @return \Illuminate\Http\Response
     */
    public function edit(ShippingMethod $shippingMethod)
    {
        $stores = Store::all();
        $geoZones = GeoZone::all();

        $shippingMethod->with(['store', 'geoZone']);

        $breadcrumbs = [
            ['link' => route('admin::shipping-methods.index'), 'name' => __('Shipping Methods')], ['name' => __('Edit Shipping Method')]
        ];

        return view('admin.shipping-methods.form', compact('shippingMethod', 'breadcrumbs', 'stores', 'geoZones'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\UpdateShippingMethodRequest  $request
     * @param  ShippingMethod  $shippingMethod
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateShippingMethodRequest $request, ShippingMethod $shippingMethod): \Illuminate\Http\RedirectResponse
    {
        $validated = $request->validated();

        $shippingMethod->update([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'total' => (float)$validated['total'],
            'cost' => (float)$validated['cost'],
            'store_id' => $validated['storeId'] ?? null,
            'geo_zone_id' => $validated['geoZoneId'] ?? null,
            'status' => (int)$validated['status'],
        ]);

        return redirect(route('admin::shipping-methods.index'))->with('success', __('Shipping Method Updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  ShippingMethod  $shippingMethod
     * @return RedirectResponse
     */
    public function destroy(ShippingMethod $shippingMethod): RedirectResponse
    {
        $shippingMethod->delete();

        return redirect()->back()->with('success', __('Shipping Method deleted.'));
    }
}
