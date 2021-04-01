<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\UserController;

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
Route::resource('authors', AuthorController::class);

Route::resource('books', BookController::class);

Route::resource('genres', GenreController::class);

Route::post('register', [UserController::class, 'register']);

Route::post('login', [UserController::class, 'login']);

Route::fallback(function(){
    return response()->json(['message' => 'Page Not Found'], 404);
});
     
Route::middleware('auth:api')->group( function () {
    Route::resource('users', UserController::class);
});