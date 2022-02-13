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
            $table->integer('user_id');
            $table->string('title');
            $table->text('excerpt')->nullable();
            $table->text('body');
            $table->text('keywords')->nullable();
            $table->text('externe_link');
            $table->dateTime('time_start');
            $table->dateTime('time_end');
            $table->point('location')->nullable();
            $table->string('location_human');
            $table->string('image')->nullable();
            $table->string('slug')->unique('posts_slug_unique');
            $table->enum('status', ['PUBLISHED', 'DRAFT', 'PENDING'])->default('DRAFT');
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
        Schema::dropIfExists('acties');
    }
}
