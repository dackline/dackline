<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\StoreOptionRequest;
use App\Http\Requests\Admin\UpdateOptionRequest;
use App\Models\Option;

class OptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $options = Option::paginate(10);

        $breadcrumbs = [
            ['link' => route('admin::dashboard'), 'name' => "Dashboard"], ['name' => "Options"]
        ];

        return view('admin.options.list', compact('options', 'breadcrumbs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $option = new Option();

        $breadcrumbs = [
            ['link' => route('admin::options.index'), 'name' => "Options"], ['name' => "Create"]
        ];

        return view('admin.options.form', compact('option', 'breadcrumbs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Admin\StoreOptionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOptionRequest $request)
    {
        $locales = app('translatable.locales')->all();

        $validated = $request->validated();

        $data = [
            'sort_order' => $validated['sortOrder']?: 0,
            'type' => $validated['type'],
        ];

        foreach($locales as $locale) {
            $data[$locale]['name'] = $validated[$locale]['name'];
        }

        $option = Option::create($data);

        // create new option values
        if(isset($validated['optionValues'])) {
            $optionValues = [];
            foreach($validated['optionValues'] as $optionValue) {
                $data = [
                    'sort_order' => $optionValue['sortOrder'],
                    'option_id' => $option->id,
                ];

                foreach($locales as $locale) {
                    $data[$locale]['name'] = $optionValue[$locale]['name'];
                    $data[$locale]['option_id'] = $option->id;
                }
                $optionValues[] = $data;
                $option->values()->create($data);
            }
        }

        return redirect(route('admin::options.index'))->with('success', __('Option Created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function show(Option $option)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function edit(Option $option)
    {
        $option->load('values');

        $breadcrumbs = [
            ['link' => route('admin::options.index'), 'name' => "Options"], ['name' => "Edit"]
        ];

        return view('admin.options.form', compact('option', 'breadcrumbs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\UpdateOptionRequest  $request
     * @param  \App\Models\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOptionRequest $request, Option $option)
    {
        $locales = app('translatable.locales')->all();

        $validated = $request->validated();

        $data = [
            'type' => $validated['type'],
            'sort_order' => $validated['sortOrder'],
        ];

        foreach($locales as $locale) {
            $data[$locale]['name'] = $validated[$locale]['name'];
        }

        $option->update($data);

        // delete option values
        $option->values()->each(function($optionValue) {
            $optionValue->deleteTranslations();
        });

        $option->values()->delete();

        // create new option values
        if(isset($validated['optionValues'])) {
            $optionValues = [];
            foreach($validated['optionValues'] as $optionValue) {
                $data = [
                    'sort_order' => $optionValue['sortOrder'],
                    'option_id' => $option->id,
                ];

                foreach($locales as $locale) {
                    $data[$locale]['name'] = $optionValue[$locale]['name'];
                    $data[$locale]['option_id'] = $option->id;
                }
                $optionValues[] = $data;
                $option->values()->create($data);
            }
        }

        return redirect(route('admin::options.index'))->with('success', __('Option Updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function destroy(Option $option)
    {
        // Delete option value translation
        $option->values()->each(function($optionValue) {
            $optionValue->deleteTranslations();
        });

        // Delete option values
        $option->values()->delete();

        // Delete option details
        $option->deleteTranslations();

        // Delete option
        $option->delete();

        return redirect()->back()->with('success', __('Option Deleted.'));
    }
}
