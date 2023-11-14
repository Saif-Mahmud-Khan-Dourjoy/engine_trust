<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPermanentDeleteToPermanetDeletedQueriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('deleted_queries', function (Blueprint $table) {
            $table->bigInteger('permanent_delete')->default(0)->after('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('deleted_queries', function (Blueprint $table) {
            $table->dropColumn('permanent_delete');
        });
    }
}
