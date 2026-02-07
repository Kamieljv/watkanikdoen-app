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
        Schema::create('referentie_type_dimension', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('referentie_type_id')->index('referentie_type_dimension_referentie_type_id_foreign');
            $table->unsignedInteger('dimension_id')->index('referentie_type_dimension_dimension_id_foreign');
            $table->integer('score');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('referentie_type_dimension');
    }
};
