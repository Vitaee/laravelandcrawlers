<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BlogController;
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

Route::prefix('v1')->namespace('Api')->group( function(){

    Route::prefix('user')->name('user.')->group( function () {
        Route::post('/login', [AuthController::class, 'signin'])->name('signin');
        Route::post('/register', [AuthController::class, 'signup'])->name('signup');


        Route::middleware('auth:sanctum')->group( function () {
            Route::get('/', function (Request $request){
                return $request->user();
            });
        });

    });
    
});

Route::middleware('auth:sanctum')->group( function () {
    Route::resource('/blogs',BlogController::class);
});