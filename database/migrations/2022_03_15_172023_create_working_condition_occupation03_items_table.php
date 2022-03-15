<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkingConditionOccupation03ItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('working_condition_occupation03_items', function (Blueprint $table) {
            $table->id();
            $table->string('name',10)->comment('職種名');
            $table->unsignedBigInteger('group02_id')->comment('グループ02ID');
            $table->boolean('checked')->default(0);

            $table->foreign('group02_id')
            ->references('id')->on('working_condition_occupation02_group02s')
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
        Schema::dropIfExists('working_condition_occupation03_items');
    }
}
