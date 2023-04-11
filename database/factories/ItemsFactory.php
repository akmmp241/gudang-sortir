<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Items;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Items>
 */
class ItemsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_user' => 1,
            'item_id' => $this->faker->userName(),
            'id_category' => $this->faker->numberBetween(1, Category::all()->count()),
            'counter' => '1',
            'name_item' => $this->faker->name(),
        ];
    }
}
