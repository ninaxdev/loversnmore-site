<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPendingEarningsToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Holds gift earnings for users who haven't set up Stripe Connect yet
            $table->decimal('pending_earnings', 10, 2)->default(0)->after('total_earnings');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('pending_earnings');
        });
    }
}
