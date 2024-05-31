<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReferentieReferentieTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referentie_referentie_type', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('referentie_id')->index('referentie_referentie_type_referentie_id_foreign');
            $table->unsignedInteger('referentie_type_id')->index('referentie_referentie_type_referentie_type_id_foreign');
            $table->foreign(['referentie_id'])->references(['id'])->on('referenties')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign(['referentie_type_id'])->references(['id'])->on('referentie_types')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('referentie_referentie_type');
    }
}
