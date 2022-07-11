<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\StoreManufacturerRequest;
use App\Http\Requests\Admin\UpdateManufacturerRequest;
use App\Models\Manufacturer;
use App\Models\Store;

class ManufacturerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $manufacturers = Manufacturer::paginate(10);

        $breadcrumbs = [
            ['link' => route('admin::dashboard'), 'name' => "Dashboard"], ['name' => "Manufacturers"]
        ];

        return view('admin.manufacturers.list', compact('manufacturers', 'breadcrumbs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $manufacturer = new Manufacturer();

        $stores = Store::all();

        $breadcrumbs = [
            ['link' => route('admin::manufacturers.index'), 'name' => "Manufacturers"], ['name' => "Create"]
        ];

        return view('admin.manufacturers.form', compact('manufacturer', 'breadcrumbs', 'stores'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Admin\StoreManufacturerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreManufacturerRequest $request)
    {
        $locales = app('translatable.locales')->all();

        $validated = $request->validated();

        $data = [
            'name' => $validated['name'],
            'sort_order' => $validated['sortOrder'],
            'design_template' => $validated['designTemplate'],
            'image' => $validated['image'],
            'status' => $validated['status'],
        ];

        foreach($locales as $locale) {
            $data[$locale]['description'] = $validated[$locale]['description'];
            $data[$locale]['meta_title'] = $validated[$locale]['metaTitle'];
            $data[$locale]['meta_description'] = $validated[$locale]['metaDescription'];
            $data[$locale]['url'] = $validated[$locale]['url'];
        }

        $manufacturer = Manufacturer::create($data);

        // Update manufacturer to store
        if(isset($validated['storeId']) && count($validated['storeId']) > 0) {
            $manufacturer->stores()->attach($validated['storeId']);
        }

        return redirect(route('admin::manufacturers.index'))->with('success', __('Manufacturer Created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Manufacturer  $manufacturer
     * @return \Illuminate\Http\Response
     */
    public function show(Manufacturer $manufacturer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Manufacturer  $manufacturer
     * @return \Illuminate\Http\Response
     */
    public function edit(Manufacturer $manufacturer)
    {
        $stores = Store::all();

        $manufacturer->load('stores');

        $breadcrumbs = [
            ['link' => route('admin::manufacturers.index'), 'name' => "Manufacturers"], ['name' => "Edit"]
        ];

        return view('admin.manufacturers.form', compact('manufacturer', 'breadcrumbs', 'stores'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\UpdateManufacturerRequest  $request
     * @param  \App\Models\Manufacturer  $manufacturer
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateManufacturerRequest $request, Manufacturer $manufacturer)
    {
        $locales = app('translatable.locales')->all();

        $validated = $request->validated();

        $data = [
            'name' => $validated['name'],
            'sort_order' => $validated['sortOrder'],
            'design_template' => $validated['designTemplate'],
            'image' => $validated['image'],
            'status' => $validated['status'],
        ];

        foreach($locales as $locale) {
            $data[$locale]['description'] = $validated[$locale]['description'];
            $data[$locale]['meta_title'] = $validated[$locale]['metaTitle'];
            $data[$locale]['meta_description'] = $validated[$locale]['metaDescription'];
            $data[$locale]['url'] = $validated[$locale]['url'];
        }

        $manufacturer->update($data);

        // Update manufacturer to store
        $manufacturer->stores()->detach();
        if(isset($validated['storeId']) && count($validated['storeId']) > 0) {
            $manufacturer->stores()->attach($validated['storeId']);
        }

        return redirect(route('admin::manufacturers.index'))->with('success', __('Manufacturer Updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Manufacturer  $manufacturer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Manufacturer $manufacturer)
    {
        $manufacturer->stores()->detach();

        $manufacturer->deleteTranslations();

        $manufacturer->delete();

        return redirect()->back()->with('success', __('Manufacturer Deleted.'));
    }
}
