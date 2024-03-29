<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 ***************************************************
 * 勤務条件/ 駅(路線)/ 鉄道会社　Model
 ***************************************************
*/
class WorkingConditionTrain01Company extends Model
{
    /*
    |--------------------------------------------------------------------------
    | データ挿入設定
    |--------------------------------------------------------------------------
    */
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['name','code','todohuken_code','checked','checked_children',];



    /*
    |--------------------------------------------------------------------------
    | リレーション
    |--------------------------------------------------------------------------
    */
    # 路線テーブルとのリレーション
    public function lines()
    {
        return $this->hasMany(WorkingConditionTrain02Line::class,'company_id');
    }




    /*
    |--------------------------------------------------------------------------
    | ローカルスコープ
    |--------------------------------------------------------------------------
    */
    #  API用データ取得
    public function scopeForApi($query,$todohuken_code)
    {
        $companys = $query->get();
        $companys = $query->where('todohuken_code',$todohuken_code)->get();

        foreach ($companys as $company) {

            //路線テーブルとのリレーション
            $company->rel_lines = WorkingConditionTrain02Line::forApi($company->id);;
        }
        return $companys;
    }

    /*
    |--------------------------------------------------------------------------
    | アクセサー
    |--------------------------------------------------------------------------
    */
}
