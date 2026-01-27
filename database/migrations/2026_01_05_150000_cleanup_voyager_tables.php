<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Clean up old Voyager tables and columns after successful migration
     */
    public function up(): void
    {
        // Drop Voyager UI/BREAD tables
        foreach (['data_rows', 'data_types', 'menu_items', 'menus', 'translations', 'settings'] as $table) {
            Schema::dropIfExists($table);
        }

        // Drop user_roles pivot table if it exists
        Schema::dropIfExists('user_roles');

        // Drop backup tables
        foreach (['voyager_old_permission_role', 'voyager_old_permissions', 'voyager_old_roles'] as $table) {
            Schema::dropIfExists($table);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Note: We cannot restore the dropped tables as we don't have the data
        // Users should restore from the SQL backup if needed
    }
};
