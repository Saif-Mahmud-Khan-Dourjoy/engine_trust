<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // $table->unsignedBigInteger('business_profile_id')->unsigned();
            // $table->foreign('business_profile_id')->references('id')->on('business_profiles')->onDelete('cascade');
            // $table->primary(['user_id','business_profile_id']);
            $table->string('first_name', 100);
            $table->string('last_name', 100)->nullable();
            $table->string('user_name', 100)->nullable();
            $table->string('email');
            $table->string('password');
            $table->string('phone', 50)->nullable();
            $table->string('img', 200)->nullable();
            $table->text('address')->nullable();
            $table->date('joining_date')->nullable();
            $table->string('designation')->nullable();
            $table->bigInteger('status')->comment('0 for Inactive, 1 for Active')->default(1);
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
        Schema::dropIfExists('business_users');
    }
}
