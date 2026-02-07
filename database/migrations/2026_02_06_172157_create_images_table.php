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
        Schema::create('images', function (Blueprint $table) {
            $table->string('key', 32);
            $table->string('path');
            $table->double('size');
            $table->unsignedInteger('user_id')->nullable()->index('images_user_id_foreign');
            $table->unsignedInteger('organizer_id')->nullable()->index('images_organizer_id_foreign');
            $table->unsignedInteger('actie_id')->nullable()->index('images_actie_id_foreign');
            $table->unsignedInteger('report_id')->nullable()->index('images_report_id_foreign');
            $table->unsignedInteger('referentie_id')->nullable()->index('images_referentie_id_foreign');
            $table->timestamps();

            $table->unique(['key', 'user_id', 'organizer_id', 'actie_id', 'report_id', 'referentie_id'], 'unique_index_multiple_columns');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('images');
    }
};
