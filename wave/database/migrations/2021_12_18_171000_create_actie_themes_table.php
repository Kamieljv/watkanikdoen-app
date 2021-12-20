<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateActieThemesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Create table for storing actie_themes
        Schema::create('actie_themes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order')->default(1);
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('color');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('actie_themes');
    }
}
