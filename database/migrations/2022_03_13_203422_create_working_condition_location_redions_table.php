<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 ***************************************************
 * 勤務条件/ 勤務地/ 地方テーブル　Migration
 ***************************************************
*/
class CreateWorkingConditionLocationRedionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('working_condition_location_redions', function (Blueprint $table) {
            $table->id();
            $table->string('name',10)->comment('地域名');
            $table->boolean('checked')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('working_condition_location_redions');
    }
}
