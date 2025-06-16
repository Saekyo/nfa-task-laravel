<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\BookController;



Route::post('/register', [App\Http\Controllers\AuthController::class, 'register']);
Route::post('/login', [App\Http\Controllers\AuthController::class, 'login']);

Route::get('/books', [BookController::class, 'index']);
Route::get('/books/{id}', [BookController::class, 'show']);

Route::get('/authors', [AuthorController::class, 'index']);
Route::get('/authors/{id}', [AuthorController::class, 'show']);

Route::get('/genres', [GenreController::class, 'index']);
Route::get('/genres/{id}', [GenreController::class, 'show']);

Route::middleware(['auth:sanctum', 'admin'])->group(function () {
    Route::post('/books', [BookController::class, 'store']);
    Route::put('/books/{id}', [BookController::class, 'update']);
    Route::delete('/books/{id}', [BookController::class, 'destroy']);
    Route::post('/authors', [AuthorController::class, 'store']);
    Route::put('/authors/{id}', [AuthorController::class, 'update']);
    Route::delete('/authors/{id}', [AuthorController::class, 'destroy']);
    Route::post('/genres', [GenreController::class, 'store']);
    Route::put('/genres/{id}', [GenreController::class, 'update']);
    Route::delete('/genres/{id}', [GenreController::class, 'destroy']);
    Route::get('/transactions', [App\Http\Controllers\TransactionController::class, 'index']);
    Route::delete('/transactions/{id}', [App\Http\Controllers\TransactionController::class, 'destroy']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/transactions', [App\Http\Controllers\TransactionController::class, 'store']);
    Route::get('/transactions/{id}', [App\Http\Controllers\TransactionController::class, 'show']);
    Route::put('/transactions/{id}', [App\Http\Controllers\TransactionController::class, 'update']);
});