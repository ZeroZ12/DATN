<?php

use App\Http\Controllers\Admin\DanhMucController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('danhmuc', DanhMucController::class);
});
