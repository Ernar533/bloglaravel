<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;

class EditController extends BaseController
{
    public function __invoke(Post $post)
    {
        $categories = \App\Models\Category::all();
        $tags = \App\Models\Tag::all();
        return view('admin.post.edit', compact('post' , 'categories', 'tags'));
    }
}
