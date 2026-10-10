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
        // 1. Add scratch_card_access to services table
        Schema::table('services', function (Blueprint $table) {
            if (!Schema::hasColumn('services', 'scratch_card_access')) {
                $table->string('scratch_card_access')->default('N')->after('double_qr_access');
            }
        });

        // 2. Add scratch_card_access to users table
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'scratch_card_access')) {
                $table->string('scratch_card_access')->default('NO')->after('double_qr_access');
            }
        });

        // 3. Create scratch_cards table
        if (!Schema::hasTable('scratch_cards')) {
            Schema::create('scratch_cards', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id');
                $table->string('title')->default('Special Scratch & Win');
                $table->string('offer_text');
                $table->string('coupon_code')->nullable();
                $table->text('description')->nullable();
                $table->string('card_theme')->default('gold'); // gold, emerald, sapphire, crimson, violet
                $table->enum('status', ['active', 'inactive'])->default('inactive');
                $table->timestamps();

                $table->index('user_id');
                $table->index('status');
            });
        }

        // 4. Create scratch_card_leads table
        if (!Schema::hasTable('scratch_card_leads')) {
            Schema::create('scratch_card_leads', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id');
                $table->unsignedBigInteger('scratch_card_id')->nullable();
                $table->string('customer_name');
                $table->string('customer_phone');
                $table->string('customer_email')->nullable();
                $table->string('offer_won')->nullable();
                $table->string('coupon_code')->nullable();
                $table->string('status')->default('claimed'); // claimed, redeemed
                $table->timestamps();

                $table->index('user_id');
                $table->index('scratch_card_id');
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
        Schema::table('services', function (Blueprint $table) {
            if (Schema::hasColumn('services', 'scratch_card_access')) {
                $table->dropColumn('scratch_card_access');
            }
        });

        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'scratch_card_access')) {
                $table->dropColumn('scratch_card_access');
            }
        });

        Schema::dropIfExists('scratch_card_leads');
        Schema::dropIfExists('scratch_cards');
    }
};
