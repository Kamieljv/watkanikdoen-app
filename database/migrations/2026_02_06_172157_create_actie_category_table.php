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
        Schema::create('actie_category', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('actie_id')->index('actie_category_actie_id_foreign');
            $table->unsignedInteger('category_id')->index('actie_category_category_id_foreign');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('actie_category');
    }
};
