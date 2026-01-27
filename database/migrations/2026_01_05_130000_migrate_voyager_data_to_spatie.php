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
     * Migrate data from Voyager backup tables to new Spatie tables
     */
    public function up(): void
    {
        if (!Schema::hasTable('roles') || !Schema::hasTable('permissions')) {
            throw new \Exception('Spatie permission tables not found. Please run Spatie migrations first.');
        }

        // Migrate Roles
        if (Schema::hasTable('voyager_old_roles')) {
            foreach (DB::table('voyager_old_roles')->get() as $role) {
                DB::table('roles')->updateOrInsert(
                    ['name' => $role->name],
                    [
                        'name' => $role->name,
                        'guard_name' => 'web',
                        'created_at' => $role->created_at ?? now(),
                        'updated_at' => $role->updated_at ?? now(),
                    ]
                );
            }
        }

        // Migrate Permissions
        if (Schema::hasTable('voyager_old_permissions')) {
            foreach (DB::table('voyager_old_permissions')->get() as $permission) {
                DB::table('permissions')->updateOrInsert(
                    ['name' => $permission->key],
                    [
                        'name' => $permission->key,
                        'guard_name' => 'web',
                        'created_at' => $permission->created_at ?? now(),
                        'updated_at' => $permission->updated_at ?? now(),
                    ]
                );
            }
        }

        // Migrate Permission-Role relationships
        if (Schema::hasTable('voyager_old_permission_role') && Schema::hasTable('role_has_permissions')) {
            foreach (DB::table('voyager_old_permission_role')->get() as $pr) {
                $oldPermission = DB::table('voyager_old_permissions')->where('id', $pr->permission_id)->first();
                $oldRole = DB::table('voyager_old_roles')->where('id', $pr->role_id)->first();

                if ($oldPermission && $oldRole) {
                    $newPermission = DB::table('permissions')->where('name', $oldPermission->key)->first();
                    $newRole = DB::table('roles')->where('name', $oldRole->name)->first();

                    if ($newPermission && $newRole) {
                        DB::table('role_has_permissions')->updateOrInsert([
                            'permission_id' => $newPermission->id,
                            'role_id' => $newRole->id,
                        ]);
                    }
                }
            }
        }

        // Migrate from users.role_id if user_roles doesn't exist
        if (Schema::hasColumn('users', 'role_id') && Schema::hasTable('model_has_roles') && Schema::hasTable('voyager_old_roles')) {
            foreach (DB::table('users')->whereNotNull('role_id')->get() as $user) {
                $oldRole = DB::table('voyager_old_roles')->where('id', $user->role_id)->first();
                if ($oldRole) {
                    $newRole = DB::table('roles')->where('name', $oldRole->name)->first();
                    if ($newRole) {
                        DB::table('model_has_roles')->updateOrInsert([
                            'role_id' => $newRole->id,
                            'model_type' => 'App\\Models\\User',
                            'model_id' => $user->id,
                        ]);
                    }
                }
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Insert user_id back into users.role_id from model_has_roles
        if (Schema::hasTable('model_has_roles') && Schema::hasColumn('users', 'role_id')) {
            $userRoles = DB::table('model_has_roles')
                ->where('model_type', 'App\\Models\\User')
                ->get();
            foreach ($userRoles as $userRole) {
                DB::table('users')
                    ->where('id', $userRole->model_id)
                    ->update(['role_id' => $userRole->role_id]);
            }
        }

        // Clear migrated data from Spatie tables
        if (Schema::hasTable('role_has_permissions')) {
            DB::table('role_has_permissions')->truncate();
        }
        
        if (Schema::hasTable('model_has_roles')) {
            DB::table('model_has_roles')->where('model_type', 'App\\Models\\User')->delete();
        }
        
        if (Schema::hasTable('permissions')) {
            DB::table('permissions')->truncate();
        }
        
        if (Schema::hasTable('roles')) {
            DB::table('roles')->truncate();
        }
    }
};
