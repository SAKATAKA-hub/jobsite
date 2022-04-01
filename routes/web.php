<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\WorkingConditionController; // Controller(勤務条件)


/*
 * ===========================================
 *  default
 * ===========================================
 */
Route::get('/', function () {
    // return view('welcome');
    return redirect()->route('wc_list');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



/*
 * ===========================================
 *  勤務条件 (WorkingConditionController)
 * ===========================================
 */

# 勤務条件一覧(list)
Route::get('/working_condition/list',[WorkingConditionController::class,'list'])
->name('wc_list');


# 勤務地API(location_api)
Route::get('/working_condition/location/api',[WorkingConditionController::class,'location_api'])
->name('wc_location_api');

# 職種API(occupation_api)
Route::get('/working_condition/occupation/api',[WorkingConditionController::class,'occupation_api'])
->name('wc_occupation_api');

# 業種apI(industry_api)
Route::get('/working_condition/industry/api',[WorkingConditionController::class,'industry_api'])
->name('wc_industry_api');

# 駅API(train_api)
Route::get('/working_condition/train/api',[WorkingConditionController::class,'train_api'])
->name('wc_train_api');

# その他条件API(other_api)
Route::get('/working_condition/other/api',[WorkingConditionController::class,'other_api'])
->name('wc_other_api');



# 勤務地の更新(location_update)
Route::get('/working_condition/location/update',[WorkingConditionController::class,'location_update'])
->name('wc_location_update');

# 職種の更新(occupation_update)
Route::get('/working_condition/occupation/update',[WorkingConditionController::class,'occupation_update'])
->name('wc_occupation_update');

# 業種の更新(industry_update)
Route::get('/working_condition/industry/update',[WorkingConditionController::class,'industry_update'])
->name('wc_industry_update');

# 駅の更新(train_update)
Route::get('/working_condition/train/update',[WorkingConditionController::class,'train_update'])
->name('wc_train_update');

# その他条件の更新(other_update)
Route::get('/working_condition/other/update',[WorkingConditionController::class,'other_update'])
->name('wc_other_update');





/*
 * ===========================================
 *  test
 * ===========================================
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

