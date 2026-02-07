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
        Schema::create('referentie_referentie_type', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('referentie_id')->index('referentie_referentie_type_referentie_id_foreign');
            $table->unsignedInteger('referentie_type_id')->index('referentie_referentie_type_referentie_type_id_foreign');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('referentie_referentie_type');
    }
};
