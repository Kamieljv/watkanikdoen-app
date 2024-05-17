<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActieDimensionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actie_dimension', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('actie_id')->index('actie_dimension_actie_id_foreign');
            $table->unsignedInteger('dimension_id')->index('actie_dimension_dimension_id_foreign');
            $table->integer('score');
            $table->foreign(['actie_id'])->references(['id'])->on('acties')->onUpdate('NO ACTION')->onDelete('CASCADE');
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
        Schema::dropIfExists('actie_dimension');
    }
}
