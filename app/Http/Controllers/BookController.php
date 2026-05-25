<?php
namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class BookController extends Controller
{
    public function index(): JsonResponse
    {
        $books = Book::with(['author', 'category'])->paginate(15);
        return response()->json($books);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'isbn' => 'required|string|unique:books',
            'author_id' => 'required|exists:authors,id',
            'category_id' => 'required|exists:categories,id',
            'pages' => 'nullable|integer',
            'published_at' => 'nullable|date',
            'description' => 'nullable|string',
        ]);

        $book = Book::create($validated);
        $book->load(['author', 'category']);

        return response()->json($book, 201);
    }

    public function show(Book $book): JsonResponse
    {
        $book->load(['author', 'category']);
        return response()->json($book);
    }

    public function update(Request $request, Book $book): JsonResponse
    {
        $validated = $request->validate([
            'title' => 'string|max:255',
            'isbn' => 'string|unique:books,isbn,' . $book->id,
            'author_id' => 'exists:authors,id',
            'category_id' => 'exists:categories,id',
            'available' => 'boolean',
        ]);

        $book->update($validated);
        return response()->json($book);
    }

    public function destroy(Book $book): JsonResponse
    {
        $book->delete();
        return response()->json(null, 204);
    }
}