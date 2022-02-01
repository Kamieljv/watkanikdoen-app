<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActieThemeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actie_theme', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('actie_id')->index('actie_theme_actie_id_foreign');
            $table->unsignedInteger('theme_id')->index('actie_theme_theme_id_foreign');
            $table->foreign(['actie_id'])->references(['id'])->on('acties')->onUpdate('NO ACTION')->onDelete('CASCADE');
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
        Schema::dropIfExists('actie_theme');
    }
}
