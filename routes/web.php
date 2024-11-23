<?php

use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('book',[BookController::class,'index']);
Route::post('book',[BookController::class,'store']);
Route::get('book/{id}',[BookController::class,'edit']);
Route::put('book/{id}',[BookController::class,'update']);
Route::delete('book/{id}',[BookController::class,'destroy']);
