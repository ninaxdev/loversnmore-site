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
        if (!Schema::hasTable('gift_icebreakers')) {
            Schema::create('gift_icebreakers', function (Blueprint $table) {
                $table->id();
                $table->text('message');
                $table->tinyInteger('status')->default(1); // 1 = active, 0 = inactive
                $table->timestamp('created_at')->useCurrent();

                // Add index for status for faster active icebreaker queries
                $table->index('status');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gift_icebreakers');
    }
};
