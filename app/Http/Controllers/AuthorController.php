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
}
