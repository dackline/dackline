<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'theme' => ['required']
        ]);

        $theme = $validated['theme'] == 'light' ? 'dark' : 'light';

        $request->session()->put('theme', $theme);

        return redirect()->back();
    }
}
