<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Flip variant from strict ENUM('solid','soft') to a flexible VARCHAR
     * so we can introduce new cover styles (white-pink, white-purple, etc.)
     * without needing a migration every time.
     */
    public function up(): void
    {
        // DBAL doesn't play nice with enum changes across all MySQL versions,
        // so do it raw. Preserves existing data (all values become varchar as-is).
        DB::statement("ALTER TABLE card_decks MODIFY COLUMN variant VARCHAR(30) NOT NULL DEFAULT 'solid'");
    }

    public function down(): void
    {
        // On rollback, snap any non-enum values back to 'solid' so the enum doesn't error.
        DB::statement("UPDATE card_decks SET variant = 'solid' WHERE variant NOT IN ('solid','soft')");
        DB::statement("ALTER TABLE card_decks MODIFY COLUMN variant ENUM('solid','soft') NOT NULL DEFAULT 'solid'");
    }
};
