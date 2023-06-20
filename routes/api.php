<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;

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

// Registration Route
Route::post('/register', [RegisterController::class, 'register']);

// Login Route
Route::post('/login', [LoginController::class, 'login']);

Route::post('/create-example-users', [RegisterController::class, 'createExampleUsers']);


// Protected Routes (requires authentication)
Route::middleware('auth:sanctum')->group(function () {
    // User Endpoint
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});
