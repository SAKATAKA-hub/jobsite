<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;


class WorkingConditionLocationTablesSeeder extends Seeder
{
    /**
     * 勤務地テーブルデータの挿入
     *
     * @return void
     */
    public function run()
    {
        # 勤務地のCSVデータパス
        $puth_todohukens = 'data/csv/location/todohukens.csv';
        $puth_shikuchosons = 'data/csv/location/shikuchosons.csv';
        $puth_kus = 'data/csv/location/kus.csv';

        # ファイルが存在しないときの処理
        if( !(
            Storage::exists($puth_todohukens) &&
            Storage::exists($puth_shikuchosons) &&
            Storage::exists($puth_kus)
        ) ){ return ; }


        $redion = new \App\Models\WorkingConditionLocation01Redion([
            'name' => '関東',
        ]);
        $redion->save();


        $todohuken = new \App\Models\WorkingConditionLocation02Todohuken([
            'name' => '東京(test)',
            'code' => 100,
            'radion_id' => $redion->id,
        ]);
        $todohuken->save();


    }
}
