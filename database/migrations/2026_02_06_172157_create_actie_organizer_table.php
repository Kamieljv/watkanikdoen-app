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
        Schema::create('actie_organizer', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('actie_id')->index('actie_organizer_actie_id_foreign');
            $table->unsignedInteger('organizer_id')->index('actie_organizer_organizer_id_foreign');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('actie_organizer');
    }
};
