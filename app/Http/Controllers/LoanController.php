<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function index()
    {
        $loans = Loan::with(['user', 'book.author', 'book.category'])
                     ->latest()
                     ->paginate(10);
        return view('loans.index', compact('loans'));
    }

    public function create()
    {
        $users = User::all();
        $books = Book::where('available', true)->get();
        return view('loans.create', compact('users', 'books'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
            'due_date' => 'required|date|after:today',
        ]);

        $book = Book::findOrFail($validated['book_id']);

        if (!$book->available) {
            return redirect()->back()->with('error', 'Este livro não está disponível.');
        }

        $loan = Loan::create([
            'user_id' => $validated['user_id'],
            'book_id' => $validated['book_id'],
            'loan_date' => now(),
            'due_date' => $validated['due_date'],
            'status' => 'active',
        ]);

        $book->update(['available' => false]);

        return redirect()->route('loans.index')
                         ->with('success', 'Empréstimo realizado com sucesso!');
    }

    public function show(Loan $loan)
    {
        $loan->load(['user', 'book.author', 'book.category']);
        return view('loans.show', compact('loan'));
    }

    public function edit(Loan $loan)
    {
        // Geralmente não editamos empréstimo, só devolvemos
        return redirect()->route('loans.index');
    }

    public function update(Request $request, Loan $loan)
    {
        // Usado para devolver o livro
        if ($loan->status !== 'active') {
            return redirect()->back()->with('error', 'Este empréstimo já foi finalizado.');
        }

        $loan->update([
            'return_date' => now(),
            'status' => 'returned',
        ]);

        $loan->book->update(['available' => true]);

        return redirect()->route('loans.index')
                         ->with('success', 'Livro devolvido com sucesso!');
    }

    public function destroy(Loan $loan)
    {
        if ($loan->status === 'active') {
            return redirect()->route('loans.index')
                             ->with('error', 'Não é possível excluir um empréstimo ativo.');
        }

        $loan->delete();
        return redirect()->route('loans.index')
                         ->with('success', 'Empréstimo excluído com sucesso!');
    }

    // Método auxiliar para devolver livro
    public function returnLoan(Loan $loan)
    {
        return $this->update(new Request(), $loan);
    }
}