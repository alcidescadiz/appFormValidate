<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        return [
			'code' => $this->faker->name,
			'name' => $this->faker->name,
			'description' => $this->faker->name,
			'brand' => $this->faker->name,
			'price' => $this->faker->name,
			'category' => $this->faker->name,
        ];
    }
}
