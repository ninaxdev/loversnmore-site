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
            // Stripe payment fields (gifts now use direct USD payment, not credits)
            $table->string('stripe_payment_intent_id', 255)->nullable()->after('price');
            $table->string('stripe_payment_status', 50)->nullable()->after('stripe_payment_intent_id');
            $table->decimal('stripe_amount', 10, 2)->nullable()->after('stripe_payment_status');
            $table->string('stripe_charge_id', 255)->nullable()->after('stripe_amount');
            $table->string('stripe_currency', 10)->default('usd')->nullable()->after('stripe_charge_id');

            // Recipient share (Stripe Connect) - ~60%
            $table->decimal('recipient_amount', 10, 2)->nullable()->after('stripe_currency');
            $table->string('recipient_transfer_id', 255)->nullable()->after('recipient_amount');

            // Affiliate commission - ~20%
            $table->decimal('affiliate_commission', 10, 2)->nullable()->after('recipient_transfer_id');
            $table->integer('affiliate_user_id')->unsigned()->nullable()->after('affiliate_commission');
            $table->string('affiliate_transfer_id', 255)->nullable()->after('affiliate_user_id');

            // Platform fee - ~20%
            $table->decimal('platform_fee', 10, 2)->nullable()->after('affiliate_transfer_id');

            // Stripe fees (2.9% + $0.30)
            $table->decimal('stripe_fee', 10, 2)->nullable()->after('platform_fee');

            // Payment metadata (store additional info as JSON)
            $table->json('payment_metadata')->nullable()->after('stripe_fee');

            // Add indexes for faster queries
            $table->index('stripe_payment_intent_id');
            $table->index('stripe_payment_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_gifts', function (Blueprint $table) {
            // Drop indexes first
            $table->dropIndex(['stripe_payment_intent_id']);
            $table->dropIndex(['stripe_payment_status']);

            // Drop columns
            $table->dropColumn([
                'stripe_payment_intent_id',
                'stripe_payment_status',
                'stripe_amount',
                'stripe_charge_id',
                'stripe_currency',
                'recipient_amount',
                'recipient_transfer_id',
                'affiliate_commission',
                'affiliate_user_id',
                'affiliate_transfer_id',
                'platform_fee',
                'stripe_fee',
                'payment_metadata',
            ]);
        });
    }
};
