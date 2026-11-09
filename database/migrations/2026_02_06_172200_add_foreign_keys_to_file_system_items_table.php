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
        Schema::table('file_system_items', function (Blueprint $table) {
            $table->foreign(['parent_id'])->references(['id'])->on('file_system_items')->onUpdate('no action')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('file_system_items', function (Blueprint $table) {
            $table->dropForeign('file_system_items_parent_id_foreign');
        });
    }
};
