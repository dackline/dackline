<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInformationRequest;
use App\Http\Requests\UpdateInformationRequest;
use App\Models\Information;
use App\Models\Store;
use Astrotomic\Translatable\Locales;
use Locale;

class InformationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $informations = Information::paginate(10);

        $breadcrumbs = [
            ['link' => route('dashboard'), 'name' => "Dashboard"], ['name' => "Informations"]
        ];

        return view('informations.list', compact('informations', 'breadcrumbs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $information = new Information();

        $stores = Store::all();

        $breadcrumbs = [
            ['link' => route('informations.index'), 'name' => "Informations"], ['name' => "Create"]
        ];

        return view('informations.form', compact('information', 'breadcrumbs', 'stores'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreInformationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreInformationRequest $request)
    {
        $locales = app('translatable.locales')->all();
        $validated = $request->validated();
        $data = [
            'sort_order' => $validated['sortOrder'],
            'footer' => isset($validated['footer']) ? 1 : 0,
        ];
        foreach($locales as $locale) {
            $data[$locale]['title'] = $validated[$locale]['title'];
            $data[$locale]['description'] = $validated[$locale]['description'];
            $data[$locale]['meta_title'] = $validated[$locale]['metaTitle'];
            $data[$locale]['meta_description'] = $validated[$locale]['metaDescription'];
            $data[$locale]['url'] = $validated[$locale]['url'];
        }

        $information = Information::create($data);

        // Update information to store
        if(isset($validated['storeId']) && count($validated['storeId']) > 0) {
            $information->stores()->attach($validated['storeId']);
        }

        return redirect(route('informations.index'))->with('success', __('Information Created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Information  $information
     * @return \Illuminate\Http\Response
     */
    public function show(Information $information)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Information  $information
     * @return \Illuminate\Http\Response
     */
    public function edit(Information $information)
    {
        $stores = Store::all();

        $information->load('stores');

        $breadcrumbs = [
            ['link' => route('informations.index'), 'name' => "Informations"], ['name' => "Edit"]
        ];

        return view('informations.form', compact('information', 'breadcrumbs', 'stores'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateInformationRequest  $request
     * @param  \App\Models\Information  $information
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateInformationRequest $request, Information $information)
    {
        $locales = app('translatable.locales')->all();
        $validated = $request->validated();

        $data = [
            'sort_order' => $validated['sortOrder'],
            'footer' => isset($validated['footer']) ? 1 : 0,
        ];
        foreach($locales as $locale) {
            $data[$locale]['title'] = $validated[$locale]['title'];
            $data[$locale]['description'] = $validated[$locale]['description'];
            $data[$locale]['meta_title'] = $validated[$locale]['metaTitle'];
            $data[$locale]['meta_description'] = $validated[$locale]['metaDescription'];
            $data[$locale]['url'] = $validated[$locale]['url'];
        }

        $information->update($data);

        // Update information to store
        $information->stores()->detach();
        if(isset($validated['storeId']) && count($validated['storeId']) > 0) {
            $information->stores()->attach($validated['storeId']);
        }

        return redirect(route('informations.index'))->with('success', __('Information Updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Information  $information
     * @return \Illuminate\Http\Response
     */
    public function destroy(Information $information)
    {
        $information->stores()->detach();

        $information->deleteTranslations();

        $information->delete();

        return redirect()->back()->with('success', __('Information Deleted.'));
    }
}
