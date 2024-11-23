<?php

use App\Http\Controllers\Api\BookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Route::get('book',[BookController::class,'index']); 
// Route::get('book/{id}',[BookController::class,'show']);
// Route::post('book',[BookController::class,'store']);
// Route::put('book/{id}',[BookController::class,'update']);
// Route::delete('book/{id}',[BookController::class,'destroy']);

Route::apiResource('book',BookController::class)->middleware('checkHost');