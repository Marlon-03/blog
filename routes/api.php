<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RelatedPostController;
use App\Http\Controllers\DashboardPostController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ContactController;
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

Route::get('/dashboard/admin', [DashboardController::class, 'admin'])->name('dashboard.admin');

Route::get('/dashboard/contributor', [DashboardController::class, 'contributor'])->name('dashboard.contributor');


// Category Routes
Route::middleware('auth:sanctum')->post('/categories/create', [CategoryController::class, 'store']);

Route::middleware('auth:sanctum')->get('/categories/{id}', [CategoryController::class, 'show']);

Route::middleware('auth:sanctum')->put('/categories/{id}', [CategoryController::class, 'update']);

Route::middleware('auth:sanctum')->delete('/categories/{id}', [CategoryController::class, 'destroy']);

Route::get('categories', [CategoryController::class, 'index']);

// Posts
Route::middleware('auth:sanctum')->post('/posts', [PostController::class, 'store']);

Route::middleware('auth:sanctum')->put('/posts/{post:slug}', [PostController::class, 'update']);

Route::middleware('auth:sanctum')->delete('/posts/{post:slug}', [PostController::class, 'destroy']);

Route::get('posts', [PostController::class, 'index']);

//post count
Route::get('posts/count', [PostController::class, 'count']);

Route::get('posts/totalCount', [PostController::class, 'totalCount']);

Route::get('posts/{post:slug}', [PostController::class, 'show']);

Route::get('related-posts/{post:slug}', [RelatedPostController::class, 'index']);

Route::get('home-posts', [HomeController::class, 'index']);

Route::get('dashboard-posts', [DashboardPostController::class, 'index']);

// admin approval post
Route::get('admin/posts', [PostController::class, 'adminPosts']);

Route::put('admin/posts/{id}/status', [PostController::class, 'updateStatus']);

// contact route
Route::post('/contact', [ContactController::class, 'sendEmail']);







