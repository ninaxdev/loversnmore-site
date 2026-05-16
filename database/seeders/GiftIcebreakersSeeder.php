<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GiftIcebreakersSeeder extends Seeder
{
    /**
     * Seed gift-specific icebreakers.
     * Gift item IDs are resolved by title at runtime — safe to run on any environment.
     */
    public function run(): void
    {
        // Resolve gift item IDs by title (case-insensitive)
        $gifts = DB::table('items')
            ->whereIn(DB::raw('LOWER(title)'), ['coffee', 'cocktail', 'experience', 'dinner', 'surprise'])
            ->pluck('_id', DB::raw('LOWER(title)'));

        $coffeeId     = $gifts['coffee']     ?? null;
        $cocktailId   = $gifts['cocktail']   ?? null;
        $experienceId = $gifts['experience'] ?? null;
        $dinnerId     = $gifts['dinner']     ?? null;
        $surpriseId   = $gifts['surprise']   ?? null;

        // Warn if any gift is missing
        foreach (['coffee' => $coffeeId, 'cocktail' => $cocktailId, 'experience' => $experienceId, 'dinner' => $dinnerId, 'surprise' => $surpriseId] as $name => $id) {
            if (!$id) {
                $this->command->warn("Gift not found in items table: {$name} — icebreakers for this gift will be skipped.");
            }
        }

        // Clear existing icebreakers before reseeding
        DB::table('gift_icebreakers')->truncate();

        $now = now();

        $icebreakers = array_filter([

            // ----------------------------------------------------------------
            // Coffee
            // ----------------------------------------------------------------
            $coffeeId ? [
                'message'      => "Sending you coffee ☕ I figured I'd start earning points for our first coffee date. What are you ordering for us?",
                'gift_item_id' => $coffeeId,
                'status'       => 1,
                'created_at'   => $now,
            ] : null,
            $coffeeId ? [
                'message'      => "What's something you could talk about for way too long?",
                'gift_item_id' => $coffeeId,
                'status'       => 1,
                'created_at'   => $now,
            ] : null,
            $coffeeId ? [
                'message'      => "What's more attractive: confidence, humor, or someone remembering your coffee order?",
                'gift_item_id' => $coffeeId,
                'status'       => 1,
                'created_at'   => $now,
            ] : null,

            // ----------------------------------------------------------------
            // Dinner
            // ----------------------------------------------------------------
            $dinnerId ? [
                'message'      => "You seem like someone worth making reservations for. So tell me, what's your perfect dinner date?",
                'gift_item_id' => $dinnerId,
                'status'       => 1,
                'created_at'   => $now,
            ] : null,
            $dinnerId ? [
                'message'      => "What feels rare to you in dating now?",
                'gift_item_id' => $dinnerId,
                'status'       => 1,
                'created_at'   => $now,
            ] : null,
            $dinnerId ? [
                'message'      => "You seem like someone who values depth. What kind of connection actually keeps your attention?",
                'gift_item_id' => $dinnerId,
                'status'       => 1,
                'created_at'   => $now,
            ] : null,

            // ----------------------------------------------------------------
            // Cocktail
            // ----------------------------------------------------------------
            $cocktailId ? [
                'message'      => "You look like someone who appreciates good conversation and good taste. What's your favorite kind of night out?",
                'gift_item_id' => $cocktailId,
                'status'       => 1,
                'created_at'   => $now,
            ] : null,
            $cocktailId ? [
                'message'      => "Are you more slow burn or instant spark?",
                'gift_item_id' => $cocktailId,
                'status'       => 1,
                'created_at'   => $now,
            ] : null,
            $cocktailId ? [
                'message'      => "You seem like someone I'd actually enjoy getting a drink with. What's your go-to order?",
                'gift_item_id' => $cocktailId,
                'status'       => 1,
                'created_at'   => $now,
            ] : null,

            // ----------------------------------------------------------------
            // Experience
            // ----------------------------------------------------------------
            $experienceId ? [
                'message'      => "You seem like the kind of person who makes even bad movies worth watching. True?",
                'gift_item_id' => $experienceId,
                'status'       => 1,
                'created_at'   => $now,
            ] : null,
            $experienceId ? [
                'message'      => "You seem like the type who makes ordinary nights interesting. What's more your vibe — live music, movies, or spontaneous plans?",
                'gift_item_id' => $experienceId,
                'status'       => 1,
                'created_at'   => $now,
            ] : null,
            $experienceId ? [
                'message'      => "What kind of plans make you cancel your 'I'm staying in tonight' mood?",
                'gift_item_id' => $experienceId,
                'status'       => 1,
                'created_at'   => $now,
            ] : null,

            // ----------------------------------------------------------------
            // Surprise
            // ----------------------------------------------------------------
            $surpriseId ? [
                'message'      => "I don't usually do this, but you feel like someone I'd regret not knowing. What's something people only learn about you if they stay?",
                'gift_item_id' => $surpriseId,
                'status'       => 1,
                'created_at'   => $now,
            ] : null,
            $surpriseId ? [
                'message'      => "You seem like someone I'd stay up too late talking to. What conversation could keep you up all night?",
                'gift_item_id' => $surpriseId,
                'status'       => 1,
                'created_at'   => $now,
            ] : null,
            $surpriseId ? [
                'message'      => "There's something very intentional about your energy. What's something you never overlook in people?",
                'gift_item_id' => $surpriseId,
                'status'       => 1,
                'created_at'   => $now,
            ] : null,

        ]);

        if (!empty($icebreakers)) {
            DB::table('gift_icebreakers')->insert(array_values($icebreakers));
        }

        $this->command->info('Gift icebreakers seeded: ' . count($icebreakers) . ' icebreakers.');
    }
}
