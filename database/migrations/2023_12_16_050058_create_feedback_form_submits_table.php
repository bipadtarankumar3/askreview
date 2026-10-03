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
        Schema::create('feedback_form_submits', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('form_id');
            $table->text('f_customer_support')->nullable();
            $table->text('f_rate_text')->nullable();
            $table->text('f_comments')->nullable();
            $table->text('f_customer_name')->nullable();
            $table->text('f_phone_number')->nullable();
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
        Schema::dropIfExists('feedback_form_submits');
    }
};
