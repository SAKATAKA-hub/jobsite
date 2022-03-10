<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


/*
 * ===============================
 *  test
 * ==============================
 */
Route::get('/test/test', function () {
    return view('test.test');
})->name('test.test');
