<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class SearchProductController extends Controller
{
    public function __invoke(Request $request)
    {
        $query = $request->input('query');

        if(!$request->has('query'))
            return [];

        return Product::whereTranslationLike('product_name', '%'. strtolower($query) .'%')
            ->orWhere('article_nr', 'like', '%'. strtolower($query) .'%')
            ->orWhere('sku', 'like', '%'. strtolower($query) .'%')
            ->withTranslation()
            ->with(['tax'])
            ->paginate(10);
    }
}
