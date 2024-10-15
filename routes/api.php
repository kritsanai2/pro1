<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GamesController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Routes for Game resource (public access)
Route::get('/games', [GamesController::class, 'index']); // Get all games
Route::post('/games', [GamesController::class, 'store']); // Create a new game
Route::get('/games/{id}', [GamesController::class, 'show']); // Get a specific game by ID
Route::put('/games/{id}', [GamesController::class, 'update']); // Update a specific game by ID
Route::delete('/games/{id}', [GamesController::class, 'destroy']); // Delete a specific game by ID

// Route for login
Route::post('login', [AuthController::class, 'login']);

// Protected routes that require authentication
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    }); // Route for getting the authenticated user
    Route::resource('games', GamesController::class)->except(['index', 'store', 'show']); // Only use resource methods that require authentication
    Route::post('logout', [AuthController::class, 'logout']); // Logout route
});
