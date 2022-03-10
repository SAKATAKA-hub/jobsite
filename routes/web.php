<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;


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


# 勤務地データの更新(update_location_data)
Route::get('/test/update_location_data',[TestController::class,'update_location_data'])
->name('test.update_location_data');






# (tmpl)ファイルの操作
Route::get('/test/file',
[App\Http\Controllers\TmplFileController::class,'file'])
->name('test.file');

