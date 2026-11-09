<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('book_shelf_theme', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('book_shelf_id')->index();
            $table->unsignedInteger('theme_id')->index();

            $table->foreign('book_shelf_id')->references('id')->on('book_shelves')->onDelete('cascade');
            $table->foreign('theme_id')->references('id')->on('themes')->onDelete('cascade');
            $table->unique(['book_shelf_id', 'theme_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_shelf_theme');
    }
};
