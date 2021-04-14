<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AuthMiddleware;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('api')->group(function () {
    // All routes accessed by guest
    // Create
    Route::post('/signup', [UserController::class, 'create']);
    // Login
    Route::post('/login', [UserController::class, 'login']);
    // Logout
    Route::get('/logout', [UserController::class, 'logout']);
});
// Need Authorization to access
Route::middleware([AuthMiddleware::class])->prefix('api')->group(function () {
    // Get Books
    Route::get('/books', [BookController::class, 'show']);
    // Get Single
    Route::get('/book/{id}', [BookController::class, 'showSingle']);
    // Create Book
    Route::post('/book', [BookController::class, 'create']);
    // Delete Book
    Route::delete('/book/{id}', [BookController::class, 'destroy']);
});




Route::get('/', function () {
    return view('welcome');
});
Route::get('{any}', function () {
    return view('welcome');
})->where('any', '.*');
