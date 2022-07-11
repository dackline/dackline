<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class FileManagerController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.filemanager.filemanager');
    }
}
