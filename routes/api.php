<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DishController;
use App\Http\Controllers\Api\RatingController;
use App\Http\Controllers\UsersController;
use Tymon\JWTAuth\Facades\JWTAuth;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/login', [UsersController::class, 'login']);
Route::get('/dishes', [DishController::class, 'index']);
Route::get('/dishes/{id}', [DishController::class, 'show']);
Route::post('/dishes', [DishController::class, 'store'])->middleware('jwt.auth');
Route::put('/dishes/{id}', [DishController::class, 'update'])->middleware('jwt.auth');
Route::delete('/dishes/{id}', [DishController::class, 'destroy'])->middleware('jwt.auth');
Route::post('/dishes/{id}/ratings', [RatingController::class, 'store'])->middleware('jwt.auth');