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
        Schema::table('users', function (Blueprint $table) {
            // Stripe Connect account ID (for receiving gift payments)
            $table->string('stripe_connect_account_id', 255)->nullable()->after('stripe_customer_id');

            // Stripe Connect status: pending, active, restricted, disabled
            $table->string('stripe_connect_status', 50)->nullable()->after('stripe_connect_account_id');

            // Onboarding completion status
            $table->boolean('stripe_onboarding_completed')->default(false)->after('stripe_connect_status');

            // Capability flags from Stripe
            $table->boolean('stripe_charges_enabled')->default(false)->after('stripe_onboarding_completed');
            $table->boolean('stripe_payouts_enabled')->default(false)->after('stripe_charges_enabled');
            $table->boolean('stripe_details_submitted')->default(false)->after('stripe_payouts_enabled');

            // Financial tracking
            $table->decimal('total_earnings', 10, 2)->default(0)->after('stripe_details_submitted');
            $table->decimal('available_balance', 10, 2)->default(0)->after('total_earnings');

            // Track last onboarding attempt
            $table->timestamp('stripe_onboarding_started_at')->nullable()->after('available_balance');
            $table->timestamp('stripe_onboarding_completed_at')->nullable()->after('stripe_onboarding_started_at');

            // Indexes for faster queries
            $table->index('stripe_connect_account_id');
            $table->index('stripe_connect_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop indexes first
            $table->dropIndex(['stripe_connect_account_id']);
            $table->dropIndex(['stripe_connect_status']);

            // Drop columns
            $table->dropColumn([
                'stripe_connect_account_id',
                'stripe_connect_status',
                'stripe_onboarding_completed',
                'stripe_charges_enabled',
                'stripe_payouts_enabled',
                'stripe_details_submitted',
                'total_earnings',
                'available_balance',
                'stripe_onboarding_started_at',
                'stripe_onboarding_completed_at',
            ]);
        });
    }
};
