<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaxRequest;
use App\Http\Requests\UpdateTaxRequest;
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
            ['link' => route('dashboard'), 'name' => "Dashboard"], ['name' => "Taxes"]
        ];

        return view('taxes.list', compact('taxes', 'breadcrumbs'));
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
            ['link' => route('taxes.index'), 'name' => "Taxes"], ['name' => "Create"]
        ];

        return view('taxes.form', compact('tax', 'breadcrumbs', 'geoZones'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTaxRequest  $request
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

        return redirect(route('taxes.index'))->with('success', __('Tax Created.'));
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
            ['link' => route('taxes.index'), 'name' => "Taxes"], ['name' => "Edit Tax"]
        ];

        return view('taxes.form', compact('tax', 'breadcrumbs', 'geoZones'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTaxRequest  $request
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

        return redirect(route('taxes.index'))->with('success', __('Tax Updated.'));
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
