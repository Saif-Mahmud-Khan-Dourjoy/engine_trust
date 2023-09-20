<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnquiriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enquiries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('auto_generated_id');
            $table->string('car_make')->nullable();
            $table->string('car_series')->nullable();
            $table->string('car_model')->nullable();
            $table->string('car_reg_year')->nullable();
            $table->string('car')->nullable();
            $table->string('request_part');
            $table->string('ref_no');
            $table->string('engine_code')->nullable();
            $table->string('reg_num');
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->string('post_code')->nullable();
            $table->string('query_user_email')->nullable();
            $table->string('query_user_fullname')->nullable();
            $table->string('query_user_phone')->nullable();
            $table->string('problem_with_engine')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enquiries');
    }
}
