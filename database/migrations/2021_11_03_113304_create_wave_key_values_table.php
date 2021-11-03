<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWaveKeyValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wave_key_values', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type');
            $table->unsignedInteger('keyvalue_id');
            $table->string('keyvalue_type');
            $table->string('key');
            $table->string('value');

            $table->unique(['keyvalue_id', 'keyvalue_type', 'key']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wave_key_values');
    }
}
