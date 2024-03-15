<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('acties', function(Blueprint $table){
            $table->date('start_date')->after('time_start')->nullable();
            $table->time('start_time')->after('start_date')->nullable();
            $table->date('end_date')->after('time_end')->nullable();
            $table->time('end_time')->after('end_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('acties', function(Blueprint $table){
            $table->dropColumn('start_date');
            $table->dropColumn('start_time');
            $table->dropColumn('end_date');
            $table->dropColumn('end_time');
        });
    }
};
