<?php

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

// Маршрут для главной страницы
Route::group(['namespace' => 'Main'], function () {
    Route::get('/', [MainIndexController::class, '__invoke']);
});

// Группа маршрутов для админки
Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function () {
    Route::group(['namespace' => 'Main'], function () {
        Route::get('/', [AdminIndexController::class, '__invoke']);
    });

    Route::group(['namespace' => 'Post','prefix' =>"posts"], function () {
        Route::get('/', [PostIndexController::class, '__invoke'])->name('admin.post.index');
        Route::get('/create', [PostCreateController::class, '__invoke'])->name('admin.post.create');
        Route::post('/', [PostStoreController::class, '__invoke'])->name('admin.post.store');
        Route::get('/{post}', [PostShowController::class, '__invoke'])->name('admin.post.show');
        Route::get('/{post}/edit', [PostEditController::class, '__invoke'])->name('admin.post.edit');
        Route::patch('/{post}', [PostUpdateController::class, '__invoke'])->name('admin.post.update');
        Route::delete('/{post}', [PostDeleteController::class, '__invoke'])->name('admin.post.delete');
    });

    Route::group(['namespace' => 'Category','prefix' =>"categories"], function () {
        Route::get('/', [CategoryIndexController::class, '__invoke'])->name('admin.category.index');
        Route::get('/create', [CreateIndexController::class, '__invoke'])->name('admin.category.create');
        Route::post('/', [StoreIndexController::class, '__invoke'])->name('admin.category.store');
        Route::get('/{category}', [ShowIndexController::class, '__invoke'])->name('admin.category.show');
        Route::get('/{category}/edit', [EditIndexController::class, '__invoke'])->name('admin.category.edit');
        Route::patch('/{category}', [UpdateIndexController::class, '__invoke'])->name('admin.category.update');
        Route::delete('/{category}', [DeleteIndexController::class, '__invoke'])->name('admin.category.delete');
    });


    Route::group(['namespace' => 'Tag','prefix' =>"tags"], function () {
        Route::get('/', [TagIndexController::class, '__invoke'])->name('admin.tag.index');
        Route::get('/create', [TagCreateController::class, '__invoke'])->name('admin.tag.create');
        Route::post('/', [TagStoreController::class, '__invoke'])->name('admin.tag.store');
        Route::get('/{tag}', [TagShowController::class, '__invoke'])->name('admin.tag.show');
        Route::get('/{tag}/edit', [TagEditController::class, '__invoke'])->name('admin.tag.edit');
        Route::patch('/{tag}', [TagUpdateController::class, '__invoke'])->name('admin.tag.update');
        Route::delete('/{tag}', [TagDeleteController::class, '__invoke'])->name('admin.tag.delete');
    });
});
// Аутентификация
Auth::routes();
