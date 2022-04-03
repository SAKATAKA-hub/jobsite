<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 ***************************************************
 * 勤務条件/ 勤務地/ 市町村テーブル　Model
 ***************************************************
*/
class WorkingConditionLocation03Shichoson extends Model
{
    /*
    |--------------------------------------------------------------------------
    | データ挿入設定
    |--------------------------------------------------------------------------
    */
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['name','code','todohuken_id','checked','checked_children',];




    /*
    |--------------------------------------------------------------------------
    | リレーション
    |--------------------------------------------------------------------------
    */
    public function kus()
    {
        return $this->hasMany(WorkingConditionLocation04Ku::class,'shichoson_id');
    }





    /*
    |--------------------------------------------------------------------------
    | ローカルスコープ
    |--------------------------------------------------------------------------
    */
        #  API用データ取得
        public function scopeForApi($query, $todohuken_id)
        {
            $shichosons = $query->where('todohuken_id',$todohuken_id)->get();
            foreach ($shichosons as $shichoson) {

                //都道府県データとのリレーション
                $shichoson->rel_kus = WorkingConditionLocation04Ku::where('shichoson_id',$shichoson->id)->get();
                $shichoson->kus = WorkingConditionLocation04Ku::where('shichoson_id',$shichoson->id)->get();

            }
            return $shichosons;
        }




    /*
    |--------------------------------------------------------------------------
    | アクセサー
    |--------------------------------------------------------------------------
    */


}
