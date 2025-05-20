<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/authors', [\App\Http\Controllers\AuthorController::class, 'index'])->name('authors.index');
Route::get('/genres', [\App\Http\Controllers\GenreController::class, 'index'])->name('genres.index');
Route::get('/books', [\App\Http\Controllers\BookController::class, 'index'])->name('books.index');