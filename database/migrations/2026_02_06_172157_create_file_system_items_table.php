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
        Schema::create('file_system_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->string('name');
            $table->string('type')->index();
            $table->string('file_type')->nullable()->index();
            $table->unsignedBigInteger('size')->nullable();
            $table->unsignedInteger('duration')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('storage_path')->nullable();
            $table->timestamps();

            $table->unique(['parent_id', 'name']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('file_system_items');
    }
};
