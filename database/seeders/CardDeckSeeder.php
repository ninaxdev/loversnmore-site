<?php

namespace Database\Seeders;

use App\Yantrana\Components\Icebreaker\Models\CardDeck;
use App\Yantrana\Components\Icebreaker\Models\CardQuestion;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CardDeckSeeder extends Seeder
{
    /**
     * Seed the initial LoversNmore Icebreaker decks.
     * Content matches the approved prototype so we launch with something playable.
     * Nina replaces / expands via the admin panel.
     */
    public function run(): void
    {
        $decks = [
            [
                'name' => 'First Date',
                'slug' => 'first-date',
                'caption' => 'Skip the small talk.',
                'description' => 'The questions that turn a first date into a second one. Playful, sharp, and just a little honest.',
                'category' => CardDeck::CATEGORY_DATING,
                'variant' => CardDeck::VARIANT_SOLID,
                'vibe_label' => 'Playful',
                'sort_order' => 1,
                'cards' => [
                    ["What's the first thing you notice about someone across the room?", 'GET REAL'],
                    ["What's a small habit that instantly makes you like someone more?", 'GET REAL'],
                    ["What does your ideal Sunday morning look like — and who's in it?", 'IMAGINE'],
                    ["What's the last thing that made you genuinely laugh out loud?", 'SPILL'],
                    ["What's a red flag you've learned to spot within the first ten minutes?", 'BE FOR REAL'],
                    ["What's an unpopular opinion you'll defend to the end?", 'SPICY'],
                    ["If we walked out of here right now — where would you take me?", 'DO SOMETHING'],
                    ["What's a compliment you don't hear enough?", 'SOFT SPOT'],
                ],
            ],
            [
                'name' => 'Couples',
                'slug' => 'couples',
                'caption' => "There's always more to discover.",
                'description' => 'For couples who want to keep learning each other. Some soft, some deep, all worth asking.',
                'category' => CardDeck::CATEGORY_COUPLES,
                'variant' => CardDeck::VARIANT_SOFT,
                'vibe_label' => 'Deep',
                'sort_order' => 2,
                'cards' => [
                    ["What does 'home' feel like when it's just us?", 'SOFT'],
                    ["What's a small ritual of ours you'd never want to lose?", 'GO DEEP'],
                    ["What's the version of me you first fell for?", 'REMEMBER WHEN'],
                    ["When was the last time I really made you feel seen?", 'BE FOR REAL'],
                    ["What's a fight we had that changed something for the better?", 'GO DEEP'],
                    ["What are we still learning about each other?", 'GO DEEP'],
                    ["What's something you love about us that no one else would notice?", 'SOFT'],
                    ["What do you need from me on your hardest days?", 'BE FOR REAL'],
                ],
            ],
            [
                'name' => "Girls' Night",
                'slug' => 'girls-night',
                'caption' => 'The questions that start the stories.',
                'description' => "Pour a drink. Get comfy. These are the questions that turn a hangout into a story you'll retell for years.",
                'category' => CardDeck::CATEGORY_FRIENDS,
                'variant' => CardDeck::VARIANT_SOLID,
                'vibe_label' => 'Unfiltered',
                'sort_order' => 3,
                'cards' => [
                    ["What's the most spontaneous thing you've done and lived to tell?", 'SPILL'],
                    ["Who's your celebrity freebie — and defend the choice.", 'SPICY'],
                    ["What's a text you drafted but never sent?", 'BE FOR REAL'],
                    ["What's the wildest excuse you've made to skip plans?", 'SPILL'],
                    ["What's a truly bad habit you flat-out refuse to give up?", 'SPICY'],
                    ["Whose partner do you not really approve of, and why?", 'SPICY'],
                    ["What's a compliment people give you that always feels suspect?", 'BE FOR REAL'],
                    ["What's the pettiest thing you've done and gotten away with?", 'SPILL'],
                ],
            ],
            [
                'name' => 'New Friends',
                'slug' => 'new-friends',
                'caption' => 'Make meeting someone new less awkward.',
                'description' => 'Meeting someone for the first time? These are your low-stakes, high-charm openers.',
                'category' => CardDeck::CATEGORY_FRIENDS,
                'variant' => CardDeck::VARIANT_SOFT,
                'vibe_label' => 'Easy',
                'sort_order' => 4,
                'cards' => [
                    ["What's something you're weirdly good at?", 'GET TO KNOW YOU'],
                    ["What's a show you'd rewatch a hundred times and never get sick of?", 'PICK ONE'],
                    ["What's your go-to karaoke song?", 'DO SOMETHING'],
                    ["What's the best thing you've eaten in the last month?", 'PICK ONE'],
                    ["What's a random skill you wish you had?", 'IMAGINE'],
                    ["What's a place in this city you'd take a first-time visitor?", 'PICK ONE'],
                    ["What's your comfort scroll — where do you always end up?", 'BE FOR REAL'],
                    ["What's something you loved as a kid that you still love now?", 'SOFT'],
                ],
            ],
        ];

        foreach ($decks as $deckData) {
            $cards = $deckData['cards'];
            unset($deckData['cards']);

            $deckData['_uid'] = (string) Str::uuid();
            $deckData['status'] = CardDeck::STATUS_PUBLISHED;

            $deck = CardDeck::updateOrCreate(
                ['slug' => $deckData['slug']],
                $deckData
            );

            // Skip re-seeding questions if this deck already has any (idempotent)
            if ($deck->questions()->exists()) {
                continue;
            }

            foreach ($cards as $index => [$text, $tag]) {
                CardQuestion::create([
                    '_uid' => (string) Str::uuid(),
                    'card_decks__id' => $deck->_id,
                    'question_text' => $text,
                    'category_tag' => $tag,
                    'status' => CardQuestion::STATUS_ACTIVE,
                    'sort_order' => $index + 1,
                ]);
            }
        }

        $this->command->info('Seeded ' . count($decks) . ' Icebreaker decks with sample questions.');
    }
}
