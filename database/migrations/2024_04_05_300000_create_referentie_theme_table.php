<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReferentieThemeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referentie_theme', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('referentie_id')->index('referentie_theme_referentie_id_foreign');
            $table->unsignedInteger('theme_id')->index('referentie_theme_theme_id_foreign');
            $table->foreign(['referentie_id'])->references(['id'])->on('referenties')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign(['theme_id'])->references(['id'])->on('themes')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('referentie_theme');
    }
}
