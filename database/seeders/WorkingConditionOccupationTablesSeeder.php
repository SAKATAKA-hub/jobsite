<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

/**
 ***************************************************
 * Seeder 勤務条件/ 職種データ挿入
 ***************************************************
*/
class WorkingConditionOccupationTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        # CSVデータパス
        $puth_occupations = 'data/csv/occupations.csv';


        # ファイルが存在しないときの処理
        if( !Storage::exists($puth_occupations) ){ return false; }


        # データのリセット(Controller読み込み時に必要な処理)
        $groups = \App\Models\WorkingConditionOccupation01Group01::all();
        foreach ($groups as $group)
        {
            $group->delete();
        }


        # CSVファイルの読み込み
        $occupations_data = Method::f_get_csv($puth_occupations);


        foreach ($occupations_data as $data)
        {
            //1. 職種グループ01データの挿入
            $occupation1 = \App\Models\WorkingConditionOccupation01Group01::where('name',$data['occupation1'])->first();
            if ( empty($occupation1) )
            {
                $occupation1 = new \App\Models\WorkingConditionOccupation01Group01([
                    'name' => $data['occupation1'],
                ]);
                $occupation1->save();
            }


            //2.職種グループ02データの挿入
            $occupation2 = \App\Models\WorkingConditionOccupation02Group02::where('name',$data['occupation2'])->first();
            if ( empty($occupation2) )
            {
                $occupation2 = new \App\Models\WorkingConditionOccupation02Group02([
                    'name' => $data['occupation2'],
                    'group01_id' => $occupation1->id,
                ]);
                $occupation2->save();
            }

            //3.職種itemデータの挿入
            $occupation3 = new \App\Models\WorkingConditionOccupation03Item([
                'name' => $data['occupation3'],
                'group02_id' => $occupation2->id,
            ]);
            $occupation3->save();
        }




        return true;
    }
}
