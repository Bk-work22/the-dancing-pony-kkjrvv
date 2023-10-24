<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\RateDishRequest;
use App\Http\Controllers\Controller;
use App\Models\Rating;
use App\Models\Dish;

class RatingController extends Controller
{
    public function store(RateDishRequest $request, $id)
    {
        $validatedData = $request->validated();

        if($request->user()->nickname == '_Sméagol_' || $request->user()->nickname == 'Sméagol'){
            return response()->json(['message' => 'Sméagol is not allowed to rate any dish'], 409);
        }
    
        $dish = Dish::find($id);

        if (!$dish) {
            return response()->json(['message' => 'Dish not found'], 404);
        }
    
        $ratingData = [
            'rating' => $validatedData['rating'],
            'dish_id' => $dish->id,
            'user_id' => $request->user()->id
        ];
    
        $rating = Rating::where('dish_id', $dish->id)
            ->where('user_id', $request->user()->id)
            ->first();
    
        if ($rating) {
            return response()->json(['message' => 'Rating already exists'], 409);
        }
    
        Rating::create($ratingData);
    
        return response()->json(['message' => 'Rating created successfully'], 201);
    }
}