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
        // Add new start/end date and time columns
        Schema::table('acties', function(Blueprint $table){
            $table->date('start_date')->after('time_start')->nullable();
            $table->time('start_time')->after('start_date')->nullable();
            $table->date('end_date')->after('time_end')->nullable();
            $table->time('end_time')->after('end_date')->nullable();
        });
        // Fill newly created columns with old data
        DB::statement(
            "
                UPDATE acties SET 
                start_date = DATE(time_start), 
                start_time = TIME(time_start),
                end_date = DATE(time_end),
                end_time = TIME(time_end);
            "
        );
        // Remove old columns 
        Schema::table('acties', function(Blueprint $table){
            $table->dropColumn('time_start');
            $table->dropColumn('time_end');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Recreate time_start and time_end columns
        Schema::table('acties', function(Blueprint $table){
            $table->dateTime('time_start')->nullable()->after('externe_link');
            $table->dateTime('time_end')->nullable()->after('time_start');
        });

        // Fill time_start and time_end with values from date and time columns
        DB::statement(
            "
                UPDATE acties SET 
                time_start = STR_TO_DATE(CONCAT(start_date, ' ', start_time), '%Y-%m-%d %H:%i:%s'), 
                time_end = STR_TO_DATE(CONCAT(end_date, ' ', end_time), '%Y-%m-%d %H:%i:%s');
            "
        );
        
        // Drop date and time columns
        Schema::table('acties', function(Blueprint $table){
            $table->dropColumn('start_date');
            $table->dropColumn('start_time');
            $table->dropColumn('end_date');
            $table->dropColumn('end_time');
        });
    }
};
