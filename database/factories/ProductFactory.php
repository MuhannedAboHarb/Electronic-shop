<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category_id' => Category::inRandomOrder()->limit(1)->get()->first()->id,
            'name'=> $this->faker->productName,
            'description'=> $this->faker->sentences(3,true),
            'image'=> $this->faker->imageUrl(),
            'price'=> $this->faker->randomFloat(0,0,999),
            'compare_price'=> $this->faker->randomFloat(0,999,1999),
            'quantity'=> $this->faker->randomDigitNotNull(),
            'sku'=> $this->faker->unique()->word()
        ];
    }
}
