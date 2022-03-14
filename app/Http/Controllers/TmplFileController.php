<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TmplFileController extends Controller
{
    /**
     * ファイルの操作
     *
    */
    public function file()
    {

        //-----------------------------------------------
        # 設定
        $variable = 4; // <= テストする操作番号を指定してください。

        $dir = 'test/';
        $file = 'test_file.txt';


        switch ($variable) {
            case '1': //---------------------------------
                # ファイルの保存(1)
                $content = 'テスト文章。';
                Storage::put( $dir.$file, $content);
                return 'テストファイルを保存しました。';
                break;
            //
            case '2': //---------------------------------
                # ファイルの読込み(2)
                if( Storage::exists($dir.$file) ){

                    $content = Storage::get( $dir.$file);
                    return $content;
                }else{
                    return '読込みファイルは存在しません。';
                }
                break;
            //
            case '3': //---------------------------------
                # ファイルの削除(3)
                if( Storage::exists($dir.$file) ){

                    Storage::delete( $dir.$file);
                    return 'ファイルを削除しました。';
                }else{
                    return '削除ファイルは存在しません。';
                }
                break;
            //
            case '4': //---------------------------------
                # CSVファイル読み込み関数(4)
                $puth = 'test/shikuchoson.csv';

                if( Storage::exists($puth) ){

                    $array = self::f_get_csv($puth);
                    dd( $array );
                }else{
                    return 'CSVファイルは存在しません。';
                }
                break;
            //
        }



        return 'test file';
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
