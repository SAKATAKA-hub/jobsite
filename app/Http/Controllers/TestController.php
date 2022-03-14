<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class TestController extends Controller
{
    /**
     * 勤務地データの更新
     *
     * 1)総務省の全国地方公共団体コード一覧サイトを開く
     * 2)"都道府県コード及び市町村コード"のExcelファイルをダウンロード
     * 3)ダウンロードしたファイルをCSV形式で保存。
     * 4)保存先:storage/app/public/data/csv/location
     * 5)ファイル名:shikuchoson.csv
     *
    */
    public function update_location_data()
    {
        # 勤務地のCSVデータパス
        $puth_todohuken = 'data/csv/location/todohuken.csv';
        $puth_shikuchoson = 'data/csv/location/shikuchoson.csv';


        # ファイルが存在しないときの処理
        if(
            !( Storage::exists($puth_todohuken) && Storage::exists($puth_shikuchoson) )
        ){
            return 'CSVファイルは存在しません。';
        }


        # 勤務地データの挿入
        // CSVファイルの読み込み
        $todohuken_data = self::f_get_csv($puth_todohuken);
        $shikuchoson_data = self::f_get_csv($puth_shikuchoson);


        # 勤務地データのリセット
        $redions = \App\Models\WorkingConditionLocation01Redion::all();
        foreach ($redions as $redion) {
            $redion->delete();
        }


        # データの挿入
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
                'code' => sprintf('%02d', $data['todohuken_codo']),
                'radion_id' => $redion->id,
            ]);
            $todohuken->save();
        }


        $redions = \App\Models\WorkingConditionLocation01Redion::all();
        $todohukens = \App\Models\WorkingConditionLocation02Todohuken::all();

        dd( $todohukens[0] );

    }




    /**
     * ==============================================
     *  メソッド内で利用するメソッド
     * ==============================================
    */

    /**
     * CSVファイルの読み込み(f_get_csv)
     *
     * @param String $puth //CSVファイルパス
     * @return Array
    */
    public static function f_get_csv($puth)
    {
        # ファイルの読み込み
        $content = Storage::get($puth);

        # CSVデータを連想配列に変換
        $content = str_replace("\n",'',$content);
        $array1 = explode("\r",$content);
        array_pop($array1);

        $array2 = [];
        foreach ($array1 as $line) {
            $array2[] = explode(',',$line);
        }

        # キーの配列を取得
        $keys = array_shift($array2);

        # キーを設定し、連想配列にする
        $array4 = [];
        foreach ($array2 as $values) {
            $array3 = [];
            for ($i=0; $i < count($values); $i++) {
                $array3[ $keys[$i] ] = $values[$i];
            }
            $array4[] = $array3;
        }


        return $array4;
    }

}
