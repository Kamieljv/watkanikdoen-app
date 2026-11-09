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
        Schema::create('organizers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('website');
            $table->string('logo')->nullable();
            $table->string('email')->nullable();
            $table->string('slug')->unique();
            $table->unsignedTinyInteger('featured')->nullable();
            $table->timestamps();
            $table->unsignedInteger('user_id')->nullable()->index('organizers_user_id_foreign');
            $table->enum('status', ['PENDING', 'APPROVED', 'REJECTED', 'PUBLISHED'])->default('PENDING');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organizers');
    }
};
