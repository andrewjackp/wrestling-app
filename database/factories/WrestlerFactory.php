<?php


namespace Database\Factories;
use App\Models\Promotion;
use Illuminate\Database\Eloquent\Factories\Factory;
use Database\Factories\Concerns\ForPromotion;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class WrestlerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    use ForPromotion;

    public function definition(): array
    {
        return [
            "name" => fake()->name(),
            'promotion_id' => Promotion::query()->inRandomOrder()->value('id') ?? Promotion::factory(),
            //attach wrestler to promotion if they exist, otherwise create one
        ];
    }
}
