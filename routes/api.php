<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\AuthController;

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

Route::group(['prefix' => 'auth'], function() {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::get('me', [AuthController::class, 'me']);
});


Route::any('login', [AuthController::class, 'login'])->name('login');

Route::group([
    'middleware' => 'api'
], function ($router) {
    
    // Rute-rute yang dilindungi oleh token di sini
    //Route::resource('movies', MovieController::class);
    Route::post('/movies', [MovieController::class, 'store']);
    Route::post('/movies/{movie}', [MovieController::class, 'update']);
    Route::put('/movies/{movie}', [MovieController::class, 'update']);
    Route::patch('/movies/{movie}', [MovieController::class, 'update']);
    Route::delete('/movies/{movie}', [MovieController::class, 'destroy']);
});


Route::get('/movies', [MovieController::class, 'index']);
Route::get('/movies/{movie}', [MovieController::class, 'show']);

