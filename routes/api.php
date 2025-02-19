<?php

use App\Http\Controllers\API\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;

Route::post('signup',[AuthController::class,'signup'])->middleware('web');
Route::post('login',[AuthController::class,'login'])->middleware('web');

Route::middleware('auth:sanctum')->group(function(){
    Route::post('logout',[AuthController::class,'logout'])->middleware('web');
    Route::apiResource('posts',PostController::class);
});
