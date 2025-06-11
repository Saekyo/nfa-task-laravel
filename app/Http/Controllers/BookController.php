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

}
