<?php

namespace App\Http\Controllers\Personal\Liked;

use App\Http\Controllers\Controller;
use App\Models\Post;

class DeleteController extends Controller
{
    public function __invoke(Post $post)
    {
        // Удаляем лайк от текущего пользователя
        auth()->user()->likedPosts()->detach($post->id);

        // Перенаправляем на страницу со списком понравившихся постов
        return redirect()->route('personal.liked.index');
    }
}
