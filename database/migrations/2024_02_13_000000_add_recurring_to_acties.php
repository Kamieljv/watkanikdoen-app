<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRecurringToActies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('acties', function (Blueprint $table) {
            $table->unsignedInteger('recurring_interval')->after('time_end')->nullable();
            $table->date('recurring_end')->after('recurring_interval')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('acties', function (Blueprint $table) {
            $table->dropColumn('recurring_interval');
            $table->dropColumn('recurring_end');
        });
    }
}
