<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSunscriptionDataToBusinessProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('business_profiles', function (Blueprint $table) {
            $table->integer('fixed_subscription_time')->default(1)->comment('In Month')->after('approved_status');
            $table->text('fixed_subscription_amount')->nullable()->after('fixed_subscription_time');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('business_profiles', function (Blueprint $table) {
            $table->dropColumn('fixed_subscription_time');
            $table->dropColumn('fixed_subscription_amount');
        });
    }
}