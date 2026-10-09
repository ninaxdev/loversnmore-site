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
        Schema::create('card_questions', function (Blueprint $table) {
            $table->bigIncrements('_id');
            $table->string('_uid', 36)->unique();

            $table->unsignedBigInteger('card_decks__id');

            $table->text('question_text');

            // Optional category tag shown as a pill on the card: BE FOR REAL, GO DEEP, SPICY, etc.
            $table->string('category_tag', 40)->nullable();

            // 1 = active, 0 = hidden
            $table->tinyInteger('status')->default(1);

            $table->integer('sort_order')->default(0);

            $table->timestamps();

            $table->foreign('card_decks__id')
                  ->references('_id')
                  ->on('card_decks')
                  ->onDelete('cascade');

            $table->index(['card_decks__id', 'status', 'sort_order'], 'card_questions_deck_status_order_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('card_questions', function (Blueprint $table) {
            $table->dropForeign(['card_decks__id']);
            $table->dropIndex('card_questions_deck_status_order_idx');
        });

        Schema::dropIfExists('card_questions');
    }
};
