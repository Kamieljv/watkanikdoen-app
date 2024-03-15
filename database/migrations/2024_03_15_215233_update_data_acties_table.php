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
        DB::statement(
            'UPDATE acties set 
            start_date = substring(time_start, 1, 10), 
            start_time = substring(time_start, 11, 8),
            end_date = substring(time_end, 1, 10),
            end_time = substring(time_end, 11, 8)' 
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
