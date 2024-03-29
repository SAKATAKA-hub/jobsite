<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkingConditionTrain03StationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('working_condition_train03_stations', function (Blueprint $table) {
            $table->id();
            $table->string('name',100)->comment('駅名');
            $table->string('code',10)->comment('駅コード');
            $table->unsignedBigInteger('line_id')->comment('路線ID');
            $table->integer('line_code')->comment('路線コード');
            $table->string('todohuken_code',10)->comment('都道府県コード');
            $table->boolean('checked')->default(0);

            $table->foreign('line_id')
            ->references('id')->on('working_condition_train02_lines')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('working_condition_train03_stations');
    }
}
