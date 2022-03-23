<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 ***************************************************
 * 勤務条件/ 勤務地/ 都道府県テーブル　Model
 ***************************************************
*/
class WorkingConditionLocation02Todohuken extends Model
{
    /*
    |--------------------------------------------------------------------------
    | データ挿入設定
    |--------------------------------------------------------------------------
    */
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['name','code','radion_id','checked',];




    /*
    |--------------------------------------------------------------------------
    | リレーション
    |--------------------------------------------------------------------------
    */
    # 市町村テーブルとのリレーション
    public function shichosons()
    {
        return $this->hasMany(WorkingConditionLocation03Shichoson::class,'todohuken_id');
    }


    # 鉄道会社テーブルとのリレーション
    public function train_companies()
    {
        return $this->hasMany(WorkingConditionTrain01Company::class,'todohuken_code','code');
    }





    /*
    |--------------------------------------------------------------------------
    | ローカルスコープ
    |--------------------------------------------------------------------------
    */
    #  API用データ取得
    public function scopeForApi($query, $radion_id)
    {
        $todohukens = $query->where('radion_id',$radion_id)->get();
        foreach ($todohukens as $todohuken) {

            //都道府県データとのリレーション
            $todohuken->rel_shichosons = WorkingConditionLocation03Shichoson::ForApi($todohuken->id);
        }
        return $todohukens;
    }




    /*
    |--------------------------------------------------------------------------
    | アクセサー
    |--------------------------------------------------------------------------
    */





}
