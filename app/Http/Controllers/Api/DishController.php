<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\Dish;
use Illuminate\Http\Request;
use App\Http\Requests\CreateDishRequest;
use App\Http\Requests\RateDishRequest;
use App\Http\Requests\UpdateDishRequest;

class DishController extends Controller
{
    public function show($id)
    {
        $dish = Dish::find($id);

        if (!$dish) {
            return response()->json(['message' => 'Dish not found'], 404);
        }else{
            return response()->json($dish);
        }
    }

    public function index(Request $request)
    {
        $limit = $request->input('limit', 10);
        $offset = $request->input('offset', 0);
        $keyword = $request->input('keyword');

        $query = Dish::query();

        if ($keyword) {
            $query->where('name', 'like', "%$keyword%")
                ->orWhere('description', 'like', "%$keyword%");
        }

        $count = $query->count();

        $dishes = $query->offset($offset)
            ->limit($limit)
            ->get();

        return response()->json([
            'total' => $count,
            'limit' => $limit,
            'offset' => $offset,
            'data' => $dishes,
        ]);
    }

    public function store(CreateDishRequest $request)
    {
        $validatedData = $request->validated();

        $dish = Dish::create($validatedData);

        return response()->json($dish, 201);
    }

    public function update(UpdateDishRequest $request, $id)
    {

        if (!$request->user()) {
            return response()->json(['error' => 'Unauthorized.'], 401);
        }
        
        $validatedData = $request->validated();

        $dish = Dish::find($id);

        if (!$dish) {
            return response()->json(['message' => 'Dish not found'], 404);
        }

        $dish->update($validatedData);

        return response()->json($dish);
    }

    public function destroy($id)
    {
        $dish = Dish::find($id);

        if (!$dish) {
            return response()->json(['message' => 'Dish not found'], 404);
        }

        $dish->delete();

        return response()->json(['message' => 'Dish deleted successfully']);
    }

    public function rate(RateDishRequest $request, $id)
    {

        $validatedData = $request->validated();

        $dish = Dish::find($id);

        if (!$dish) {
            return response()->json(['message' => 'Dish not found'], 404);
        }

        $dish->rating = $validatedData['rating'];
        $dish->save();

        return response()->json($dish);
    }
}