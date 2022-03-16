<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

/**
 ***************************************************
 * Seeder 勤務条件/ 業種データ挿入
 ***************************************************
*/
class WorkingConditionIndustryTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        # CSVデータパス
        $puth_industrys = 'data/csv/industrys.csv';


        # ファイルが存在しないときの処理
        if( !Storage::exists($puth_industrys) ){ return false; }


        # データのリセット(Controller読み込み時に必要な処理)
        $groups = \App\Models\WorkingConditionIndustry01Group::all();
        foreach ($groups as $group)
        {
            $group->delete();
        }


        # CSVファイルの読み込み
        $industrys_data = Method::f_get_csv($puth_industrys);


        foreach ($industrys_data as $data)
        {
            //1. 業種グループデータの挿入
            $industry1 = \App\Models\WorkingConditionIndustry01Group::where('name',$data['industry1'])->first();
            if ( empty($industry1) )
            {
                $industry1 = new \App\Models\WorkingConditionIndustry01Group([
                    'name' => $data['industry1'],
                ]);
                $industry1->save();
            }


            //2. 業種アイテムデータの挿入
            $industry2 = new \App\Models\WorkingConditionIndustry02Item([
                'name' => $data['industry2'],
                'group_id' => $industry1->id,
            ]);
            $industry2->save();

        }



        return true;
    }
}
