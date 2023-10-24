<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Dish;
use App\Models\Rating;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
class RatingFactory extends Factory
{
    protected $model = Rating::class;

    public function definition()
    {
        $faker = \Faker\Factory::create();

        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'dish_id' => Dish::inRandomOrder()->first()->id,
            'rating' => $faker->numberBetween(1, 5),
        ];
    }
}