<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

/**
 ***************************************************
 * Seeder 勤務条件/ 駅(路線)データ挿入
 ***************************************************
*/
class WorkingConditionTrainTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    //    $todohuken = \App\Models\WorkingConditionLocation02Todohuken::where('code','01')->first();
    //    dd($todohuken->train_companies[0]->lines[0]->stations);

        # CSVデータパス
        $puth_company = 'data/csv/train/company.csv';
        $puth_line = 'data/csv/train/line.csv';
        $puth_station = 'data/csv/train/station.csv';


        # ファイルが存在しないときの処理
        if( !(
            Storage::exists($puth_company) &&
            Storage::exists($puth_line) &&
            Storage::exists($puth_station)
        ) ){ return false; }


        # データのリセット(Controller読み込み時に必要な処理)
        $companys = \App\Models\WorkingConditionTrain01Company::all();
        foreach ($companys as $company)
        {
            $company->delete();
        }


        # CSVファイルの読み込み
        $company_data = Method::f_get_csv($puth_company);
        $line_data = Method::f_get_csv($puth_line);
        $station_data = Method::f_get_csv($puth_station);


        /**
         * --------------------------------
         *  駅(路線)の基本データの挿入
         * --------------------------------
        */
        #(1)企業
        foreach ($company_data as $data)
        {
            $company = new \App\Models\WorkingConditionTrain01Company([
                'name' => $data['company_name'],
                'code' => $data['company_cd'],
                'todohuken_code' => sprintf('%02d', 0), //都道府県に紐づかないデータの都道府県コード
            ]);
            $company->save();
        }

        #(2)路線
        foreach ($line_data as $data)
        {
            $line = new \App\Models\WorkingConditionTrain02Line([
                'name' => $data['line_name'],
                'code' => $data['line_cd'],
                'company_id' => \App\Models\WorkingConditionTrain01Company::where('code',$data['company_cd'])->first()->id,
            ]);
            $line->save();
        }

        #(3)駅
        foreach ($station_data as $data)
        {
            $station = new \App\Models\WorkingConditionTrain03Station([
                'name' => $data['station_name'],
                'code' => $data['station_cd'],
                'line_id' => \App\Models\WorkingConditionTrain02Line::where('code',$data['line_cd'])->first()->id,
                'line_code' => $data['line_cd'],
                'todohuken_code' => sprintf('%02d', $data['pref_cd']),
            ]);
            $station->save();
        }




        /**
         * -----------------------------------
         *  都道府県に紐づく駅(路線)データの挿入
         * -----------------------------------
        */
        $stations = \App\Models\WorkingConditionTrain03Station::
            orderBy('todohuken_code','asc')
           ->orderBy('line_code','asc')
           ->get()
        ;

        foreach ($stations as $station)
        {
            # 都道府県に紐づく企業
            $company = \App\Models\WorkingConditionTrain01Company::
                // where('todohuken_code','00') //都道府県コードの指定
                where('todohuken_code',$station->todohuken_code) //都道府県コードの指定
                ->where('code',$station->line->company->code) //企業コードの指定
                ->first()
            ;

            if( empty($company) ){
                $company = new \App\Models\WorkingConditionTrain01Company([
                    'name' => $station->line->company->name,
                    'code' => $station->line->company->code,
                    'todohuken_code' => $station->todohuken_code
                ]);
                $company->save();
            }


            # 都道府県に紐づく路線
            $line = \App\Models\WorkingConditionTrain02Line::
                where('company_id',$company->id) //都道府県に紐づく企業IDの指定
                ->where('code',$station->line->code) //路線コードの指定
                ->first()
            ;

            if( empty($line) ){
                $line = new \App\Models\WorkingConditionTrain02Line([
                    'name' => $station->line->name,
                    'code' => $station->line->code,
                    'company_id' => $company->id,
                ]);
                $line->save();
            }
        }




        return true;
    }
}
