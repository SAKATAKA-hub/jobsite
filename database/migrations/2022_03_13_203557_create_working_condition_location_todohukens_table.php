<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 ***************************************************
 * 勤務条件/ 勤務地/ 都道府県テーブル　Migration
 ***************************************************
*/
class CreateWorkingConditionLocationTodohukensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('working_condition_location_todohukens', function (Blueprint $table) {
            $table->id();
            $table->string('name',10)->comment('都道府県名');
            $table->string('code',10)->comment('都道府県コード');
            $table->unsignedBigInteger('radion_id')->comment('地域ID');
            $table->boolean('checked')->default(0);

            $table->foreign('radion_id')
            ->references('id')->on('working_condition_location_redions') //存在しないidの登録は不可
            ->onDelete('cascade');//主テーブルに関連する従テーブルのレコードを削除
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('working_condition_location_todohukens');
    }
}
