<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 ***************************************************
 * 勤務条件/ 勤務地/ 地方テーブル　Model
 ***************************************************
*/
class WorkingConditionLocation01Redion extends Model
{
    /*
    |--------------------------------------------------------------------------
    | データ挿入設定
    |--------------------------------------------------------------------------
    */
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['name','checked','checked_children'];




    /*
    |--------------------------------------------------------------------------
    | リレーション
    |--------------------------------------------------------------------------
    */
    # 都道府県テーブルとのリレーション
    public function todohukens()
    {
        return $this->hasMany(WorkingConditionLocation02Todohuken::class,'radion_id');
    }





    /*
    |--------------------------------------------------------------------------
    | ローカルスコープ
    |--------------------------------------------------------------------------
    */
    # API用データ取得
    public function scopeForApi($query)
    {
        $radions = $query->get();
        foreach ($radions as $radion) {

            //都道府県データとのリレーション
            $radion->rel_todohukens = WorkingConditionLocation02Todohuken::forApi($radion->id);
            $radion->todohukens = WorkingConditionLocation02Todohuken::forApi($radion->id);

        }
        return $radions;
    }

    # API用データ取得 : 駅(路線)テーブルとのリレーション
    public function scopeForTrainApi($query)
    {
        $radions = $query->get();
        foreach ($radions as $radion) {

            //都道府県データとのリレーション
            $radion->rel_todohukens = WorkingConditionLocation02Todohuken::forTrainApi($radion->id);

        }
        return $radions;
    }



    /*
    |--------------------------------------------------------------------------
    | アクセサー
    |--------------------------------------------------------------------------
    */


}
