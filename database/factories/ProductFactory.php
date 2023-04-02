<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'product_name' => $this->faker->name,
            'product_price' => $this->faker->randomFloat(2, 0, 999999999),
            'product_description' => $this->faker->text,
            'product_category' => $this->faker->word,
            'product_image' => $this->faker->imageUrl(640, 480, 'cats', true, 'Faker'),
        ];
    }
}
