<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiDocController;
use App\Http\Controllers\BookController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('api/test', [ApiDocController::class, 'test']);
Route::get('api/books', [BookController::class, 'index']);
Route::get('/books/{id}', [BookController::class, 'show']);