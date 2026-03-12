<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GiftIcebreakersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // First, clear existing icebreakers
        \DB::table('gift_icebreakers')->truncate();

        $icebreakers = [
            "You strike me as someone with great comfort-show taste.\n\nWhat's your most rewatched show?",

            "If we had a free evening, what sounds better:\n\na show, a movie, or exploring somewhere new",

            "If we had the day to explore the city, what kind of spot would we start with?",
        ];

        foreach ($icebreakers as $message) {
            \DB::table('gift_icebreakers')->insert([
                'message' => $message,
                'status' => 1,
                'created_at' => now(),
            ]);
        }
    }
}
