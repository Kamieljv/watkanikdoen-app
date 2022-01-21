<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActieActieThemeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actie_actie_theme', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('actie_id')->index('actie_actie_theme_actie_id_foreign');
            $table->unsignedInteger('actie_theme_id')->index('actie_actie_theme_theme_id_foreign');
            $table->foreign(['actie_id'])->references(['id'])->on('acties')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign(['actie_theme_id'])->references(['id'])->on('actie_themes')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('actie_actie_theme');
    }
}
