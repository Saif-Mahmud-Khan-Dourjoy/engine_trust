<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNullableColumnToQuotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quotes', function (Blueprint $table) {
            $table->string('warranty')->nullable(true)->change();
            $table->string('condition')->nullable(true)->change();
            $table->string('mileage')->nullable(true)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('quotes', function (Blueprint $table) {
            $table->string('warranty')->nullable(false)->change();
            $table->string('condition')->nullable(false)->change();
            $table->string('mileage')->nullable(false)->change();
        });
    }
}
