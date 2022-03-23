<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkingConditionTrain02LinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('working_condition_train02_lines', function (Blueprint $table) {
            $table->id();
            $table->string('name',100)->comment('路線名');
            $table->string('code',10)->comment('路線コード');
            $table->unsignedBigInteger('company_id')->comment('鉄道会社ID');
            $table->boolean('checked')->default(0);

            $table->foreign('company_id')
            ->references('id')->on('working_condition_train01_companies')
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
        Schema::dropIfExists('working_condition_train02_lines');
    }
}
