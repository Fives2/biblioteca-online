<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = Author::withCount('books')
                         ->latest()
                         ->paginate(10);
        
        return view('authors.index', compact('authors'));
    }

    public function create()
    {
        return view('authors.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'nationality' => 'nullable|string|max:100',
            'birth_date' => 'nullable|date',
        ]);

        Author::create($validated);

        return redirect()->route('authors.index')
                         ->with('success', 'Autor cadastrado com sucesso!');
    }

    public function show(Author $author)
    {
        $author->load('books');
        return view('authors.show', compact('author'));
    }

    public function edit(Author $author)
    {
        return view('authors.edit', compact('author'));
    }

    public function update(Request $request, Author $author)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'nationality' => 'nullable|string|max:100',
            'birth_date' => 'nullable|date',
        ]);

        $author->update($validated);

        return redirect()->route('authors.index')
                         ->with('success', 'Autor atualizado com sucesso!');
    }

    public function destroy(Author $author)
    {
        // Proteção: não permite excluir autor com livros
        if ($author->books()->count() > 0) {
            return redirect()->route('authors.index')
                             ->with('error', 'Não é possível excluir um autor que possui livros cadastrados.');
        }

        $author->delete();

        return redirect()->route('authors.index')
                         ->with('success', 'Autor excluído com sucesso!');
    }
}