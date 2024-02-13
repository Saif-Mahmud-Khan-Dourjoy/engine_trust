<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('business_name');
            $table->string('trade_name')->nullable();
            $table->string('business_type');
            $table->string('website')->nullable();
            $table->string('address');
            $table->string('city');
            $table->string('post_code');
            $table->string('country');
            $table->string('vat_no')->nullable();
            $table->string('primary_phone');
            $table->string('alternative_phone')->nullable();
            $table->string('other_phone')->nullable();
            $table->bigInteger('status')->default(1)->comment('0 for Block, 1 for Active');
            $table->text('logo')->nullable();
            $table->bigInteger('rating')->nullable();
            $table->string('expiry_date')->nullable();
            $table->bigInteger('marketing_email')->default(0)->comment('0 for No, 1 for Yes');
            $table->bigInteger('enquiry_email')->default(0)->comment('0 for No, 1 for Yes');
            $table->string('warranty')->nullable();
            $table->string('recovery_rate')->nullable();
            $table->string('default_condition')->nullable();
            $table->string('quoting_person_name')->nullable();
            $table->string('subscribed_at')->nullable();
            $table->string('subscribed_till')->nullable();
            $table->bigInteger('approved_status')->default(0)->comment('0 for No, 1 for Yes');
            $table->bigInteger('accepted_by')->nullable();
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
        Schema::dropIfExists('business_profiles');
    }
}
