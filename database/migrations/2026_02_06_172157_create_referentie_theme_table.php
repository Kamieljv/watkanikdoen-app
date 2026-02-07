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
        Schema::create('referentie_theme', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('referentie_id')->index('referentie_theme_referentie_id_foreign');
            $table->unsignedInteger('theme_id')->index('referentie_theme_theme_id_foreign');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('referentie_theme');
    }
};
