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

        $puth = 'data/csv/location/shikuchoson.csv';

        if( Storage::exists($puth) ){

            $array = self::f_get_csv($puth);
            dd( $array[0] );
        }else{
            return 'CSVファイルは存在しません。';
        }
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
