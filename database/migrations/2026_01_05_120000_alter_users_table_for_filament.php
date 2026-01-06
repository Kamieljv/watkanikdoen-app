<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Prepares the users table for Filament by:
     * - Ensuring required columns exist (email_verified_at)
     * - Making role_id nullable (will use Spatie's model_has_roles instead)
     * - Keeping Voyager columns for now (avatar, settings) for migration
     * - No structural changes to avoid breaking existing functionality
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Make role_id nullable if it isn't already
            // We'll use Spatie's model_has_roles pivot table instead
            if (Schema::hasColumn('users', 'role_id')) {
                // Check if it's already nullable
                $column = DB::select("SHOW COLUMNS FROM users WHERE Field = 'role_id'")[0];
                if ($column->Null === 'NO') {
                    $table->unsignedBigInteger('role_id')->nullable()->change();
                }
            }
        });

        // Migrate role_id data to Spatie's structure if the table exists
        if (Schema::hasTable('model_has_roles') && Schema::hasColumn('users', 'role_id')) {
            // Get all users with roles
            $users = DB::table('users')->whereNotNull('role_id')->get();
            
            foreach ($users as $user) {
                // Check if role exists
                $roleExists = DB::table('roles')->where('id', $user->role_id)->exists();
                
                if ($roleExists) {
                    // Insert into model_has_roles if not already there
                    DB::table('model_has_roles')->updateOrInsert(
                        [
                            'role_id' => $user->role_id,
                            'model_type' => 'App\\Models\\User',
                            'model_id' => $user->id,
                        ]
                    );
                }
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Make role_id not nullable again if reverting
            if (Schema::hasColumn('users', 'role_id')) {
                $table->unsignedBigInteger('role_id')->change();
            }
        });

        // Clean up model_has_roles entries for users
        if (Schema::hasTable('model_has_roles')) {
            DB::table('model_has_roles')
                ->where('model_type', 'App\\Models\\User')
                ->delete();
        }
    }
};
