<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 ***************************************************
 * 勤務条件/ 業種/ グループ　Model
 ***************************************************
*/
class WorkingConditionIndustry01Group extends Model
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
    # 業種アイテムテーブルとのリレーション
    public function items()
    {
        return $this->hasMany(WorkingConditionIndustry02Item::class,'group_id');
    }




    /*
    |--------------------------------------------------------------------------
    | ローカルスコープ
    |--------------------------------------------------------------------------
    */
    #  API用データ取得
    public function scopeForApi($query)
    {
        $groups = $query->get();
        foreach ($groups as $group) {

            //業種アイテムテーブルとのリレーション
            $group->rel_items = WorkingConditionIndustry02Item::where('group_id',$group->id)->get();
        }
        return $groups;
    }

    /*
    |--------------------------------------------------------------------------
    | アクセサー
    |--------------------------------------------------------------------------
    */
}
