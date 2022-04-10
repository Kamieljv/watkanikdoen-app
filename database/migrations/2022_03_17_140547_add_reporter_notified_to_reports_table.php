<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddReporterNotifiedToReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reports', function (Blueprint $table) {
            $table->integer('reporter_notified')->unsigned()->nullable()->after('status');
            $table->integer('actie_id')->unsigned()->nullable()->after('user_id');
        });
        Schema::table('reports', function($table) {
            $table->foreign('actie_id')->references(['id'])->on('acties')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reports', function (Blueprint $table) {
            $table->dropColumn('reporter_notified');
            $table->dropForeign('reports_actie_id_foreign');
            $table->dropColumn('actie_id');
        });
    }
}
