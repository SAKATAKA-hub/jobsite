<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkingConditionOccupation02Group02sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('working_condition_occupation02_group02s', function (Blueprint $table) {
            $table->id();
            $table->string('name',10)->comment('グループ名02');
            $table->unsignedBigInteger('group01_id')->comment('グループ01ID');
            $table->boolean('checked')->default(0);

            $table->foreign('group01_id')
            ->references('id')->on('working_condition_occupation01_group01s')
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
        Schema::dropIfExists('working_condition_occupation02_group02s');
    }
}
