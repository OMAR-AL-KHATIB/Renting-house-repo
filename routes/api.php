<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {return $request->user();})->middleware('auth:sanctum');
Route::post('/register',[\App\Http\Controllers\UserController::class,'register']);
Route::post('/logIn',[\App\Http\Controllers\UserController::class,'login']);
Route::post('/logOut',[\App\Http\Controllers\UserController::class,'logout'])->middleware('auth:sanctum');
Route::put('/update',[\App\Http\Controllers\UserController::class,'update']);
Route::get('/show',[\App\Http\Controllers\UserController::class,'show']);
Route::get('/showAll',[\App\Http\Controllers\UserController::class,'index']);
Route::get('/userReservations',[\App\Http\Controllers\UserController::class,'getUserReservations'])->middleware('auth:sanctum');



Route::post('/addHouse',[\App\Http\Controllers\AvailableHouseController::class,'store'])->middleware('auth:sanctum');
Route::put('/updateHouse',[\App\Http\Controllers\AvailableHouseController::class,'update'])->middleware('auth:sanctum');
Route::get('/showAllHouse',[\App\Http\Controllers\AvailableHouseController::class,'index']);
Route::get('/showHouse',[\App\Http\Controllers\AvailableHouseController::class,'show'])->middleware('auth:sanctum');
Route::get('/filterHouses',[\App\Http\Controllers\AvailableHouseController::class,'filterHouses']);
Route::get('/showHouseState',[\App\Http\Controllers\AvailableHouseController::class,'getHouseStates']);



Route::post('/changeState',[\App\Http\Controllers\HouseStateController::class,'store'])->middleware('auth:sanctum');
Route::put('/updateState',[\App\Http\Controllers\HouseStateController::class,'update'])->middleware('auth:sanctum');
Route::get('/house/{id}/showHouseStates',[\App\Http\Controllers\HouseStateController::class,'getHouseStates'])->middleware('auth:sanctum');


