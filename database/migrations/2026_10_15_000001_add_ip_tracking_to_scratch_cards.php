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
        // 1. Add ip_address column to scratch_card_leads if not present
        if (Schema::hasTable('scratch_card_leads') && !Schema::hasColumn('scratch_card_leads', 'ip_address')) {
            Schema::table('scratch_card_leads', function (Blueprint $table) {
                $table->string('ip_address', 45)->nullable()->after('coupon_code');
                $table->index('ip_address');
            });
        }

        // 2. Create scratch_card_ip_logs table to track 1 scratch per IP
        if (!Schema::hasTable('scratch_card_ip_logs')) {
            Schema::create('scratch_card_ip_logs', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id');
                $table->unsignedBigInteger('scratch_card_id');
                $table->string('ip_address', 45);
                $table->timestamps();

                $table->index(['scratch_card_id', 'ip_address']);
                $table->index(['user_id', 'ip_address']);
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
        if (Schema::hasTable('scratch_card_leads') && Schema::hasColumn('scratch_card_leads', 'ip_address')) {
            Schema::table('scratch_card_leads', function (Blueprint $table) {
                $table->dropIndex(['ip_address']);
                $table->dropColumn('ip_address');
            });
        }

        Schema::dropIfExists('scratch_card_ip_logs');
    }
};
