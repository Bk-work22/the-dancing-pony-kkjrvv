<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        $faker = \Faker\Factory::create();

        return [
            'name' => $faker->name,
            'email' => $faker->unique()->safeEmail,
            'password' => bcrypt('password'),
            'nickname' => $faker->userName,
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ];
    }
}
