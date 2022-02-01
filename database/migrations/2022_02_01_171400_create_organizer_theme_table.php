<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizerThemeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organizer_theme', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('organizer_id')->index('organizer_theme_organizer_id_foreign');
            $table->unsignedInteger('theme_id')->index('organizer_theme_theme_id_foreign');
            $table->foreign(['organizer_id'])->references(['id'])->on('organizers')->onUpdate('NO ACTION')->onDelete('CASCADE');
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
        Schema::dropIfExists('organizer_theme');
    }
}
