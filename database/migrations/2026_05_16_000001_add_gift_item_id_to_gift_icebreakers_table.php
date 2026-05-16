<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('gift_icebreakers', function (Blueprint $table) {
            if (!Schema::hasColumn('gift_icebreakers', 'gift_item_id')) {
                // null = generic (shown for all gifts as fallback)
                $table->unsignedBigInteger('gift_item_id')->nullable()->after('message');
                $table->index('gift_item_id');
            }
        });
    }

    public function down(): void
    {
        Schema::table('gift_icebreakers', function (Blueprint $table) {
            $table->dropIndex(['gift_item_id']);
            $table->dropColumn('gift_item_id');
        });
    }
};
