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
        if (Schema::hasTable('scratch_cards')) {
            Schema::table('scratch_cards', function (Blueprint $table) {
                if (!Schema::hasColumn('scratch_cards', 'image')) {
                    $table->string('image')->nullable()->after('description');
                }
                if (!Schema::hasColumn('scratch_cards', 'view_count')) {
                    $table->unsignedInteger('view_count')->default(0)->after('status');
                }
                if (!Schema::hasColumn('scratch_cards', 'scratch_count')) {
                    $table->unsignedInteger('scratch_count')->default(0)->after('view_count');
                }
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
        if (Schema::hasTable('scratch_cards')) {
            Schema::table('scratch_cards', function (Blueprint $table) {
                if (Schema::hasColumn('scratch_cards', 'image')) {
                    $table->dropColumn('image');
                }
                if (Schema::hasColumn('scratch_cards', 'view_count')) {
                    $table->dropColumn('view_count');
                }
                if (Schema::hasColumn('scratch_cards', 'scratch_count')) {
                    $table->dropColumn('scratch_count');
                }
            });
        }
    }
};
