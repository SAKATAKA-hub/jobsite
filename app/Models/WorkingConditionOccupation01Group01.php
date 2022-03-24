<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 ***************************************************
 * 勤務条件/ 職種/ グループ01　Model
 ***************************************************
*/
class WorkingConditionOccupation01Group01 extends Model
{
    /*
    |--------------------------------------------------------------------------
    | データ挿入設定
    |--------------------------------------------------------------------------
    */
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['name','checked'];




    /*
    |--------------------------------------------------------------------------
    | リレーション
    |--------------------------------------------------------------------------
    */
    # 都道府県テーブルとのリレーション
    public function group02s()
    {
        return $this->hasMany(WorkingConditionOccupation02Group02::class,'group01_id');
    }




    /*
    |--------------------------------------------------------------------------
    | ローカルスコープ
    |--------------------------------------------------------------------------
    */
    #  API用データ取得
    public function scopeForApi($query)
    {
        $group01s = $query->get();
        foreach ($group01s as $group01) {

            //都道府県データとのリレーション
            $group01->rel_group02s = WorkingConditionOccupation02Group02::forApi($group01->id);
        }
        return $group01s;
    }

    /*
    |--------------------------------------------------------------------------
    | アクセサー
    |--------------------------------------------------------------------------
    */





}
