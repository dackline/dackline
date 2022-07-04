<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Models\Store;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::paginate(10);

        $breadcrumbs = [
            ['link' => route('dashboard'), 'name' => "Dashboard"], ['name' => "Categories"]
        ];

        return view('categories.list', compact('categories', 'breadcrumbs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = new Category();

        $stores = Store::all();
        $categories = Category::all();

        $breadcrumbs = [
            ['link' => route('categories.index'), 'name' => "Categories"], ['name' => "Create"]
        ];

        return view('categories.form', compact('category', 'breadcrumbs', 'stores', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        $locales = app('translatable.locales')->all();

        $validated = $request->validated();

        $data = [
            'parent_id' => $validated['parentId'],
            'sort_order' => (int)$validated['sortOrder'],
            'design_template' => $validated['designTemplate'],
            'image' => $validated['image'],
            'status' => $validated['status'],
        ];

        foreach($locales as $locale) {
            $data[$locale]['name'] = $validated[$locale]['name'];
            $data[$locale]['description'] = $validated[$locale]['description'];
            $data[$locale]['meta_title'] = $validated[$locale]['metaTitle'];
            $data[$locale]['meta_description'] = $validated[$locale]['metaDescription'];
            $data[$locale]['title_tag'] = $validated[$locale]['titleTag'];
            $data[$locale]['alt_tag'] = $validated[$locale]['altTag'];
        }

        $category = Category::create($data);

        // Update category to store
        if(isset($validated['storeId']) && count($validated['storeId']) > 0) {
            $category->stores()->attach($validated['storeId']);
        }

        return redirect(route('categories.index'))->with('success', __('Category Created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $stores = Store::all();

        $category->load('stores');
        $categories = Category::whereNotIn('id', [$category->id])->get();

        $breadcrumbs = [
            ['link' => route('categories.index'), 'name' => "Categories"], ['name' => "Edit"]
        ];

        return view('categories.form', compact('category', 'breadcrumbs', 'stores', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoryRequest  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $locales = app('translatable.locales')->all();

        $validated = $request->validated();

        $data = [
            'parent_id' =>  $validated['parentId'],
            'sort_order' => $validated['sortOrder'],
            'design_template' => $validated['designTemplate'],
            'image' => $validated['image'],
            'status' => $validated['status'],
        ];

        foreach($locales as $locale) {
            $data[$locale]['name'] = $validated[$locale]['name'];
            $data[$locale]['description'] = $validated[$locale]['description'];
            $data[$locale]['meta_title'] = $validated[$locale]['metaTitle'];
            $data[$locale]['meta_description'] = $validated[$locale]['metaDescription'];
            $data[$locale]['title_tag'] = $validated[$locale]['titleTag'];
            $data[$locale]['alt_tag'] = $validated[$locale]['altTag'];
        }

        $category->update($data);

        // Update category to store
        $category->stores()->detach();
        if(isset($validated['storeId']) && count($validated['storeId']) > 0) {
            $category->stores()->attach($validated['storeId']);
        }

        return redirect(route('categories.index'))->with('success', __('Category Updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        // Check if category assigned as parent to another category then we will not allow user to delete it
        $isAssigned = Category::where('parent_id', $category->id)->count();
        if($isAssigned > 0) {
            return redirect()->back()->with('error', __('Unable to delete category. Category is assigned as parent category.'));
        }

        $category->stores()->detach();

        $category->deleteTranslations();

        $category->delete();

        return redirect()->back()->with('success', __('Category Deleted.'));
    }
}
