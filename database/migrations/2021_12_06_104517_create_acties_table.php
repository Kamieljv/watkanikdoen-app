<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acties', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('title');
            $table->text('excerpt')->nullable();
            $table->text('body');
            $table->text('keywords')->nullable();
            $table->text('externe_link');
            $table->dateTime('time_start')->nullable();
            $table->dateTime('time_end')->nullable();
            $table->point('location')->nullable();
            $table->string('location_human')->nullable();
            $table->string('image')->nullable();
            $table->string('slug')->unique('posts_slug_unique');
            $table->enum('status', ['PUBLISHED', 'DRAFT', 'PENDING'])->default('DRAFT');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('acties');
    }
}
