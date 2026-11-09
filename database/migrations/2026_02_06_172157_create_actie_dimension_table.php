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
        Schema::create('actie_dimension', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('actie_id')->index('actie_dimension_actie_id_foreign');
            $table->unsignedInteger('dimension_id')->index('actie_dimension_dimension_id_foreign');
            $table->integer('score');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('actie_dimension');
    }
};
