<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUserSubscriptionsTable extends Migration
{
    public function up()
    {
        Schema::table('user_subscriptions', function (Blueprint $table) {
            $table->string('stripe_subscription_id', 100)->nullable()->after('plan_id');
            $table->string('stripe_price_id', 100)->nullable()->after('stripe_subscription_id');
            $table->string('plan_key', 50)->nullable()->after('stripe_price_id');
            $table->string('plan_interval', 10)->nullable()->after('plan_key');
            $table->decimal('plan_price', 8, 2)->nullable()->after('plan_interval');
            $table->timestamp('canceled_at')->nullable()->after('expiry_at');
            $table->boolean('cancel_at_period_end')->default(false)->after('canceled_at');
            $table->unsignedBigInteger('pending_plan_id')->nullable()->after('cancel_at_period_end');

            $table->index('stripe_subscription_id');
        });
    }

    public function down()
    {
        Schema::table('user_subscriptions', function (Blueprint $table) {
            $table->dropIndex(['stripe_subscription_id']);
            $table->dropColumn([
                'stripe_subscription_id',
                'stripe_price_id',
                'plan_key',
                'plan_interval',
                'plan_price',
                'canceled_at',
                'cancel_at_period_end',
                'pending_plan_id',
            ]);
        });
    }
}
