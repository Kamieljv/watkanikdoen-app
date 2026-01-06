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
     * Rename existing Voyager tables to backup tables so new Spatie tables can be created
     */
    public function up(): void
    {
        // Rename Voyager tables to backup
        foreach (['roles', 'permissions', 'permission_role'] as $table) {
            if (Schema::hasTable($table)) {
                $backupName = 'voyager_old_' . $table;
                DB::statement("RENAME TABLE `{$table}` TO `{$backupName}`");
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Restore original table names
        foreach (['permission_role', 'permissions', 'roles'] as $table) {
            $backupName = 'voyager_old_' . $table;
            if (Schema::hasTable($backupName)) {
                // Drop the new Spatie tables if they exist
                if (Schema::hasTable($table)) {
                    DB::statement('SET FOREIGN_KEY_CHECKS=0');
                    Schema::dropIfExists($table);
                    DB::statement('SET FOREIGN_KEY_CHECKS=1');
                }
                DB::statement("RENAME TABLE `{$backupName}` TO `{$table}`");
            }
        }
    }
};
