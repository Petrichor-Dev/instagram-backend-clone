<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostsController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


// registrasi
Route::post('signin', [UserController::class, 'signin']);
Route::post('signup', [UserController::class, 'signup']);

// users
Route::post('users/', [UserController::class, 'get']);
Route::post('users/{id}', [UserController::class, 'get']);
Route::patch('users/{id}', [UserController::class, 'update']);
Route::delete('users/{id}', [UserController::class, 'delete']);

//comments
Route::post('comments/', [CommentController::class, 'store']);
Route::get('comments/', [CommentController::class, 'index']);
Route::get('comments/{id}', [CommentController::class, 'show']);
Route::patch('comments/{id}', [CommentController::class, 'update']);
Route::delete('comments/{id}', [CommentController::class, 'destroy']);

//posts
Route::post('posts/', [PostsController::class, 'store']);
Route::get('posts/', [PostsController::class, 'index']);
Route::get('posts/{id}', [PostsController::class, 'show']);
Route::patch('posts/{id}', [PostsController::class, 'update']);
Route::delete('posts/{id}', [PostsController::class, 'destroy']);




















// asd
