<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;

class AuthorController extends Controller
{
    public function index()
    {
        try {
            $authors = Author::with(['books'])->get();
            return $this->sendResponse('Authors fetched successfully', 200, $authors);
        } catch (\Exception $e) {
            return $this->sendError('Failed to fetch authors', 500, ['error' => $e->getMessage()]);
        }
    }

    public function show($id)
    {
        try {
            $author = Author::with(['books'])->find($id);
            if (!$author) {
                return $this->sendError('Author not found', 404);
            }
            return $this->sendResponse('Author fetched successfully', 200, $author);
        } catch (\Exception $e) {
            return $this->sendError('Failed to fetch author', 500, ['error' => $e->getMessage()]);
        }
    }

    public function create(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',            ]);
            $author = Author::create($request->all());
            return $this->sendResponse('Author created successfully', 201, data: null);
        } catch (\Exception $e) {
            return $this->sendError('Failed to create author', 500, ['error' => $e->getMessage()]);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $author = Author::find($id);
            if (!$author) {
                return $this->sendError('Author not found', 404);
            }
            $request->validate([
                'name' => 'required|string|max:255',
            ]);
            $author->update($request->all());
            return $this->sendResponse('Author updated successfully', 200, data: null);
        } catch (\Exception $e) {
            return $this->sendError('Failed to update author', 500, ['error' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            $author = Author::find($id);
            if (!$author) {
                return $this->sendError('Author not found', 404);
            }
            $author->delete();
            return $this->sendResponse('Author deleted successfully', 200, data: null);
        } catch (\Exception $e) {
            return $this->sendError('Failed to delete author', 500, ['error' => $e->getMessage()]);
        }
    }
}
