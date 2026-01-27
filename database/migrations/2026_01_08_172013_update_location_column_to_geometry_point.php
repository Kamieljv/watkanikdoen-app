<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $tablesWithLocation = ['acties', 'reports'];

        foreach ($tablesWithLocation as $tableName) {
            // Check if the geometry type is already point to avoid errors
            $isPointType = DB::selectOne("
                SELECT DATA_TYPE
                FROM INFORMATION_SCHEMA.COLUMNS
                WHERE TABLE_NAME = '{$tableName}' AND COLUMN_NAME = 'location'
            ")->DATA_TYPE === 'point';
            if (!$isPointType) {
                // Update acties table
                Schema::table($tableName, function (Blueprint $table) {
                    $table->renameColumn('location', 'location_old');
                });

                Schema::table($tableName, function (Blueprint $table) {
                    $table->geometry('location', subtype: 'point')->nullable()->after('location_old');
                });

                // Migrate data for acties
                DB::statement("UPDATE {$tableName} SET location = ST_GeometryFromText(location_old) WHERE location_old IS NOT NULL");

                Schema::table($tableName, function (Blueprint $table) {
                    $table->dropColumn('location_old');
                });
            } else {
                // Skip migration for acties
                echo "\nSkipping migration for '{$tableName}' table as 'location' is already of type POINT.\n";
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Reverse acties table
        Schema::table('acties', function (Blueprint $table) {
            $table->renameColumn('location', 'location_old');
        });

        Schema::table('acties', function (Blueprint $table) {
            $table->text('location')->nullable()->after('location_old');
        });

        DB::statement('UPDATE acties SET location = ST_AsText(location_old) WHERE location_old IS NOT NULL');

        Schema::table('acties', function (Blueprint $table) {
            $table->dropColumn('location_old');
        });

        // Reverse reports table
        Schema::table('reports', function (Blueprint $table) {
            $table->renameColumn('location', 'location_old');
        });

        Schema::table('reports', function (Blueprint $table) {
            $table->text('location')->nullable()->after('location_old');
        });

        DB::statement('UPDATE reports SET location = ST_AsText(location_old) WHERE location_old IS NOT NULL');

        Schema::table('reports', function (Blueprint $table) {
            $table->dropColumn('location_old');
        });
    }
};
