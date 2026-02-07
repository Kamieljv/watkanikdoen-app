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
        Schema::table('images', function (Blueprint $table) {
            $table->foreign(['actie_id'])->references(['id'])->on('acties')->onUpdate('no action')->onDelete('cascade');
            $table->foreign(['organizer_id'])->references(['id'])->on('organizers')->onUpdate('no action')->onDelete('cascade');
            $table->foreign(['referentie_id'])->references(['id'])->on('referenties')->onUpdate('no action')->onDelete('cascade');
            $table->foreign(['report_id'])->references(['id'])->on('reports')->onUpdate('no action')->onDelete('cascade');
            $table->foreign(['user_id'])->references(['id'])->on('users')->onUpdate('no action')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('images', function (Blueprint $table) {
            $table->dropForeign('images_actie_id_foreign');
            $table->dropForeign('images_organizer_id_foreign');
            $table->dropForeign('images_referentie_id_foreign');
            $table->dropForeign('images_report_id_foreign');
            $table->dropForeign('images_user_id_foreign');
        });
    }
};
