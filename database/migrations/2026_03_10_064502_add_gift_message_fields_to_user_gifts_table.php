<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('user_gifts', function (Blueprint $table) {
            // Message fields for gifts
            if (!Schema::hasColumn('user_gifts', 'message_type')) {
                $table->enum('message_type', ['none', 'icebreaker', 'custom'])->default('none')->after('payment_metadata');
            }
            if (!Schema::hasColumn('user_gifts', 'message_content')) {
                $table->text('message_content')->nullable()->after('message_type');
            }
            if (!Schema::hasColumn('user_gifts', 'icebreaker_id')) {
                $table->unsignedBigInteger('icebreaker_id')->nullable()->after('message_content');
            }

            // Recipient action tracking
            if (!Schema::hasColumn('user_gifts', 'recipient_action')) {
                $table->enum('recipient_action', ['pending', 'thanked', 'chatted', 'ignored'])->default('pending')->after('icebreaker_id');
            }

            // Add index for faster queries
            if (!Schema::hasColumn('user_gifts', 'recipient_action')) {
                $table->index('recipient_action');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_gifts', function (Blueprint $table) {
            // Drop index first
            $table->dropIndex(['recipient_action']);

            // Drop columns
            $table->dropColumn([
                'message_type',
                'message_content',
                'icebreaker_id',
                'recipient_action',
            ]);
        });
    }
};
