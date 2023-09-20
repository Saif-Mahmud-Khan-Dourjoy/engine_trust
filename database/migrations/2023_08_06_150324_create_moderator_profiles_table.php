<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModeratorProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('moderator_profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('moderator_id')->unsigned();
            $table->foreign('moderator_id')->references('id')->on('moderators')->onDelete('cascade');
            $table->string('user_name', 100);
            $table->string('first_name', 100)->nullable();       
            $table->string('last_name', 100)->nullable();
            $table->string('phone', 50)->nullable();
            $table->string('img', 200)->nullable();
            $table->text('address')->nullable();
            $table->date('joining_date')->nullable();
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
        Schema::dropIfExists('moderator_profiles');
    }
}
