<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActieOrganizerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actie_organizer', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('actie_id')->index('actie_organizer_actie_id_foreign');
            $table->unsignedInteger('organizer_id')->index('actie_organizer_organizer_id_foreign');
            $table->foreign(['actie_id'])->references(['id'])->on('acties')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign(['organizer_id'])->references(['id'])->on('organizers')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('actie_organizer');
    }
}
