<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::group(['prefix' => 'v1'], function () {
    Route::post('login', [AuthController::class, 'login']);

    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::post('logout', [AuthController::class, 'logout']);

        Route::group(['prefix' => 'book'], function () {
            Route::get('', [BookController::class, 'index']);
            Route::post('', [BookController::class, 'create']);
            Route::get('{book}', [BookController::class, 'detail']);
            Route::delete('/{book}', [BookController::class, 'destroy']);
            Route::post('/user', [BookController::class, 'bookUser']);
        });
    });
});
