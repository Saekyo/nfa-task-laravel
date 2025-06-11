<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function index()
    {
        try {
            $books = Book::with(['author', 'genre'])->get();
            return $this->sendResponse('Books fetched successfully', 200, $books);
        } catch (\Exception $e) {
            return $this->sendError('Failed to fetch books', 500, ['error' => $e->getMessage()]);
        }
    }

    public function create(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'author_id' => 'required|exists:authors,id',
                'genre_id' => 'required|exists:genres,id',
                'published_year' => 'required|integer|min:1900|max:' . date('Y'),
                'description' => 'nullable|string',
                'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);

            // Handle file upload for cover_image if provided
            if ($request->hasFile('cover_image')) {
                $file = $request->file('cover_image');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/covers'), $filename);
                $request->merge(['cover_image' => 'uploads/covers/' . $filename]);
            } else {
                $request->merge(['cover_image' => null]);
            }

            $book = Book::create($request->all());
            return $this->sendResponse('Book created successfully', 201, data: null);
        } catch (\Exception $e) {
            return $this->sendError('Failed to create book', 500, ['error' => $e->getMessage()]);
        }
    }

}
