<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkingConditionLocation04KusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('working_condition_location04_kus', function (Blueprint $table) {
            $table->id();
            $table->string('name',10)->comment('区名');
            $table->string('code',10)->comment('市区町村コード');
            $table->unsignedBigInteger('shichoson_id')->comment('市町村ID');
            $table->boolean('checked')->default(0);

            $table->foreign('shichoson_id')
            ->references('id')->on('working_condition_location03_shichosons')
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
        Schema::dropIfExists('working_condition_location04_kus');
    }
}
