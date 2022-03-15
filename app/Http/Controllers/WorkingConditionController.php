<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


/**
 ***************************************************
 * Controller 勤務条件
 ***************************************************
*/
class WorkingConditionController extends Controller
{
    /**
     * 勤務条件一覧(list)
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
    */
    public function list()
    {
        $locations =\App\Models\WorkingConditionLocation01Redion::all();

        // dd( $locations[0]->todohukens[0]->shichosons[0]->kus->count() );


        return view('working_condition.list',[
            /**
             * 勤務地
             * $locations[0]->todohukens[0]->shichosons[0]->kus[0] ('地域'->'都道府県'->'市町村'->'区')
            */
            'locations' => \App\Models\WorkingConditionLocation01Redion::all(),
        ]);
    }



    /**
     * ----------------------------------------------------
     *  勤務条件API
     * ----------------------------------------------------
    */
    # 勤務地API(location_api)
    public function location_api()
    {
        return 'location_api';
    }

    # 職種API(occupation_api)
    # 業種API(industry_api)
    # 駅API(train_api)
    # その他条件API(other_api)




    /**
     * ----------------------------------------------------
     *  勤務条件の更新
     * ----------------------------------------------------
    */
    /**
     * 勤務地の更新(location_update)
     * -- 勤務地データの更新 --------------------------------
     * 1)総務省の全国地方公共団体コード一覧サイトを開く
     * 2)"都道府県コード及び市町村コード"のExcelファイルをダウンロード
     * 3)ダウンロードしたファイルをCSV形式で保存。
     * 4)保存先:storage/app/public/data/csv/location
     * ----------------------------------------------------
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
    */
    public function location_update()
    {
        $read_seeder = \Database\Seeders\WorkingConditionLocationTablesSeeder::run();

        if($read_seeder){
            return 'アップデート成功！';
        }else{
            return 'ERR アップデート失敗';
        }
    }




    # 職種の更新(occupation_update)
    # 業種の更新(industry_update)
    # 駅の更新(train_update)
    # その他条件の更新(other_update)

}
