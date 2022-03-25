<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 ***************************************************
 * 勤務条件/ 職種/ グループ02　Model
 ***************************************************
*/
class WorkingConditionOccupation02Group02 extends Model
{
    /*
    |--------------------------------------------------------------------------
    | データ挿入設定
    |--------------------------------------------------------------------------
    */
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['name','group01_id','checked'];




    /*
    |--------------------------------------------------------------------------
    | リレーション
    |--------------------------------------------------------------------------
    */
    # 職種アイテムテーブルとのリレーション
    public function items()
    {
        return $this->hasMany(WorkingConditionOccupation03Item::class,'group02_id');
    }




    /*
    |--------------------------------------------------------------------------
    | ローカルスコープ
    |--------------------------------------------------------------------------
    */
    #  API用データ取得
    public function scopeForApi($query, $group01_id)
    {
        $group02s = $query->where('group01_id',$group01_id)->get();
        foreach ($group02s as $group02) {

            //職種アイテムテーブルとのリレーション
            $group02->rel_items = WorkingConditionOccupation03Item::where('group02_id',$group02->id)->get();
        }
        return $group02s;
    }




    /*
    |--------------------------------------------------------------------------
    | アクセサー
    |--------------------------------------------------------------------------
    */

}
