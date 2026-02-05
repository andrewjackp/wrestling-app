<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Database\Factories\Concerns\ForPromotion;
use App\Models\Promotion;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
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
            'article_title' => $this->faker->sentence(),
            'content' => $this->faker->paragraphs(3, true),
            'promotion_id' => Promotion::inRandomOrder()->value('id'),
        ];
    }
}
