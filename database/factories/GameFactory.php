<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use \App\Models\Game;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Game>
 */
class GameFactory extends Factory
{

    protected $model = Game::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'image_path' => $this->faker->imageUrl($width = 200, $height = 200),
            'price' => null,
            'description' => $this->faker->paragraph,
            'type' => null,
            'cdkeys_price' => $this->faker->randomDigit, 
            'cdkeys_link' => $this->faker->url,
            'g2a_price' => $this->faker->randomDigit, 
            'g2a_link' => $this->faker->url,
            'g2a_search_link' => $this->faker->url
     
        ];
    }
}
