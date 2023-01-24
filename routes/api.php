<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\FollowersController;
use App\Http\Controllers\LikeController;
use App\Helpers\ApiResponse;


// registrasi
Route::post('signin', [UserController::class, 'signin']);
Route::post('signup', [UserController::class, 'signup']);

// users
Route::get('users/', [UserController::class, 'index']);
Route::get('users/{id}', [UserController::class, 'show']);
Route::patch('users/{id}', [UserController::class, 'update']);
Route::delete('users/{id}', [UserController::class, 'destroy']);

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

//followers
Route::post('followers/', [FollowersController::class, 'store']);
Route::get('followers/', [FollowersController::class, 'index']);
Route::get('followers/{id}', [FollowersController::class, 'show']);
Route::patch('followers/{id}', [FollowersController::class, 'update']);
Route::delete('followers/{id}', [FollowersController::class, 'destroy']);

//like
Route::post('likes/', [LikeController::class, 'store']);
Route::get('likes/', [LikeController::class, 'index']);
Route::get('likes/{id}', [LikeController::class, 'show']);
Route::patch('likes/{id}', [LikeController::class, 'update']);
Route::delete('likes/{id}', [LikeController::class, 'destroy']);

















// asd
