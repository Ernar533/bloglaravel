<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Main\IndexController as MainIndexController;
use App\Http\Controllers\Admin\Main\IndexController as AdminIndexController;
use App\Http\Controllers\Admin\Category\IndexController as CategoryIndexController;

// Маршрут для главной страницы
Route::group(['namespace' => 'Main'], function () {
    Route::get('/', [MainIndexController::class, '__invoke']);
});

// Группа маршрутов для админки
Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function () {
    Route::group(['namespace' => 'Main'], function () {
        Route::get('/', [AdminIndexController::class, '__invoke']);
    });

    Route::group(['namespace' => 'Category','prefix' =>"categories"], function () {
        Route::get('/', [CategoryIndexController::class, '__invoke'])->name('category.index');
    });
});
// Аутентификация
Auth::routes();
