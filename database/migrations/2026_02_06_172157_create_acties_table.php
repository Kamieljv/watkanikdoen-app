<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('acties', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->index('acties_user_id_foreign');
            $table->string('title');
            $table->text('excerpt')->nullable();
            $table->text('body');
            $table->text('keywords')->nullable();
            $table->text('externe_link');
            $table->date('start_date')->nullable();
            $table->time('start_time')->nullable();
            $table->date('end_date')->nullable();
            $table->time('end_time')->nullable();
            $table->geometry('location', 'point')->nullable();
            $table->string('location_human')->nullable();
            $table->string('image')->nullable();
            $table->boolean('disobedient')->nullable();
            $table->string('slug')->unique();
            $table->enum('status', ['PUBLISHED', 'DRAFT', 'PENDING'])->default('DRAFT');
            $table->unsignedInteger('pageviews')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('acties');
    }
};
