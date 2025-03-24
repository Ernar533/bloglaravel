<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;

class indexController extends Controller
{
    public function __invoke()
    {
        $categories = \App\Models\Category::all();
        return view('admin.categories.index', compact('categories'));
    }
}
