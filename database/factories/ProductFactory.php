<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(['product']),
            'price' => $this->faker->numberBetween(90000, 200000),
            'quantity' => $this->faker->randomNumber(),
            'category_id' => Category::all()->random()->id,
            'description' => $this->faker->realText,
            'content' => $this->faker->text,
        ];
    }
}
