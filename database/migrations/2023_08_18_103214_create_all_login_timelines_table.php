<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAllLoginTimelinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('all_login_timelines', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('business_user_id')->unsigned()->nullable();
            $table->foreign('business_user_id')->references('id')->on('business_users')->onDelete('cascade');
            $table->unsignedBigInteger('moderator_id')->unsigned()->nullable();
            $table->foreign('moderator_id')->references('id')->on('moderators')->onDelete('cascade');
            $table->unsignedBigInteger('super_admin_id')->unsigned()->nullable();
            $table->foreign('super_admin_id')->references('id')->on('super_admins')->onDelete('cascade');
            $table->bigInteger('user_type'); 
            $table->bigInteger('user_company_id')->nullable();   
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
        Schema::dropIfExists('all_login_timelines');
    }
}
