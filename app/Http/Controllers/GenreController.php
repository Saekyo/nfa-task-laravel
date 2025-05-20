<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genre;

class GenreController extends Controller
{
    public function index()
    {
        $genres = Genre::getGenres();

        return view('genres.index', compact('genres'));
    }
}
