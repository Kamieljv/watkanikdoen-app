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
        Schema::table('answer_dimension', function (Blueprint $table) {
            $table->foreign(['answer_id'])->references(['id'])->on('answers')->onUpdate('no action')->onDelete('cascade');
            $table->foreign(['dimension_id'])->references(['id'])->on('dimensions')->onUpdate('no action')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('answer_dimension', function (Blueprint $table) {
            $table->dropForeign('answer_dimension_answer_id_foreign');
            $table->dropForeign('answer_dimension_dimension_id_foreign');
        });
    }
};
