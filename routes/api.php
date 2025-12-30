<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::post('/register',[\App\Http\Controllers\UserController::class,'register']);
Route::post('/login',[\App\Http\Controllers\UserController::class,'login']);
Route::post('/logout',[\App\Http\Controllers\UserController::class,'logout'])->middleware('auth:sanctum');
Route::put('/update',[\App\Http\Controllers\UserController::class,'update']);
Route::get('/show',[\App\Http\Controllers\UserController::class,'show']);
Route::get('/showAll',[\App\Http\Controllers\UserController::class,'index']);


Route::post('/addhouse',[\App\Http\Controllers\AvailableHouseController::class,'store'])->middleware('auth:sanctum');
Route::put('/updatehouse',[\App\Http\Controllers\AvailableHouseController::class,'update'])->middleware('auth:sanctum');
Route::get('/showAllhouse',[\App\Http\Controllers\AvailableHouseController::class,'index']);
Route::get('/showhouse',[\App\Http\Controllers\AvailableHouseController::class,'show'])->middleware('auth:sanctum');
Route::get('/filterhouses',[\App\Http\Controllers\AvailableHouseController::class,'filterHouses']);

