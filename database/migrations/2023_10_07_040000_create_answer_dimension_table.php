<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswerDimensionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answer_dimension', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('answer_id')->index('answer_dimension_answer_id_foreign');
            $table->unsignedInteger('dimension_id')->index('answer_dimension_dimension_id_foreign');
            $table->integer('score');
            $table->foreign(['answer_id'])->references(['id'])->on('answers')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign(['dimension_id'])->references(['id'])->on('dimensions')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('answer_dimension');
    }
}
