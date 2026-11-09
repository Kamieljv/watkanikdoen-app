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
        Schema::table('organizer_theme', function (Blueprint $table) {
            $table->foreign(['organizer_id'])->references(['id'])->on('organizers')->onUpdate('no action')->onDelete('cascade');
            $table->foreign(['theme_id'])->references(['id'])->on('themes')->onUpdate('no action')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('organizer_theme', function (Blueprint $table) {
            $table->dropForeign('organizer_theme_organizer_id_foreign');
            $table->dropForeign('organizer_theme_theme_id_foreign');
        });
    }
};
