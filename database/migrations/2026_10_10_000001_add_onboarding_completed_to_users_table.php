<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('users', 'onboarding_completed')) {
            Schema::table('users', function (Blueprint $table) {
                $table->tinyInteger('onboarding_completed')->default(0)->after('status');
            });

            // Mark existing users with a valid phone number as completed
            DB::table('users')->whereNotNull('phone')->where('phone', '!=', '')->update(['onboarding_completed' => 1]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('users', 'onboarding_completed')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('onboarding_completed');
            });
        }
    }
};
