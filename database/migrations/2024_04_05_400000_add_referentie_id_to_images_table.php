<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddReferentieIdToImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('images', function(Blueprint $table) {
            $table->dropIndex('images_key_user_id_organizer_id_actie_id_report_id_unique');
        });
        Schema::table('images', function (Blueprint $table) {
            $table->integer('referentie_id')->unsigned()->nullable()->index('images_referentie_id_foreign')->after('report_id');
            $table->foreign('referentie_id')->references(['id'])->on('referenties')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->unique(['key', 'user_id', 'organizer_id', 'actie_id', 'report_id', 'referentie_id'], 'unique_index_multiple_columns');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('images', function (Blueprint $table) {
            $table->dropIndex('unique_index_multiple_columns');
            $table->dropForeign('images_referentie_id_foreign');
        });

        Schema::table('images', function (Blueprint $table) {
            $table->dropColumn('referentie_id');
            $table->unique(['key', 'user_id', 'organizer_id', 'actie_id', 'report_id']);
        });

    }
}
