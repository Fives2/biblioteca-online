<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class LoanController extends Controller
{
    public function index(): JsonResponse
    {
        $loans = Loan::with(['user', 'book.author', 'book.category'])
                     ->latest()
                     ->paginate(15);
        return response()->json($loans);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
            'due_date' => 'required|date|after:today',
        ]);

        $book = Book::findOrFail($validated['book_id']);

        if (!$book->available) {
            return response()->json([
                'message' => 'Este livro não está disponível para empréstimo.'
            ], 422);
        }

        $loan = Loan::create([
            'user_id' => $validated['user_id'],
            'book_id' => $validated['book_id'],
            'loan_date' => now(),
            'due_date' => $validated['due_date'],
            'status' => 'active',
        ]);

        // Marca o livro como indisponível
        $book->update(['available' => false]);

        $loan->load(['user', 'book']);

        return response()->json($loan, 201);
    }

    public function show(Loan $loan): JsonResponse
    {
        $loan->load(['user', 'book.author', 'book.category']);
        return response()->json($loan);
    }

    public function update(Request $request, Loan $loan): JsonResponse
    {
        // Normalmente só permite retornar o livro
        if ($loan->status === 'returned') {
            return response()->json(['message' => 'Este empréstimo já foi finalizado.'], 422);
        }

        $validated = $request->validate([
            'return_date' => 'required|date',
            'status' => 'in:returned',
        ]);

        $loan->update([
            'return_date' => $validated['return_date'],
            'status' => 'returned',
        ]);

        // Libera o livro
        $loan->book->update(['available' => true]);

        return response()->json($loan);
    }

    public function destroy(Loan $loan): JsonResponse
    {
        // Só permite deletar se não estiver ativo
        if ($loan->status === 'active') {
            return response()->json(['message' => 'Não é possível excluir empréstimo ativo.'], 422);
        }

        $loan->delete();
        return response()->json(null, 204);
    }

    // ==================== MÉTODOS EXTRAS ====================

    /**
     * Empréstimos do usuário logado
     */
    public function myLoans(): JsonResponse
    {
        $loans = Loan::where('user_id', Auth::id())
                     ->with(['book.author', 'book.category'])
                     ->latest()
                     ->get();

        return response()->json($loans);
    }

    /**
     * Realizar empréstimo do livro (usuário logado)
     */
    public function loanBook(Request $request, Book $book): JsonResponse
    {
        if (!$book->available) {
            return response()->json([
                'message' => 'Livro não disponível no momento.'
            ], 422);
        }

        $loan = Loan::create([
            'user_id' => Auth::id(),
            'book_id' => $book->id,
            'loan_date' => now(),
            'due_date' => Carbon::now()->addDays(15),
            'status' => 'active',
        ]);

        $book->update(['available' => false]);

        $loan->load(['book']);

        return response()->json($loan, 201);
    }
}