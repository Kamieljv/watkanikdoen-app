<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('file_system_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_id')->nullable()->constrained('file_system_items')->cascadeOnDelete();
            $table->string('name');
            $table->string('type');
            $table->string('file_type')->nullable();
            $table->unsignedBigInteger('size')->nullable();
            $table->unsignedInteger('duration')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('storage_path')->nullable();
            $table->timestamps();

            $table->index('type');
            $table->index('file_type');
            $table->unique(['parent_id', 'name']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('file_system_items');
    }
};
