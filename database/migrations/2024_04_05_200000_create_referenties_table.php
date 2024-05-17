<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReferentiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referenties', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('url');
            $table->text('description');
            $table->string('image');
            $table->enum('status', ['PUBLISHED', 'DRAFT'])->default('DRAFT');
            $table->timestamps();

            $table->unsignedInteger('referentie_type_id')->index('referentie_referentie_type_id_foreign');
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
        Schema::dropIfExists('referenties');
    }
}
