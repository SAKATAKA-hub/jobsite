<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkingConditionTrain01CompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('working_condition_train01_companies', function (Blueprint $table) {
            $table->id();
            $table->string('name',100)->comment('鉄道会社名');
            $table->integer('code')->comment('鉄道会社コード');
            $table->string('todohuken_code',10)->comment('都道府県コード');
            $table->boolean('checked')->default(0);
            $table->boolean('checked_children')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('working_condition_train01_companies');
    }
}
