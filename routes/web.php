<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Main\IndexController;

Route::group(['namespace' => 'Main'], function () {
    Route::get('/', [IndexController::class, '__invoke']);
});
Auth::routes();
