<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('service_id')->nullable();
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->text('address')->nullable();
            $table->string('transction_id')->nullable();
            $table->string('price')->nullable();
            $table->float('gst_amount')->nullable();
            $table->string('gst_number')->nullable();
            $table->float('grand_total')->nullable();
            $table->string('payment_type')->nullable();
            $table->date('form_date')->nullable();
            $table->date('to_date')->nullable();
            $table->integer('previous_credit')->nullable();
            $table->integer('extend_credit')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('payments');
    }
};
