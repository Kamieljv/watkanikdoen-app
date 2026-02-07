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
        Schema::create('answer_dimension', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('answer_id')->index('answer_dimension_answer_id_foreign');
            $table->unsignedInteger('dimension_id')->index('answer_dimension_dimension_id_foreign');
            $table->integer('score');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('answer_dimension');
    }
};
