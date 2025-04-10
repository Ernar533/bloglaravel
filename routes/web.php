<?php

use App\Http\Controllers\Post\IndexController;
use App\Http\Controllers\Post\ShowController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Main\IndexController as MainIndexController;
use App\Http\Controllers\Admin\Main\IndexController as AdminIndexController;
use App\Http\Controllers\Personal\Main\IndexController as PersonalIndexController;
use App\Http\Controllers\Personal\Liked\IndexController as LikedIndexController;
use App\Http\Controllers\Personal\Comment\IndexController as CommentIndexController;
use App\Http\Controllers\HomeController;

// Категории
use App\Http\Controllers\Admin\Category\IndexController as CategoryIndexController;
use App\Http\Controllers\Admin\Category\CreateController as CategoryCreateController;
use App\Http\Controllers\Admin\Category\StoreController as CategoryStoreController;
use App\Http\Controllers\Admin\Category\ShowController as CategoryShowController;
use App\Http\Controllers\Admin\Category\EditController as CategoryEditController;
use App\Http\Controllers\Admin\Category\UpdateController as CategoryUpdateController;
use App\Http\Controllers\Admin\Category\DeleteController as CategoryDeleteController;

// Тэги
use App\Http\Controllers\Admin\Tag\IndexController as TagIndexController;
use App\Http\Controllers\Admin\Tag\CreateController as TagCreateController;
use App\Http\Controllers\Admin\Tag\StoreController as TagStoreController;
use App\Http\Controllers\Admin\Tag\ShowController as TagShowController;
use App\Http\Controllers\Admin\Tag\EditController as TagEditController;
use App\Http\Controllers\Admin\Tag\UpdateController as TagUpdateController;
use App\Http\Controllers\Admin\Tag\DeleteController as TagDeleteController;

// Посты
use App\Http\Controllers\Admin\Post\IndexController as PostIndexController;
use App\Http\Controllers\Admin\Post\CreateController as PostCreateController;
use App\Http\Controllers\Admin\Post\StoreController as PostStoreController;
use App\Http\Controllers\Admin\Post\ShowController as PostShowController;
use App\Http\Controllers\Admin\Post\EditController as PostEditController;
use App\Http\Controllers\Admin\Post\UpdateController as PostUpdateController;
use App\Http\Controllers\Admin\Post\DeleteController as PostDeleteController;

// Пользователи
use App\Http\Controllers\Admin\User\IndexController as UserIndexController;
use App\Http\Controllers\Admin\User\CreateController as UserCreateController;
use App\Http\Controllers\Admin\User\StoreController as UserStoreController;
use App\Http\Controllers\Admin\User\ShowController as UserShowController;
use App\Http\Controllers\Admin\User\EditController as UserEditController;
use App\Http\Controllers\Admin\User\UpdateController as UserUpdateController;
use App\Http\Controllers\Admin\User\DeleteController as UserDeleteController;

Route::group(['namespace' => 'Main'], function () {
    Route::get('/', [MainIndexController::class, '__invoke'])->name('main.index');
});

Route::group(['namespace' => 'Post', 'prefix' => 'posts'], function () {
    Route::get('/', [IndexController::class, '__invoke'])->name('post.index');
    Route::get('/{post}', [ShowController::class, '__invoke'])->name('post.show');

    Route::group(['namespace' => 'Comment', 'prefix' => '{post}/comments'], function () {
        Route::post('/', [\App\Http\Controllers\Post\Comment\StoreController::class, '__invoke'])
            ->name('post.comment.store');
    });

    Route::group(['namespace' => 'Like', 'prefix' => '{post}/likes'], function () {
        Route::post('/', [\App\Http\Controllers\Post\Like\StoreController::class, '__invoke'])
            ->name('post.like.store');
    });
});
Route::group(['namespace' => 'Category', 'prefix'=>'categories'], function () {
    Route::get('/', [\App\Http\Controllers\Category\indexController::class, '__invoke'])->name('category.index');

    Route::group(['namespace' => 'Post', 'prefix' => '{category}/posts'], function () {
        Route::get('/', [\App\Http\Controllers\Category\Post\IndexController::class, '__invoke'])
            ->name('category.post.index');
    });
});

// Личный кабинет
Route::group(['prefix' => 'personal', 'middleware' => ['auth', 'verified']], function () {
    Route::get('/', [PersonalIndexController::class, '__invoke'])->name('personal.main.index');

    Route::group(['prefix' => 'liked'], function () {
        Route::get('/', [LikedIndexController::class, '__invoke'])->name('personal.liked.index');
        Route::delete('/{post}', [\App\Http\Controllers\Personal\Liked\DeleteController::class, '__invoke'])->name('personal.liked.delete');
    });

    Route::group(['prefix' => 'comments'], function () {
        Route::get('/', [CommentIndexController::class, '__invoke'])->name('personal.comment.index');
        Route::get('/{comment}/edit', [\App\Http\Controllers\Personal\Comment\EditController::class, '__invoke'])->name('personal.comment.edit');
        Route::patch('/{comment}', [\App\Http\Controllers\Personal\Comment\UpdateController::class, '__invoke'])->name('personal.comment.update');
        Route::delete('/{comment}', [\App\Http\Controllers\Personal\Comment\StoreController::class, '__invoke'])->name('personal.comment.delete');
    });
});

// Админка
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin', 'verified']], function () {
    Route::get('/', [AdminIndexController::class, '__invoke'])->name('admin.main.index');

    Route::group(['prefix' => 'posts'], function () {
        Route::get('/', [PostIndexController::class, '__invoke'])->name('admin.post.index');
        Route::get('/create', [PostCreateController::class, '__invoke'])->name('admin.post.create');
        Route::post('/', [PostStoreController::class, '__invoke'])->name('admin.post.store');
        Route::get('/{post}', [PostShowController::class, '__invoke'])->name('admin.post.show');
        Route::get('/{post}/edit', [PostEditController::class, '__invoke'])->name('admin.post.edit');
        Route::patch('/{post}', [PostUpdateController::class, '__invoke'])->name('admin.post.update');
        Route::delete('/{post}', [PostDeleteController::class, '__invoke'])->name('admin.post.delete');
    });

    Route::group(['prefix' => 'categories'], function () {
        Route::get('/', [CategoryIndexController::class, '__invoke'])->name('admin.category.index');
        Route::get('/create', [CategoryCreateController::class, '__invoke'])->name('admin.category.create');
        Route::post('/', [CategoryStoreController::class, '__invoke'])->name('admin.category.store');
        Route::get('/{category}', [CategoryShowController::class, '__invoke'])->name('admin.category.show');
        Route::get('/{category}/edit', [CategoryEditController::class, '__invoke'])->name('admin.category.edit');
        Route::patch('/{category}', [CategoryUpdateController::class, '__invoke'])->name('admin.category.update');
        Route::delete('/{category}', [CategoryDeleteController::class, '__invoke'])->name('admin.category.delete');
    });

    Route::group(['prefix' => 'tags'], function () {
        Route::get('/', [TagIndexController::class, '__invoke'])->name('admin.tag.index');
        Route::get('/create', [TagCreateController::class, '__invoke'])->name('admin.tag.create');
        Route::post('/', [TagStoreController::class, '__invoke'])->name('admin.tag.store');
        Route::get('/{tag}', [TagShowController::class, '__invoke'])->name('admin.tag.show');
        Route::get('/{tag}/edit', [TagEditController::class, '__invoke'])->name('admin.tag.edit');
        Route::patch('/{tag}', [TagUpdateController::class, '__invoke'])->name('admin.tag.update');
        Route::delete('/{tag}', [TagDeleteController::class, '__invoke'])->name('admin.tag.delete');
    });

    Route::group(['prefix' => 'users'], function () {
        Route::get('/', [UserIndexController::class, '__invoke'])->name('admin.user.index');
        Route::get('/create', [UserCreateController::class, '__invoke'])->name('admin.user.create');
        Route::post('/', [UserStoreController::class, '__invoke'])->name('admin.user.store');
        Route::get('/{user}', [UserShowController::class, '__invoke'])->name('admin.user.show');
        Route::get('/{user}/edit', [UserEditController::class, '__invoke'])->name('admin.user.edit');
        Route::patch('/{user}', [UserUpdateController::class, '__invoke'])->name('admin.user.update');
        Route::delete('/{user}', [UserDeleteController::class, '__invoke'])->name('admin.user.delete');
    });
});

Route::post('/logout', [HomeController::class, 'logout'])->name('logout');
Auth::routes(['verify' => true]);
