<?php

namespace App\Http\Controllers\Personal\Liked;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;

class indexController extends Controller
{
    public function __invoke()
    {
        $posts = auth()->user()->likedPosts;

        return view('personal.liked.index', compact('posts'));
    }
}
