<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Bout;
use App\Models\Wrestler;
use App\Models\Promotion;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class BoutFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
        {
            return [
                "title" => fake()->sentence(3),
                "promotion_id" => Promotion::query()->inRandomOrder()->value('id') ?? Promotion::factory(),
            ];
        }

    public function configure(): static
        {
            return $this->afterCreating(function (Bout $bout) {

            $promotionId = $bout->promotion_id;

            // establish that we have enough wrestlers for the promotions

            $existing = Wrestler::where('promotion_id', $promotionId)->count();

            if ($existing < 4) {
                Wrestler::factory()
                    ->count(6)
                    ->create(['promotion_id' => $promotionId]);
            }

            // Attach 2–4 wrestlers from the SAME promotion
            $wrestlerIds = Wrestler::where('promotion_id', $promotionId)
                ->inRandomOrder()
                ->limit(fake()->numberBetween(2, 4))
                ->pluck('id')
                ->all();

            $bout->wrestlers()->sync($wrestlerIds);
            //sync method attaches ids 
        });
    }

}

/*
    Promotion
        its own info (i.e, name)


    Wrestler    
        its own info
        promotion id

    Bout
        promotion id

    Bout_wrestler
        (junction/pivot/...relationship table)
        
        wrestler_id
        bout_id

        date (come back to later)
        

    Team
        wrestler-id

    Team_wrestler
        wrestler-id
        (identify wrestler/tag-team/trio etc)
*/

// Bouts 
// promotion assigned to it


// together->wrestler-promotions
// loop through wrestlers in promotion
// print bout competitors/wrestlers