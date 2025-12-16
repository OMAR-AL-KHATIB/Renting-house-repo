<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::post('/register',[\App\Http\Controllers\UserController::class,'register']);
Route::post('/login',[\App\Http\Controllers\UserController::class,'login']);
Route::put('/update',[\App\Http\Controllers\UserController::class,'update']);
Route::get('/show',[\App\Http\Controllers\UserController::class,'show'])->middleware('auth:sanctum');

Route::apiResource('house',\App\Http\Controllers\AvailableHouseController::class)->middleware('auth:sanctum');

