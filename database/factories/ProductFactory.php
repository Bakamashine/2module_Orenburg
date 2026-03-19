<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->title,
            'description' => $this->faker->text,
            'price' => 5,
            'image' => $this->faker->image,
            'category_id' => 1

        ];
    }
}
