<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Remove username column from users table
     */
    public function up(): void
    {
        if (Schema::hasColumn('users', 'username')) {
            Schema::table('users', function ($table) {
                $table->dropColumn('username');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (!Schema::hasColumn('users', 'username')) {
            Schema::table('users', function ($table) {
                $table->string('username')->unique()->after('email')->nullable();
            });
        }
    }
};
