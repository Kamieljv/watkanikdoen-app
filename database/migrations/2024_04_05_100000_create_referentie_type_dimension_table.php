<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReferentieTypeDimensionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referentie_type_dimension', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('referentie_type_id')->index('referentie_type_dimension_referentie_type_id_foreign');
            $table->unsignedInteger('dimension_id')->index('referentie_type_dimension_dimension_id_foreign');
            $table->integer('score');
            $table->foreign(['referentie_type_id'])->references(['id'])->on('referentie_types')->onUpdate('NO ACTION')->onDelete('CASCADE');
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
        Schema::dropIfExists('referentie_type_dimension');
    }
}
