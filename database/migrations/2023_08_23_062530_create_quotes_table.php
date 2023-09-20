<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('enquiry_id')->unsigned();
            $table->foreign('enquiry_id')->references('id')->on('enquiries')->onDelete('cascade');
            $table->string('warranty');
            $table->string('condition');
            $table->string('mileage');
            $table->unsignedBigInteger('quoted_by')->nullable();
            $table->foreign('quoted_by')->references('id')->on('business_users');
            $table->unsignedBigInteger('quoted_company_by');
            $table->foreign('quoted_company_by')->references('id')->on('users')->onDelete('cascade');
            $table->text('other_note')->nullable();
            $table->text('message')->nullable();
            $table->float('engines')->default(0)->nullable();
            $table->float('exchange_surcharge')->default(0)->nullable();
            $table->float('delivery_charges')->default(0)->nullable();
            $table->float('recovery')->default(0)->nullable();
            $table->float('fitting')->default(0)->nullable();
            $table->float('vat')->default(0)->nullable();
            $table->string('vn')->nullable();
            $table->string('ref')->nullable();
            $table->bigInteger('job')->default(0);
            $table->bigInteger('hidden')->default(0);
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
        Schema::dropIfExists('quotes');
    }
}
