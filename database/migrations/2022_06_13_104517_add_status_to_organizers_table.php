<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToOrganizersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('organizers', function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->nullable();
            $table->enum('status', ['PENDING', 'APPROVED', 'REJECTED', 'PUBLISHED'])->default('PENDING');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('organizers', function (Blueprint $table) {
            $table->dropForeign('organizers_user_id_foreign');
            $table->dropColumn('user_id');
            $table->dropColumn('status');
        });
    }
}
