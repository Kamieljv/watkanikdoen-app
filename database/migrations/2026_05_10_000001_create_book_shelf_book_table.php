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
        Schema::create('book_shelf_book', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('book_shelf_id')->index();
            $table->unsignedBigInteger('book_id')->index();
            $table->text('description')->nullable()->comment('Why this book is on this shelf');
            $table->timestamps();

            $table->foreign('book_shelf_id')->references('id')->on('book_shelves')->onDelete('cascade');
            $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');
            $table->unique(['book_shelf_id', 'book_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_shelf_book');
    }
};
