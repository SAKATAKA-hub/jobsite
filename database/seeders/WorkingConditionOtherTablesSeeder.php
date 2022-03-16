<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

/**
 ***************************************************
 * Seeder 勤務条件/ その他条件データ挿入
 ***************************************************
*/
class WorkingConditionOtherTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        # CSVデータパス
        $puth_others = 'data/csv/others.csv';


        # ファイルが存在しないときの処理
        if( !Storage::exists($puth_others) ){ return false; }


        # データのリセット(Controller読み込み時に必要な処理)
        $groups = \App\Models\WorkingConditionOther01Group::all();
        foreach ($groups as $group)
        {
            $group->delete();
        }


        # CSVファイルの読み込み
        $others_data = Method::f_get_csv($puth_others);


        foreach ($others_data as $data)
        {
            //1. 業種グループデータの挿入
            $group = \App\Models\WorkingConditionOther01Group::where('name',$data['group'])->first();
            if ( empty($group) )
            {
                $group = new \App\Models\WorkingConditionOther01Group([
                    'name' => $data['group'],
                ]);
                $group->save();
            }


            //2. 業種アイテムデータの挿入
            $item = new \App\Models\WorkingConditionOther02Item([
                'name' => $data['item'],
                'group_id' => $group->id,
            ]);
            $item->save();

        }



        return true;
    }
}
