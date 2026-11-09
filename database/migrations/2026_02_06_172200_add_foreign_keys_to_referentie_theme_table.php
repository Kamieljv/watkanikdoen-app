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
        Schema::table('referentie_theme', function (Blueprint $table) {
            $table->foreign(['referentie_id'])->references(['id'])->on('referenties')->onUpdate('no action')->onDelete('cascade');
            $table->foreign(['theme_id'])->references(['id'])->on('themes')->onUpdate('no action')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('referentie_theme', function (Blueprint $table) {
            $table->dropForeign('referentie_theme_referentie_id_foreign');
            $table->dropForeign('referentie_theme_theme_id_foreign');
        });
    }
};
