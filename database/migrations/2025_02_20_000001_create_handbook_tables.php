<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('handbook_pages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('content');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->integer('order')->default(0);
            $table->timestamps();
            
            $table->foreign('parent_id')
                  ->references('id')
                  ->on('handbook_pages')
                  ->onDelete('set null');
        });

        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->timestamps();
        });

        Schema::create('handbook_page_tag', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('handbook_page_id');
            $table->unsignedBigInteger('tag_id');

            $table->foreign('handbook_page_id')
                  ->references('id')
                  ->on('handbook_pages')
                  ->onDelete('cascade');
                  
            $table->foreign('tag_id')
                  ->references('id')
                  ->on('tags')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('handbook_page_tag');
        Schema::dropIfExists('tags');
        Schema::dropIfExists('handbook_pages');
    }
};
