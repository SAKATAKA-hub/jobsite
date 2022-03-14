<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkingConditionLocation02TodohukensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('working_condition_location02_todohukens', function (Blueprint $table) {
            $table->id();
            $table->string('name',10)->comment('都道府県名');
            $table->string('code',10)->comment('都道府県コード');
            $table->unsignedBigInteger('radion_id')->comment('地域ID');
            $table->boolean('checked')->default(0);

            $table->foreign('radion_id')
            ->references('id')->on('working_condition_location01_redions')
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
        Schema::dropIfExists('working_condition_location02_todohukens');
    }
}
