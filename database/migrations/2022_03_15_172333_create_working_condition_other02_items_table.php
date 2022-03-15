<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkingConditionOther02ItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('working_condition_other02_items', function (Blueprint $table) {
            $table->id();
            $table->string('name',10)->comment('条件名');
            $table->unsignedBigInteger('group_id')->comment('グループID');
            $table->boolean('checked')->default(0);

            $table->foreign('group_id')
            ->references('id')->on('working_condition_other01_groups')
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
        Schema::dropIfExists('working_condition_other02_items');
    }
}
