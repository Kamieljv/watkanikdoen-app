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
        Schema::table('actie_category', function (Blueprint $table) {
            $table->foreign(['actie_id'])->references(['id'])->on('acties')->onUpdate('no action')->onDelete('cascade');
            $table->foreign(['category_id'])->references(['id'])->on('categories')->onUpdate('no action')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('actie_category', function (Blueprint $table) {
            $table->dropForeign('actie_category_actie_id_foreign');
            $table->dropForeign('actie_category_category_id_foreign');
        });
    }
};
