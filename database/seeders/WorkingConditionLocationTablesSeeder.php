<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

/**
 ***************************************************
 * 勤務条件/ 勤務地データ挿入　Seeder
 ***************************************************
*/
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
        ) ){ return false; }


        # 勤務地データのリセット(Controller読み込み時に必要な処理)
        $redions = \App\Models\WorkingConditionLocation01Redion::all();
        foreach ($redions as $redion)
        {
            $redion->delete();
        }


        # CSVファイルの読み込み
        $todohuken_data = Method::f_get_csv($puth_todohukens);
        $shikuchoson_data = Method::f_get_csv($puth_shikuchosons);
        $ku_data = Method::f_get_csv($puth_kus);




        /**
         * --------------------------------
         *  1.地方データ 2.都道府県データの挿入
         * --------------------------------
        */
        $redion_name = '';
        foreach ($todohuken_data as $data)
        {
            //1. 地方データの挿入
            if ( $data['redion_name'] !== $redion_name )
            {
                $redion_name = $data['redion_name'];

                $redion = new \App\Models\WorkingConditionLocation01Redion([
                    'name' => $data['redion_name'],
                ]);
                $redion->save();
            }

            //2. 都道府県データの挿入
            $todohuken = new \App\Models\WorkingConditionLocation02Todohuken([
                'name' => $data['todohuken_name'],
                'code' => sprintf('%02d', $data['todohuken_code']),
                'radion_id' => $redion->id,
            ]);
            $todohuken->save();
        }




        /**
         * --------------------------------
         *  3.市町村データの挿入
         * --------------------------------
        */
        // 東京23区(市町村テーブル)データの挿入
        $todohuken = \App\Models\WorkingConditionLocation02Todohuken::where('name','東京都')->first();

        $tokyo23ku = new \App\Models\WorkingConditionLocation03Shichoson([
            'name' => '23区',
            'code' => 0,
            'todohuken_id' => $todohuken->id,
        ]);
        $tokyo23ku->save();


        // その他の市町村データの挿入
        foreach ($shikuchoson_data as $data)
        {
            // 空データのスキップ
            if( empty($data['shikuchoson_name']) ){ continue; }

            // 都道府県ID
            $todohuken = \App\Models\WorkingConditionLocation02Todohuken::where('name',$data['todohuken_name'])->first();
            if( empty($todohuken) ){ continue; }

            // 市町村データの挿入
            $is_ku = mb_substr( $data['shikuchoson_name'], mb_strlen($data['shikuchoson_name']) -1 );
            if( $is_ku !== '区' )
            {

                $shichoson = new \App\Models\WorkingConditionLocation03Shichoson([
                    'name' => $data['shikuchoson_name'],
                    'code' => $data['code'],
                    'todohuken_id' => $todohuken->id,
                ]);
                $shichoson->save();

            }
            // 東京23区(区テーブル)データの挿入
            else
            {

                $ku = new \App\Models\WorkingConditionLocation04Ku([
                    'name' => $data['shikuchoson_name'],
                    'code' => $data['code'],
                    'shichoson_id' => $tokyo23ku['id'],
                ]);
                $ku->save();

            }
        }




        /**
         * --------------------------------
         *  4.政令指定都市(区)データの挿入
         * --------------------------------
        */
        foreach ($ku_data as $data)
        {
            $is_ku = mb_substr( $data['shikuchoson_name'], mb_strlen($data['shikuchoson_name']) -1 );
            // 政令指定都市名の保存
            if( $is_ku !== '区' )
            {
                $shichoson = \App\Models\WorkingConditionLocation03Shichoson::
                where('name',$data['shikuchoson_name'])->first();
            }
            // 政令指定都市(区)データの挿入
            else
            {
                if( empty($shichoson) ){ continue; }
                $ku = new \App\Models\WorkingConditionLocation04Ku([
                    'name' => str_replace($shichoson->name, '', $data['shikuchoson_name']),
                    'code' => $data['code'],
                    'shichoson_id' => $shichoson->id,
                ]);
                $ku->save();

            }
        }




        return true;
    }

}//end class
