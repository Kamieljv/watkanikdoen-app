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
        Schema::table('reports', function(Blueprint $table){
            $table->date('start_date')->after('time_start')->nullable();
            $table->time('start_time')->after('start_date')->nullable();
            $table->date('end_date')->after('time_end')->nullable();
            $table->time('end_time')->after('end_date')->nullable();
        });

        DB::statement(
            'UPDATE reports set 
            start_date = substring(time_start, 1, 10), 
            start_time = substring(time_start, 11, 8),
            end_date = substring(time_end, 1, 10),
            end_time = substring(time_end, 11, 8) where time_start is not NULL' 
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
