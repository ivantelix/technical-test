<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return view('home');
});

Route::get('/getValue', [HomeController::class, 'getValue'])->name('getValue');
Route::get('/export', [HomeController::class, 'export'])->name('export');