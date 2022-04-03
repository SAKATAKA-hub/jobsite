<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkingConditionLocation03ShichosonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('working_condition_location03_shichosons', function (Blueprint $table) {
            $table->id();
            $table->string('name',10)->comment('市町村名');
            $table->string('code',10)->comment('市区町村コード');
            $table->unsignedBigInteger('todohuken_id')->comment('都道府県ID');
            $table->boolean('checked')->default(0);
            $table->boolean('checked_children')->default(0);

            $table->foreign('todohuken_id')
            ->references('id')->on('working_condition_location02_todohukens')
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
        Schema::dropIfExists('working_condition_location03_shichosons');
    }
}
