<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class SearchCustomerController extends Controller
{
    public function __invoke(Request $request)
    {
        $query = $request->input('query');

        if(!$request->has('query'))
            return [];

        return Customer::query()
            ->where('first_name', 'like', '%'. strtolower($query) .'%')
            ->orWhere('last_name', 'like', '%'. strtolower($query) .'%')
            ->with(['addresses'])
            ->paginate(10);
    }
}
