<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyAnnouncements extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('announcements', function (Blueprint $table) {
            $table->dropColumn('body');
        });
        Schema::table('announcements', function (Blueprint $table) {
            $table->string('url');
            $table->string('color')->nullable();
            $table->enum('status', ['ACTIVE', 'INACTIVE'])->default('ACTIVE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('announcements', function (Blueprint $table) {
            $table->dropColumn('url');
            $table->dropColumn('color');
            $table->dropColumn('status');
        });
        Schema::table('announcements', function (Blueprint $table) {
            $table->text('body', 65535);
        });
    }
}
