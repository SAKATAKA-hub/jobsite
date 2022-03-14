<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([


            /**
             * -----------------------------
             *  勤務条件テーブルのデータ
             * -----------------------------
            */
            # 勤務地
            WorkingConditionLocationTablesSeeder::class,

            # 職種


            # 業種


            # 駅(路線)


            # その他



        ]);
    }
}
