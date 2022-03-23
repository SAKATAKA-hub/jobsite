<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 ***************************************************
 * 勤務条件/ 駅(路線)/ 路線　Model
 ***************************************************
*/
class WorkingConditionTrain02Line extends Model
{
    /*
    |--------------------------------------------------------------------------
    | データ挿入設定
    |--------------------------------------------------------------------------
    */
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['name','code','company_id','checked'];




    /*
    |--------------------------------------------------------------------------
    | リレーション
    |--------------------------------------------------------------------------
    */
    # 鉄道会社テーブルとのリレーション
    public function company()
    {
        return $this->belongsTo(WorkingConditionTrain01Company::class,'company_id');
    }

    # 駅テーブルとのリレーション
    public function stations()
    {
        return $this->hasMany(WorkingConditionTrain03Station::class,'line_code','code');
    }






    /*
    |--------------------------------------------------------------------------
    | アクセサー
    |--------------------------------------------------------------------------
    */





    /*
    |--------------------------------------------------------------------------
    | ローカルスコープ
    |--------------------------------------------------------------------------
    */

}
