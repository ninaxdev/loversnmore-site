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
        Schema::create('card_decks', function (Blueprint $table) {
            $table->bigIncrements('_id');
            $table->string('_uid', 36)->unique();

            $table->string('name', 100);
            $table->string('slug', 120)->unique();
            $table->string('caption', 200)->nullable();
            $table->text('description')->nullable();

            // dating | couples | friends (extensible via admin)
            $table->string('category', 50)->index();

            // solid = deep purple cover, soft = light lavender cover
            $table->enum('variant', ['solid', 'soft'])->default('solid');

            $table->string('cover_image')->nullable();
            $table->string('vibe_label', 40)->nullable(); // "Playful", "Deep", "Unfiltered"

            // 0 = draft, 1 = published
            $table->tinyInteger('status')->default(0);

            $table->integer('sort_order')->default(0);

            $table->timestamps();

            $table->index(['status', 'sort_order']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('card_decks', function (Blueprint $table) {
            $table->dropIndex(['status', 'sort_order']);
            $table->dropIndex(['category']);
        });

        Schema::dropIfExists('card_decks');
    }
};
