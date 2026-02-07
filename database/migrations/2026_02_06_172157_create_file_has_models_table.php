<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('file_has_models', function (Blueprint $table) {
            $table->unsignedBigInteger('file_id')->index('file_has_models_file_id_foreign');
            $table->string('model_type');
            $table->unsignedBigInteger('model_id');
            $table->unique(['file_id', 'model_type', 'model_id'], 'file_model_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('file_has_models');
    }
};
