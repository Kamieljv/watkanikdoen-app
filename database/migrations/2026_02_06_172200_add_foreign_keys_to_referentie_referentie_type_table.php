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
        Schema::table('referentie_referentie_type', function (Blueprint $table) {
            $table->foreign(['referentie_id'])->references(['id'])->on('referenties')->onUpdate('no action')->onDelete('cascade');
            $table->foreign(['referentie_type_id'])->references(['id'])->on('referentie_types')->onUpdate('no action')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('referentie_referentie_type', function (Blueprint $table) {
            $table->dropForeign('referentie_referentie_type_referentie_id_foreign');
            $table->dropForeign('referentie_referentie_type_referentie_type_id_foreign');
        });
    }
};
