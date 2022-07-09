<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerGroupRequest;
use App\Http\Requests\UpdateCustomerGroupRequest;
use App\Models\CustomerGroup;

class CustomerGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customerGroups = CustomerGroup::paginate(10);

        $breadcrumbs = [
            ['link' => route('dashboard'), 'name' => "Dashboard"], ['name' => __('Customer Groups')]
        ];

        return view('customer-groups.list', compact('customerGroups', 'breadcrumbs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customerGroup = new CustomerGroup();

        $breadcrumbs = [
            ['link' => route('customer-groups.index'), 'name' => "Customer Groups"], ['name' => "Create"]
        ];

        return view('customer-groups.form', compact('customerGroup', 'breadcrumbs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCustomerGroupRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCustomerGroupRequest $request)
    {
        $locales = app('translatable.locales')->all();

        $validated = $request->validated();

        $data = [];

        foreach($locales as $locale) {
            $data[$locale]['name'] = $validated[$locale]['name'];
            $data[$locale]['description'] = $validated[$locale]['description'];
        }

        $customerGroup = CustomerGroup::create($data);

        return redirect(route('customer-groups.index'))->with('success', __('Customer Group Created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CustomerGroup  $customerGroup
     * @return \Illuminate\Http\Response
     */
    public function show(CustomerGroup $customerGroup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CustomerGroup  $customerGroup
     * @return \Illuminate\Http\Response
     */
    public function edit(CustomerGroup $customerGroup)
    {
        $breadcrumbs = [
            ['link' => route('customer-groups.index'), 'name' => "Customer Groups"], ['name' => "Edit"]
        ];

        return view('customer-groups.form', compact('customerGroup', 'breadcrumbs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCustomerGroupRequest  $request
     * @param  \App\Models\CustomerGroup  $customerGroup
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCustomerGroupRequest $request, CustomerGroup $customerGroup)
    {
        $locales = app('translatable.locales')->all();

        $validated = $request->validated();

        $data = [];

        foreach($locales as $locale) {
            $data[$locale]['name'] = $validated[$locale]['name'];
            $data[$locale]['description'] = $validated[$locale]['description'];
        }

        $customerGroup->update($data);

        return redirect(route('customer-groups.index'))->with('success', __('Customer Group Updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CustomerGroup  $customerGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy(CustomerGroup $customerGroup)
    {
        $customerGroup->deleteTranslations();

        $customerGroup->delete();

        return redirect()->back()->with('success', __('Customer Group Deleted.'));
    }
}
