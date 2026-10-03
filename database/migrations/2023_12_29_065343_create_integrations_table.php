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
        Schema::create('integrations', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('type');
            $table->text('name')->nullable();
            $table->text('place_id')->nullable();
            $table->text('review_links')->nullable();
            $table->text('url')->nullable();
            $table->text('formatted_address')->nullable();
            $table->text('formatted_phone_number')->nullable();
            $table->text('profile_photo_url')->nullable();
            $table->text('rating')->nullable();
            $table->text('reference')->nullable();
            $table->text('user_ratings_total')->nullable();
            $table->text('website')->nullable();
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
        Schema::dropIfExists('integrations');
    }
};
