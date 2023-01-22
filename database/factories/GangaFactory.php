<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Ganga;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ganga>
 */
class GangaFactory extends Factory
{
    protected $model = Ganga::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $price = $this->faker->randomFloat(2,10,500);

        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'url' => $this->faker->url,
            'likes' => 0,
            'unlikes' => 0,
            'price' => $price,
            'price_sale' => $this->faker->randomFloat(2,1,$price - 9),
            'available' => $this->faker->boolean,
            'category_id' => Category::inRandomOrder()->first(),
        ];
    }
}
