<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genre;

class GenreController extends Controller
{
    public function index()
    {
        try {
            $genres = Genre::with(['books'])->get();
            return $this->sendResponse('Genres fetched successfully', 200, $genres);
        } catch (\Exception $e) {
            return $this->sendError('Failed to fetch genres', 500, ['error' => $e->getMessage()]);
        }
    }

    public function create(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
            ]);
            $genre = Genre::create($request->all());
            return $this->sendResponse('Genre created successfully', 201, data: null);
        } catch (\Exception $e) {
            return $this->sendError('Failed to create genre', 500, ['error' => $e->getMessage()]);
        }
    }
}
