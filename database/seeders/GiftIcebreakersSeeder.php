<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GiftIcebreakersSeeder extends Seeder
{
    /**
     * Seed gift-specific icebreakers.
     *
     * Gift item IDs (from items table):
     *   3 = Coffee
     *   4 = Cocktail
     *   5 = Experience (Events)
     *   6 = Dinner
     *   7 = Surprise
     *
     * gift_item_id = null means generic (shown as fallback for any gift)
     */
    public function run(): void
    {
        // Clear existing icebreakers before reseeding
        DB::table('gift_icebreakers')->truncate();

        $now = now();

        $icebreakers = [

            // ----------------------------------------------------------------
            // Coffee (gift_item_id = 3)
            // ----------------------------------------------------------------
            [
                'message'      => "Sending you coffee ☕ I figured I'd start earning points for our first coffee date. What are you ordering for us?",
                'gift_item_id' => 3,
                'status'       => 1,
                'created_at'   => $now,
            ],
            [
                'message'      => "What's something you could talk about for way too long?",
                'gift_item_id' => 3,
                'status'       => 1,
                'created_at'   => $now,
            ],
            [
                'message'      => "What's more attractive: confidence, humor, or someone remembering your coffee order?",
                'gift_item_id' => 3,
                'status'       => 1,
                'created_at'   => $now,
            ],

            // ----------------------------------------------------------------
            // Dinner (gift_item_id = 6)
            // ----------------------------------------------------------------
            [
                'message'      => "You seem like someone worth making reservations for. So tell me, what's your perfect dinner date?",
                'gift_item_id' => 6,
                'status'       => 1,
                'created_at'   => $now,
            ],
            [
                'message'      => "What feels rare to you in dating now?",
                'gift_item_id' => 6,
                'status'       => 1,
                'created_at'   => $now,
            ],
            [
                'message'      => "You seem like someone who values depth. What kind of connection actually keeps your attention?",
                'gift_item_id' => 6,
                'status'       => 1,
                'created_at'   => $now,
            ],

            // ----------------------------------------------------------------
            // Cocktail (gift_item_id = 4)
            // ----------------------------------------------------------------
            [
                'message'      => "You look like someone who appreciates good conversation and good taste. What's your favorite kind of night out?",
                'gift_item_id' => 4,
                'status'       => 1,
                'created_at'   => $now,
            ],
            [
                'message'      => "Are you more slow burn or instant spark?",
                'gift_item_id' => 4,
                'status'       => 1,
                'created_at'   => $now,
            ],
            [
                'message'      => "You seem like someone I'd actually enjoy getting a drink with. What's your go-to order?",
                'gift_item_id' => 4,
                'status'       => 1,
                'created_at'   => $now,
            ],

            // ----------------------------------------------------------------
            // Experience / Events (gift_item_id = 5)
            // ----------------------------------------------------------------
            [
                'message'      => "You seem like the kind of person who makes even bad movies worth watching. True?",
                'gift_item_id' => 5,
                'status'       => 1,
                'created_at'   => $now,
            ],
            [
                'message'      => "You seem like the type who makes ordinary nights interesting. What's more your vibe — live music, movies, or spontaneous plans?",
                'gift_item_id' => 5,
                'status'       => 1,
                'created_at'   => $now,
            ],
            [
                'message'      => "What kind of plans make you cancel your 'I'm staying in tonight' mood?",
                'gift_item_id' => 5,
                'status'       => 1,
                'created_at'   => $now,
            ],

            // ----------------------------------------------------------------
            // Surprise (gift_item_id = 7)
            // ----------------------------------------------------------------
            [
                'message'      => "I don't usually do this, but you feel like someone I'd regret not knowing. What's something people only learn about you if they stay?",
                'gift_item_id' => 7,
                'status'       => 1,
                'created_at'   => $now,
            ],
            [
                'message'      => "You seem like someone I'd stay up too late talking to. What conversation could keep you up all night?",
                'gift_item_id' => 7,
                'status'       => 1,
                'created_at'   => $now,
            ],
            [
                'message'      => "There's something very intentional about your energy. What's something you never overlook in people?",
                'gift_item_id' => 7,
                'status'       => 1,
                'created_at'   => $now,
            ],

        ];

        DB::table('gift_icebreakers')->insert($icebreakers);

        $this->command->info('Gift icebreakers seeded: ' . count($icebreakers) . ' icebreakers across 5 gift types.');
    }
}
