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

    public function show($id)
    {
        try {
            $genre = Genre::with(['books'])->find($id);
            if (!$genre) {
                return $this->sendError('Genre not found', 404);
            }
            return $this->sendResponse('Genre fetched successfully', 200, $genre);
        } catch (\Exception $e) {
            return $this->sendError('Failed to fetch genre', 500, ['error' => $e->getMessage()]);
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

    public function update(Request $request, $id)
    {
        try {
            $genre = Genre::find($id);
            if (!$genre) {
                return $this->sendError('Genre not found', 404);
            }
            $request->validate([
                'name' => 'required|string|max:255',
            ]);
            $genre->update($request->all());
            return $this->sendResponse('Genre updated successfully', 200, data: null);
        } catch (\Exception $e) {
            return $this->sendError('Failed to update genre', 500, ['error' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            $genre = Genre::find($id);
            if (!$genre) {
                return $this->sendError('Genre not found', 404);
            }
            $genre->delete();
            return $this->sendResponse('Genre deleted successfully', 200, data: null);
        } catch (\Exception $e) {
            return $this->sendError('Failed to delete genre', 500, ['error' => $e->getMessage()]);
        }
    }
}
