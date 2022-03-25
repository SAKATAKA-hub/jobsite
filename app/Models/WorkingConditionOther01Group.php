<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 ***************************************************
 * 勤務条件/ その他条件/ グループ　Model
 ***************************************************
*/
class WorkingConditionOther01Group extends Model
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
    # その他条件アイテムテーブルとのリレーション
    public function items()
    {
        return $this->hasMany(WorkingConditionOther02Item::class,'group_id');
    }




    /*
    |--------------------------------------------------------------------------
    | ローカルスコープ
    |--------------------------------------------------------------------------
    */
    # API用データ取得
    public function scopeForApi($query)
    {
        $groups = $query->get();
        foreach ($groups as $group) {

            // その他条件アイテムテーブルとのリレーション
            $group->rel_items = WorkingConditionOther02Item::where('group_id',$group->id)->get();
        }
        return $groups;
    }

    /*
    |--------------------------------------------------------------------------
    | アクセサー
    |--------------------------------------------------------------------------
    */
}
