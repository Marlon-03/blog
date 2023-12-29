<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\HomeController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Public routes
Route::post('/register', [RegisterController::class, 'store']);

Route::post('/login', [LoginController::class, 'check']);

Route::post('/logout',[LoginController::class, 'logout']);


// Category Routes
Route::middleware('auth:sanctum')->post('/categories/create', [CategoryController::class, 'store']);

Route::middleware('auth:sanctum')->get('/categories/{id}', [CategoryController::class, 'show']);

Route::middleware('auth:sanctum')->put('/categories/{id}', [CategoryController::class, 'update']);

Route::middleware('auth:sanctum')->delete('/categories/{id}', [CategoryController::class, 'destroy']);

Route::get('categories', [CategoryController::class, 'index']);

// Posts
Route::middleware('auth:sanctum')->post('/posts', [PostController::class, 'store']);
Route::get('posts/{post:slug}', [PostController::class, 'show']);

Route::get('home-posts', [HomeController::class, 'index']);