<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ApiBookController extends Controller
{
    /**
     * Lista todos os livros.
     */
    public function index(): JsonResponse
    {
        $books = Book::with(['author', 'category'])->paginate(10);
        
        return response()->json($books);
    }

    /**
     * Armazena um novo livro recém-criado.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'isbn' => 'required|unique:books',
            'author_id' => 'required|exists:authors,id',
            'category_id' => 'required|exists:categories,id',
            'pages' => 'nullable|integer',
            'published_at' => 'nullable|date',
            'description' => 'nullable|string',
        ]);

        $book = Book::create($validated);

        return response()->json([
            'message' => 'Livro cadastrado com sucesso!',
            'data' => $book
        ], 201); // 201 Created
    }

    /**
     * Exibe um livro específico.
     */
    public function show(Book $book): JsonResponse
    {
        $book->load(['author', 'category']);
        
        return response()->json($book);
    }

    /**
     * Atualiza um livro específico.
     */
    public function update(Request $request, Book $book): JsonResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'isbn' => 'required|unique:books,isbn,' . $book->id,
            'author_id' => 'required|exists:authors,id',
            'category_id' => 'required|exists:categories,id',
            'pages' => 'nullable|integer',
            'published_at' => 'nullable|date',
            'description' => 'nullable|string',
        ]);

        $book->update($validated);

        return response()->json([
            'message' => 'Livro atualizado com sucesso!',
            'data' => $book
        ]);
    }

    /**
     * Remove um livro específico.
     */
    public function destroy(Book $book): JsonResponse
    {
        $book->delete();

        return response()->json([
            'message' => 'Livro excluído com sucesso!'
        ]); 
    }
}