<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PlansSeeder extends Seeder
{
    public function run(): void
    {
        $plans = [
            ['key' => 'basic',  'name' => 'Basic',  'price' => 9.99,   'interval' => 'month', 'stripe_price_id' => 'price_1Tpk2dFApJb5DAJnx9aKI3z4'],
            ['key' => 'basic',  'name' => 'Basic',  'price' => 99.00,  'interval' => 'year',  'stripe_price_id' => 'price_1Tpk31FApJb5DAJnjXvdoBcD'],
            ['key' => 'plus',   'name' => 'Plus',   'price' => 19.99,  'interval' => 'month', 'stripe_price_id' => 'price_1Tpk3UFApJb5DAJnJD7NlX8R'],
            ['key' => 'plus',   'name' => 'Plus',   'price' => 199.00, 'interval' => 'year',  'stripe_price_id' => 'price_1Tpk42FApJb5DAJnQVn1cr3r'],
            ['key' => 'elite',  'name' => 'Elite',  'price' => 29.99,  'interval' => 'month', 'stripe_price_id' => 'price_1Tpk4PFApJb5DAJn9dl1AAuu'],
            ['key' => 'elite',  'name' => 'Elite',  'price' => 279.00, 'interval' => 'year',  'stripe_price_id' => 'price_1Tpk4nFApJb5DAJnZWIWTWtL'],
        ];

        foreach ($plans as $plan) {
            DB::table('plans')->updateOrInsert(
                ['key' => $plan['key'], 'interval' => $plan['interval']],
                array_merge($plan, [
                    '_uid'       => (string) Str::uuid(),
                    'status'     => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ])
            );
        }

        $this->command->info('Plans seeded. Remember to update stripe_price_id after creating prices in Stripe Dashboard.');
    }
}
