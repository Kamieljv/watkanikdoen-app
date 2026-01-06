<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Remove Voyager-specific columns from users table after migration.
     * Run this migration AFTER you've verified the Spatie migration works.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop Voyager-specific columns
            if (Schema::hasColumn('users', 'avatar')) {
                $table->dropColumn('avatar');
            }
            
            if (Schema::hasColumn('users', 'settings')) {
                $table->dropColumn('settings');
            }
            
            if (Schema::hasColumn('users', 'role_id')) {
                $table->dropForeign(['role_id']);
                $table->dropColumn('role_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Restore Voyager columns
            if (!Schema::hasColumn('users', 'avatar')) {
                $table->string('avatar')->nullable()->after('email');
            }
            
            if (!Schema::hasColumn('users', 'settings')) {
                $table->text('settings')->nullable()->after('remember_token');
            }
            
            // Restore role_id if it was dropped
            if (!Schema::hasColumn('users', 'role_id')) {
                $table->unsignedBigInteger('role_id')->nullable()->after('id');
                $table->foreign('role_id')->references('id')->on('roles')->onDelete('set null');
            }
        });
    }
};
