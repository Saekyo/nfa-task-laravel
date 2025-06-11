<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/authors', [\App\Http\Controllers\AuthorController::class, 'index'])->name('authors.index');
Route::get('/genres', [\App\Http\Controllers\GenreController::class, 'index'])->name('genres.index');
Route::get('/books', [\App\Http\Controllers\BookController::class, 'index'])->name('books.index');
