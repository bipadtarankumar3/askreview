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
        if (Schema::hasTable('private_reviews') && !Schema::hasColumn('private_reviews', 'voice')) {
            Schema::table('private_reviews', function (Blueprint $table) {
                $table->string('voice')->nullable()->after('email');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasTable('private_reviews') && Schema::hasColumn('private_reviews', 'voice')) {
            Schema::table('private_reviews', function (Blueprint $table) {
                $table->dropColumn('voice');
            });
        }
    }
};
