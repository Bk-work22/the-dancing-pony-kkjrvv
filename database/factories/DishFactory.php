<?php

namespace Database\Factories;

use App\Models\Dish;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
class DishFactory extends Factory
{
    protected $model = Dish::class;

    public function definition()
    {
        $faker = \Faker\Factory::create();

        return [
            'name' => $faker->unique()->word,
            'description' => $faker->unique()->sentence,
            'image' => $faker->imageUrl(),
            'price' => $faker->randomFloat(2, 10, 100),
        ];
    }
}
