<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToAnnouncementUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('announcement_user', function (Blueprint $table) {
            $table->foreign(['announcement_id'])->references(['id'])->on('announcements')->onDelete('CASCADE');
            $table->foreign(['user_id'])->references(['id'])->on('users')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('announcement_user', function (Blueprint $table) {
            $table->dropForeign('announcement_user_announcement_id_foreign');
            $table->dropForeign('announcement_user_user_id_foreign');
        });
    }
}
