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
        Schema::create('social_reviews', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->text('url');
            $table->text('author_name')->nullable();
            $table->text('author_url')->nullable();
            $table->text('language')->nullable();
            $table->text('profile_photo_url')->nullable();
            $table->text('rating')->nullable();
            $table->text('relative_time_description')->nullable();
            $table->text('text')->nullable();
            $table->text('time')->nullable();
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
        Schema::dropIfExists('social_reviews');
    }
};
