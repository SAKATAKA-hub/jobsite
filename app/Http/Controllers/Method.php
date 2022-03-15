<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;


class Method
{
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
        $content = trim($content);


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
        $keys[0] = mb_substr($keys[0],1);// 文字化けの削除

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
