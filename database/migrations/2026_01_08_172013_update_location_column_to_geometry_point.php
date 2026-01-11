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
        // Update acties table
        Schema::table('acties', function (Blueprint $table) {
            $table->renameColumn('location', 'location_old');
        });

        Schema::table('acties', function (Blueprint $table) {
            $table->geometry('location', subtype: 'point')->nullable()->after('location_old');
        });

        // Migrate data for acties
        DB::statement('UPDATE acties SET location = ST_GeometryFromText(location_old) WHERE location_old IS NOT NULL');

        Schema::table('acties', function (Blueprint $table) {
            $table->dropColumn('location_old');
        });

        // Update reports table
        Schema::table('reports', function (Blueprint $table) {
            $table->renameColumn('location', 'location_old');
        });

        Schema::table('reports', function (Blueprint $table) {
            $table->geometry('location', subtype: 'point')->nullable()->after('location_old');
        });

        // Migrate data for reports
        DB::statement('UPDATE reports SET location = ST_GeometryFromText(location_old) WHERE location_old IS NOT NULL');

        Schema::table('reports', function (Blueprint $table) {
            $table->dropColumn('location_old');
        });
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
