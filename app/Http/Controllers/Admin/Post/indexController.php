<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;

class indexController extends BaseController
{
    public function __invoke()
    {
        $posts = \App\Models\Post::all();
        return view('admin.post.index', compact('posts'));
    }
}
