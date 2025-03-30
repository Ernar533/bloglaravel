<?php

use App\Http\Controllers\Personal\Main\indexController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Main\IndexController as MainIndexController;
use App\Http\Controllers\Admin\Main\IndexController as AdminIndexController;
use App\Http\Controllers\Admin\Category\IndexController as CategoryIndexController;
use App\Http\Controllers\Admin\Category\CreateController as CreateIndexController;
use App\Http\Controllers\Admin\Category\StoreController as StoreIndexController;
use App\Http\Controllers\Admin\Category\ShowController as ShowIndexController;
use App\Http\Controllers\Admin\Category\EditController as EditIndexController;
use App\Http\Controllers\Admin\Category\UpdateController as UpdateIndexController;
use App\Http\Controllers\Admin\Category\DeleteController as DeleteIndexController;

use App\Http\Controllers\Admin\Tag\IndexController as TagIndexController;
use App\Http\Controllers\Admin\Tag\CreateController as TagCreateController;
use App\Http\Controllers\Admin\Tag\StoreController as TagStoreController;
use App\Http\Controllers\Admin\Tag\ShowController as TagShowController;
use App\Http\Controllers\Admin\Tag\EditController as TagEditController;
use App\Http\Controllers\Admin\Tag\UpdateController as TagUpdateController;
use App\Http\Controllers\Admin\Tag\DeleteController as TagDeleteController;

use App\Http\Controllers\Admin\Post\IndexController as PostIndexController;
use App\Http\Controllers\Admin\Post\CreateController as PostCreateController;
use App\Http\Controllers\Admin\Post\StoreController as PostStoreController;
use App\Http\Controllers\Admin\Post\ShowController as PostShowController;
use App\Http\Controllers\Admin\Post\EditController as PostEditController;
use App\Http\Controllers\Admin\Post\UpdateController as PostUpdateController;
use App\Http\Controllers\Admin\Post\DeleteController as PostDeleteController;

use App\Http\Controllers\Admin\User\IndexController as UserIndexController;
use App\Http\Controllers\Admin\User\CreateController as UserCreateController;
use App\Http\Controllers\Admin\User\StoreController as UserStoreController;
use App\Http\Controllers\Admin\User\ShowController as UserShowController;
use App\Http\Controllers\Admin\User\EditController as UserEditController;
use App\Http\Controllers\Admin\User\UpdateController as UserUpdateController;
use App\Http\Controllers\Admin\User\DeleteController as UserDeleteController;

// Подключаем контроллер для выхода
use App\Http\Controllers\HomeController;

// Маршрут для главной страницы
Route::group(['namespace' => 'Main'], function () {
    Route::get('/', [MainIndexController::class, '__invoke']);
});

Route::group(['namespace' => 'Personal', 'prefix' => 'personal', 'middleware' => ['auth', 'verified']], function () {
    Route::group(['namespace' => 'Main'], function () {
        Route::get('/', [IndexController::class, '__invoke'])->name('personal.main.index');
    });
}); // ❗ Закрыли группу Personal

// Группа маршрутов для админки
Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => ['auth', 'admin', 'verified']], function () {
    Route::group(['namespace' => 'Main'], function () {
        Route::get('/', [AdminIndexController::class, '__invoke'])->name('admin.main.index');
    });
    Route::group(['namespace' => 'Liked'], function () {
        Route::get('/', [IndexController::class, '__invoke'])->name('admin.liked.index');
    });
    Route::group(['namespace' => 'Comment'], function () {
        Route::get('/', [IndexController::class, '__invoke'])->name('admin.comment.index');
    });

    Route::group(['namespace' => 'Post', 'prefix' => 'posts'], function () {
        Route::get('/', [PostIndexController::class, '__invoke'])->name('admin.post.index');
        Route::get('/create', [PostCreateController::class, '__invoke'])->name('admin.post.create');
        Route::post('/', [PostStoreController::class, '__invoke'])->name('admin.post.store');
        Route::get('/{post}', [PostShowController::class, '__invoke'])->name('admin.post.show');
        Route::get('/{post}/edit', [PostEditController::class, '__invoke'])->name('admin.post.edit');
        Route::patch('/{post}', [PostUpdateController::class, '__invoke'])->name('admin.post.update');
        Route::delete('/{post}', [PostDeleteController::class, '__invoke'])->name('admin.post.delete');
    });

    Route::group(['namespace' => 'Category', 'prefix' => 'categories'], function () {
        Route::get('/', [CategoryIndexController::class, '__invoke'])->name('admin.category.index');
        Route::get('/create', [CreateIndexController::class, '__invoke'])->name('admin.category.create');
        Route::post('/', [StoreIndexController::class, '__invoke'])->name('admin.category.store');
        Route::get('/{category}', [ShowIndexController::class, '__invoke'])->name('admin.category.show');
        Route::get('/{category}/edit', [EditIndexController::class, '__invoke'])->name('admin.category.edit');
        Route::patch('/{category}', [UpdateIndexController::class, '__invoke'])->name('admin.category.update');
        Route::delete('/{category}', [DeleteIndexController::class, '__invoke'])->name('admin.category.delete');
    });

    Route::group(['namespace' => 'Tag', 'prefix' => 'tags'], function () {
        Route::get('/', [TagIndexController::class, '__invoke'])->name('admin.tag.index');
        Route::get('/create', [TagCreateController::class, '__invoke'])->name('admin.tag.create');
        Route::post('/', [TagStoreController::class, '__invoke'])->name('admin.tag.store');
        Route::get('/{tag}', [TagShowController::class, '__invoke'])->name('admin.tag.show');
        Route::get('/{tag}/edit', [TagEditController::class, '__invoke'])->name('admin.tag.edit');
        Route::patch('/{tag}', [TagUpdateController::class, '__invoke'])->name('admin.tag.update');
        Route::delete('/{tag}', [TagDeleteController::class, '__invoke'])->name('admin.tag.delete');
    });

    Route::group(['namespace' => 'User', 'prefix' => 'users'], function () {
        Route::get('/', [UserIndexController::class, '__invoke'])->name('admin.user.index');
        Route::get('/create', [UserCreateController::class, '__invoke'])->name('admin.user.create');
        Route::post('/', [UserStoreController::class, '__invoke'])->name('admin.user.store');
        Route::get('/{user}', [UserShowController::class, '__invoke'])->name('admin.user.show');
        Route::get('/{user}/edit', [UserEditController::class, '__invoke'])->name('admin.user.edit');
        Route::patch('/{user}', [UserUpdateController::class, '__invoke'])->name('admin.user.update');
        Route::delete('/{user}', [UserDeleteController::class, '__invoke'])->name('admin.user.delete');
    });
});

// ✅ Добавляем маршрут для выхода (logout) через POST
Route::post('/logout', [HomeController::class, 'logout'])->name('logout');

// ✅ Оставляем стандартные маршруты аутентификации Laravel
Auth::routes(['verify' => true]);
