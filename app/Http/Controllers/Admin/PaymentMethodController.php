<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePaymentMethodRequest;
use App\Http\Requests\Admin\UpdatePaymentMethodRequest;
use App\Models\GeoZone;
use App\Models\PaymentMethod;
use App\Models\Store;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paymentMethods = PaymentMethod::paginate(10);

        $breadcrumbs = [
            ['link' => route('admin::dashboard'), 'name' => __('Dashboard')], ['name' => __('Payment Methods')]
        ];

        return view('admin.payment-methods.list', compact('breadcrumbs', 'paymentMethods'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $paymentMethod = new PaymentMethod();
        $stores = Store::all();
        $geoZones = GeoZone::all();

        $breadcrumbs = [
            ['link' => route('admin::payment-methods.index'), 'name' => __('Payment Methods')], ['name' => __('Create')]
        ];

        return view('admin.payment-methods.form', compact('paymentMethod', 'breadcrumbs', 'stores', 'geoZones'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Admin\StorePaymentMethodRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePaymentMethodRequest $request): \Illuminate\Http\RedirectResponse
    {
        $validated = $request->validated();

        $paymentMethod = PaymentMethod::create([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'total' => (float)$validated['total'],
            'cost' => (float)$validated['cost'],
            'store_id' => $validated['storeId'] ?? null,
            'geo_zone_id' => $validated['geoZoneId'] ?? null,
            'status' => (int)$validated['status'],
        ]);

        return redirect(route('admin::payment-methods.index'))->with('success', __('Payment Method Created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(PaymentMethod $paymentMethod)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PaymentMethod  $paymentMethod
     * @return \Illuminate\Http\Response
     */
    public function edit(PaymentMethod $paymentMethod)
    {
        $stores = Store::all();
        $geoZones = GeoZone::all();

        $paymentMethod->with(['store', 'geoZone']);

        $breadcrumbs = [
            ['link' => route('admin::payment-methods.index'), 'name' => __('Payment Methods')], ['name' => __('Edit Payment Method')]
        ];

        return view('admin.payment-methods.form', compact('paymentMethod', 'breadcrumbs', 'stores', 'geoZones'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\UpdatePaymentMethodRequest  $request
     * @param  PaymentMethod  $paymentMethod
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdatePaymentMethodRequest $request, PaymentMethod $paymentMethod): \Illuminate\Http\RedirectResponse
    {
        $validated = $request->validated();

        $paymentMethod->update([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'total' => (float)$validated['total'],
            'cost' => (float)$validated['cost'],
            'store_id' => $validated['storeId'] ?? null,
            'geo_zone_id' => $validated['geoZoneId'] ?? null,
            'status' => (int)$validated['status'],
        ]);

        return redirect(route('admin::payment-methods.index'))->with('success', __('Payment Method Updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  PaymentMethod  $paymentMethod
     * @return RedirectResponse
     */
    public function destroy(PaymentMethod $paymentMethod): RedirectResponse
    {
        $paymentMethod->delete();

        return redirect()->back()->with('success', __('Payment Method deleted.'));
    }
}
