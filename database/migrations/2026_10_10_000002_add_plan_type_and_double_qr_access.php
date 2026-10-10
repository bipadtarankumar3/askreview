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
        Schema::table('services', function (Blueprint $table) {
            if (!Schema::hasColumn('services', 'plan_type')) {
                $table->string('plan_type')->default('basic')->after('title');
            }
            if (!Schema::hasColumn('services', 'double_qr_access')) {
                $table->string('double_qr_access')->default('N')->after('video_access');
            }
        });

        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'double_qr_access')) {
                $table->string('double_qr_access')->default('NO')->after('video_access');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('services', function (Blueprint $table) {
            if (Schema::hasColumn('services', 'plan_type')) {
                $table->dropColumn('plan_type');
            }
            if (Schema::hasColumn('services', 'double_qr_access')) {
                $table->dropColumn('double_qr_access');
            }
        });

        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'double_qr_access')) {
                $table->dropColumn('double_qr_access');
            }
        });
    }
};
