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
        Schema::create('organizer_theme', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('organizer_id')->index('organizer_theme_organizer_id_foreign');
            $table->unsignedInteger('theme_id')->index('organizer_theme_theme_id_foreign');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organizer_theme');
    }
};
