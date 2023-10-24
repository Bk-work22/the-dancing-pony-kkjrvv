<?php

namespace Tests\Unit;

use App\Models\Dish;
use Tests\TestCase;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;

class RatingTest extends TestCase
{
    public function testRatingEndpoint()
    {
        
        // Create a dish
        $user = User::factory()->create();

        // Generate a JWT token for the user
        $token = JWTAuth::fromUser($user);

        // Create a dish
        $dish = Dish::factory()->create();

        // Send a POST request to the rating endpoint with the token in the Authorization header
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->post("/api/dishes/{$dish->id}/ratings", [
            'rating' => 3,
        ]);

        // Assert that the response has a successful status code
        $response->assertStatus(201, 'Failed to assert that the response has a successful status code');

        // Assert that the response JSON contains the expected message
        $response->assertExactJson([
            'message' => 'Rating created successfully',
        ], 'Failed to assert that the response JSON contains the expected message');

        // Assert that the dish model has been updated with the rating
        $this->assertEquals(3, $dish->ratings()->where('user_id', $user->id)->first()->rating, 'Failed to assert that the dish model has been updated with the rating');
    }
}