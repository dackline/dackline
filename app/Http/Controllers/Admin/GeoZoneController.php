<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\StoreGeoZoneRequest;
use App\Http\Requests\Admin\UpdateGeoZoneRequest;
use App\Models\Country;
use App\Models\GeoZone;

class GeoZoneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $geoZones = GeoZone::paginate(10);

        $breadcrumbs = [
            ['link' => route('admin::dashboard'), 'name' => "Dashboard"], ['name' => "Geo Zones"]
        ];

        return view('admin.geo_zones.list', compact('geoZones', 'breadcrumbs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $geoZone = new GeoZone();

        $countries = Country::all();

        $breadcrumbs = [
            ['link' => route('admin::geo-zones.index'), 'name' => "Geo Zones"], ['name' => "Create"]
        ];

        return view('admin.geo_zones.form', compact('geoZone', 'breadcrumbs', 'countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Admin\StoreGeoZoneRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGeoZoneRequest $request)
    {
        $data = $request->validated();

        $geoZone = GeoZone::create([
            'name' => $data['name'],
            'description' => $data['description'],
        ]);

        if(isset($data['geoZones'])) {
            foreach($data['geoZones'] as $zone) {
                if($zone['countryId'] && $zone['zoneId']) {
                    $geoZone->zones()->attach($zone['zoneId'], ['country_id' => $zone['countryId']]);
                }
            }
        }

        return redirect(route('admin::geo-zones.index'))->with('success', __('Geo Zone Created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GeoZone  $geoZone
     * @return \Illuminate\Http\Response
     */
    public function show(GeoZone $geoZone)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GeoZone  $geoZone
     * @return \Illuminate\Http\Response
     */
    public function edit(GeoZone $geoZone)
    {
        $countries = Country::all();

        $geoZone->with(['zones']);

        $breadcrumbs = [
            ['link' => route('admin::geo-zones.index'), 'name' => "Geo Zones"], ['name' => "Edit Geo Zone"]
        ];

        return view('admin.geo_zones.form', compact('geoZone', 'breadcrumbs', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\UpdateGeoZoneRequest  $request
     * @param  \App\Models\GeoZone  $geoZone
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGeoZoneRequest $request, GeoZone $geoZone)
    {
        $data = $request->validated();

        $geoZone->update([
            'name' => $data['name'],
            'description' => $data['description'],
        ]);

        $geoZone->zones()->detach();
        if(isset($data['geoZones'])) {
            foreach($data['geoZones'] as $zone) {
                if($zone['countryId'] && $zone['zoneId']) {
                    $geoZone->zones()->attach($zone['zoneId'], ['country_id' => $zone['countryId']]);
                }
            }
        }

        return redirect(route('admin::geo-zones.index'))->with('success', __('Geo Zone Updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GeoZone  $geoZone
     * @return \Illuminate\Http\Response
     */
    public function destroy(GeoZone $geoZone)
    {
        $geoZone->delete();

        return redirect()->back()->with('success', __('Geo Zone Deleted.'));
    }
}
