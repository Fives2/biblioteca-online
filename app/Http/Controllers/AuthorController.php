<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class AuthorController extends Controller
{
    public function index(): JsonResponse
    {
        $authors = Author::with('books')->paginate(15);
        return response()->json($authors);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'nationality' => 'nullable|string',
            'birth_date' => 'nullable|date',
        ]);

        $author = Author::create($validated);
        return response()->json($author, 201);
    }

    public function show(Author $author): JsonResponse
    {
        $author->load('books');
        return response()->json($author);
    }

    public function update(Request $request, Author $author): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'string|max:255',
            'bio' => 'nullable|string',
            'nationality' => 'nullable|string',
            'birth_date' => 'nullable|date',
        ]);

        $author->update($validated);
        return response()->json($author);
    }

    public function destroy(Author $author): JsonResponse
    {
        $author->delete();
        return response()->json(null, 204);
    }
}