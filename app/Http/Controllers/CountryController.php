<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCountryRequest;
use App\Http\Requests\UpdateCountryRequest;
use App\Models\Country;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countries = Country::paginate(10);

        $breadcrumbs = [
            ['link' => route('dashboard'), 'name' => "Dashboard"], ['name' => "Countries"]
        ];

        return view('countries.list', compact('countries', 'breadcrumbs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $country = new Country();

        $breadcrumbs = [
            ['link' => route('countries.index'), 'name' => "Countries"], ['name' => "Create"]
        ];

        return view('countries.form', compact('country', 'breadcrumbs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCountryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCountryRequest $request)
    {
        $data = $request->validated();

        $country = Country::create([
            'name' => $data['name'],
            'iso_code_2' => $data['isoCode2'],
            'iso_code_3' => $data['isoCode3'],
            'postcode_required' => $data['postcodeRequired'],
            'status' => $data['status']
        ]);

        return redirect('countries')->with('success', __('Country Created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function show(Country $country)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function edit(Country $country)
    {
        $breadcrumbs = [
            ['link' => route('countries.index'), 'name' => "Countries"], ['name' => "Edit Country"]
        ];

        return view('countries.form', compact('country', 'breadcrumbs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCountryRequest  $request
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCountryRequest $request, Country $country)
    {
        $data = $request->validated();

        $country = $country->update([
            'name' => $data['name'],
            'iso_code_2' => $data['isoCode2'],
            'iso_code_3' => $data['isoCode3'],
            'postcode_required' => $data['postcodeRequired'],
            'status' => $data['status']
        ]);

        return redirect('countries')->with('success', __('Country Updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function destroy(Country $country)
    {
        $country->delete();

        return redirect()->back()->with('success', __('Country deleted.'));
    }
}
