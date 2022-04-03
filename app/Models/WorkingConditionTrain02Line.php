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
    protected $fillable = ['name','code','company_id','checked','checked_children',];




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
    | ローカルスコープ
    |--------------------------------------------------------------------------
    */
    # API用データ取得
    public function scopeForApi($query, $company_id)
    {
        $lines = $query->where('company_id',$company_id)->get();
        foreach ($lines as $line) {

            $company = WorkingConditionTrain01Company::find($line->company_id);
            // dd($company->todohuken_code);

            // 駅テーブルとのリレーション
            $line->rel_stations = WorkingConditionTrain03Station::
            where('line_code', $line->code) //鉄道会社の指定
            ->where('todohuken_code', $company->todohuken_code) //駅の都道府県の指定
            ->get();

            // $line->rel_stations =['name'=>$line->id];
        }
        return $lines;
    }




    /*
    |--------------------------------------------------------------------------
    | アクセサー
    |--------------------------------------------------------------------------
    */


}
