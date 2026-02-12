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
        Schema::create('book_theme', function (Blueprint $table) {
            $table->increments('id');
            $table->foreignId('book_id')->index('book_theme_book_id_foreign');
            $table->foreignId('theme_id')->index('book_theme_theme_id_foreign');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_theme');
    }
};
