<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class indexController extends Controller
{
    public function __invoke()
    {
        $categories = \App\Models\Category::all();
        return view('category.index', compact('categories'));
    }
}
