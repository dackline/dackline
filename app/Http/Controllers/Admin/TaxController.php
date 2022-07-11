<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\StoreTaxRequest;
use App\Http\Requests\Admin\UpdateTaxRequest;
use App\Models\GeoZone;
use App\Models\Tax;

class TaxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $taxes = Tax::paginate(10);

        $breadcrumbs = [
            ['link' => route('admin::dashboard'), 'name' => "Dashboard"], ['name' => "Taxes"]
        ];

        return view('admin.taxes.list', compact('taxes', 'breadcrumbs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tax = new Tax();

        $geoZones = GeoZone::all();

        $breadcrumbs = [
            ['link' => route('admin::taxes.index'), 'name' => "Taxes"], ['name' => "Create"]
        ];

        return view('admin.taxes.form', compact('tax', 'breadcrumbs', 'geoZones'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Admin\StoreTaxRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTaxRequest $request)
    {
        $data = $request->validated();

        $tax = Tax::create([
            'tax_name' => $data['taxName'],
            'tax_rate' => $data['taxRate'],
            'type' => $data['type'],
            'geo_zone_id' => $data['geoZoneId'],
            'status' => $data['status']
        ]);

        return redirect(route('admin::taxes.index'))->with('success', __('Tax Created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tax  $tax
     * @return \Illuminate\Http\Response
     */
    public function show(Tax $tax)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tax  $tax
     * @return \Illuminate\Http\Response
     */
    public function edit(Tax $tax)
    {
        $tax->with('geoZone');

        $geoZones = GeoZone::all();

        $breadcrumbs = [
            ['link' => route('admin::taxes.index'), 'name' => "Taxes"], ['name' => "Edit Tax"]
        ];

        return view('admin.taxes.form', compact('tax', 'breadcrumbs', 'geoZones'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\UpdateTaxRequest  $request
     * @param  \App\Models\Tax  $tax
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTaxRequest $request, Tax $tax)
    {
        $data = $request->validated();

        $tax = $tax->update([
            'tax_name' => $data['taxName'],
            'tax_rate' => $data['taxRate'],
            'type' => $data['type'],
            'geo_zone_id' => $data['geoZoneId'],
            'status' => $data['status']
        ]);

        return redirect(route('admin::taxes.index'))->with('success', __('Tax Updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tax  $tax
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tax $tax)
    {
        $tax->delete();

        return redirect()->back()->with('success', __('Tax Deleted.'));
    }
}
