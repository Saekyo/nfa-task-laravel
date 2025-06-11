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
}
