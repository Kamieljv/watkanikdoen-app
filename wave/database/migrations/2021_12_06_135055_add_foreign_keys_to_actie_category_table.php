<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToActieCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('actie_category', function (Blueprint $table) {
            $table->foreign(['actie_id'])->references(['id'])->on('acties')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign(['category_id'])->references(['id'])->on('categories')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('actie_category', function (Blueprint $table) {
            $table->dropForeign('actie_category_actie_id_foreign');
            $table->dropForeign('actie_category_category_id_foreign');
        });
    }
}
