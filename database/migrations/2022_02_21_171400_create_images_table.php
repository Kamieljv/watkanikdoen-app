<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->string('key', 32)->unique(); // a hash based on the file path used to more efficiently index the db
            $table->string('path');
            $table->float('size', 10, 2);
            $table->integer('user_id')->unsigned()->nullable()->index('images_user_id_foreign');
            $table->foreign('user_id')->references(['id'])->on('users')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->integer('organizer_id')->unsigned()->nullable()->index('images_organizer_id_foreign');
            $table->foreign('organizer_id')->references(['id'])->on('organizers')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->integer('actie_id')->unsigned()->nullable()->index('images_actie_id_foreign');
            $table->foreign('actie_id')->references(['id'])->on('acties')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->integer('report_id')->unsigned()->nullable()->index('images_report_id_foreign');
            $table->foreign('report_id')->references(['id'])->on('reports')->onUpdate('NO ACTION')->onDelete('CASCADE');
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
        Schema::dropIfExists('images');
    }
}
