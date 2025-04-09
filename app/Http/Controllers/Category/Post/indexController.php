<?php

namespace App\Http\Controllers\Category\Post;

use App\Http\Controllers\Controller;
use App\Models\Category;

class IndexController extends Controller
{
    public function __invoke(Category $category)
    {
        $posts = $category->posts()
            ->with('category')
            ->withCount('likedUsers')
            ->paginate(6);

        return view('category.post.index', compact('posts'));
    }
}
