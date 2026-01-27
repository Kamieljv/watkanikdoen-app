<?php

use App\Models\Page;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Change status column to string first
        Schema::table('pages', function (Blueprint $table) {
            $table->string('status')->change();
        });

        // Then update existing records
        Page::where('status', 'ACTIVE')->update(['status' => 'PUBLISHED']);
        Page::where('status', 'INACTIVE')->update(['status' => 'DRAFT']);

        // Finally, change status column to enum with new values
        Schema::table('pages', function (Blueprint $table) {
            $table->enum('status', ['PUBLISHED', 'DRAFT'])->default('DRAFT')->change();
        });
    }

    public function down(): void
    {
        // Change status column to string first
        Schema::table('pages', function (Blueprint $table) {
            $table->string('status')->change();
        });

        // Then revert existing records
        Page::where('status', 'PUBLISHED')->update(['status' => 'ACTIVE']);
        Page::where('status', 'DRAFT')->update(['status' => 'INACTIVE']);

        // Finally, change status column back to enum with old values
        Schema::table('pages', function (Blueprint $table) {
            $table->enum('status', ['ACTIVE', 'INACTIVE'])->default('INACTIVE')->change();
        });
    }
};