<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        return [
            'img_path' => $this->faker->imageUrl,
            'name' => $this->faker->name,
            'description' => $this->faker->text,
            'short_description' => $this->faker->text,
            'amount' => $this->faker->randomNumber,
            'price' => $this->faker->randomFloat(2, 1, 100),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
