<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('books')->paginate(10);
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:categories',
            'description' => 'nullable|string',
        ]);

        Category::create($validated);

        return redirect()->route('categories.index')
                         ->with('success', 'Categoria cadastrada com sucesso!');
    }

    public function show(Category $category)
    {
        $category->load('books.author');
        return view('categories.show', compact('category'));
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:categories,name,' . $category->id,
            'description' => 'nullable|string',
        ]);

        $category->update($validated);

        return redirect()->route('categories.index')
                         ->with('success', 'Categoria atualizada com sucesso!');
    }

    public function destroy(Category $category)
    {
        if ($category->books()->count() > 0) {
            return redirect()->route('categories.index')
                             ->with('error', 'Não é possível excluir categoria que possui livros cadastrados.');
        }

        $category->delete();
        return redirect()->route('categories.index')
                         ->with('success', 'Categoria excluída com sucesso!');
    }
}