<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreZoneRequest;
use App\Http\Requests\UpdateZoneRequest;
use App\Models\Country;
use App\Models\Zone;

class ZoneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $zones = Zone::paginate(10);

        $breadcrumbs = [
            ['link' => route('dashboard'), 'name' => "Dashboard"], ['name' => "Zones"]
        ];

        return view('zones.list', compact('zones', 'breadcrumbs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $zone = new Zone();

        $countries = Country::all();

        $breadcrumbs = [
            ['link' => route('zones.index'), 'name' => "Zones"], ['name' => "Create"]
        ];

        return view('zones.form', compact('zone', 'breadcrumbs', 'countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreZoneRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreZoneRequest $request)
    {
        $data = $request->validated();

        $zone = Zone::create([
            'name' => $data['name'],
            'code' => $data['code'],
            'country_id' => $data['countryId'],
            'status' => $data['status']
        ]);

        return redirect('zones')->with('success', __('Zone Created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Zone  $zone
     * @return \Illuminate\Http\Response
     */
    public function show(Zone $zone)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Zone  $zone
     * @return \Illuminate\Http\Response
     */
    public function edit(Zone $zone)
    {
        $breadcrumbs = [
            ['link' => route('zones.index'), 'name' => "Zones"], ['name' => "Edit Zone"]
        ];

        $countries = Country::all();

        return view('zones.form', compact('zone', 'breadcrumbs', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateZoneRequest  $request
     * @param  \App\Models\Zone  $zone
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateZoneRequest $request, Zone $zone)
    {
        $data = $request->validated();

        $zone = $zone->update([
            'name' => $data['name'],
            'code' => $data['code'],
            'country_id' => $data['countryId'],
            'status' => $data['status']
        ]);

        return redirect('zones')->with('success', __('Zone Updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Zone  $zone
     * @return \Illuminate\Http\Response
     */
    public function destroy(Zone $zone)
    {
        $zone->delete();

        return redirect()->back()->with('success', __('Zone deleted.'));
    }
}
