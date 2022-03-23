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
            WorkingConditionOccupationTablesSeeder::class,

            # 業種
            WorkingConditionIndustryTablesSeeder::class,

            # 駅(路線)
            WorkingConditionTrainTablesSeeder::class,

            # その他
            WorkingConditionOtherTablesSeeder::class,

        ]);
    }
}
