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
        // 勤務条件/ 勤務地データ挿入　Seeder の読み込み
        $read_seeder = \Database\Seeders\WorkingConditionLocationTablesSeeder::run();

        if($read_seeder)
        {
            return 'アップデート成功！';
        }
        else
        {
            return 'ERR アップデート失敗';
        }

    }





}
