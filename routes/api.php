<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
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

/* Public routes */
// Auth
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

/* Private routes */
Route::group(['middleware' => ['auth:sanctum']], function() {
    //Auth
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::get('/getUser', [AuthController::class, 'getUser']);

    // Users
    Route::get('/home', [UserController::class, 'index']);
    Route::post('/home', [UserController::class, 'create']);
    Route::put('/home/{id}', [UserController::class, 'update']);
    Route::delete('/home/{id}', [UserController::class, 'destroy']);
    Route::get('/home/search/{userName}', [UserController::class, 'search']);
    Route::post('/darkMode', [UserController::class, 'darkModeToogle']);
});
