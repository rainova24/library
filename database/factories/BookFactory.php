<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->sentence(),
            'author' => $this->faker->name(),
            'publication_date' => $this->faker->date($format = 'Y-m-d'),
            'category_id' => Category::all()->random()->id,
        ];
    }
}
