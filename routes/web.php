<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoanController;

// ====================== ROTAS WEB (INTERFACE) ======================

Route::get('/', function () {
    return view('app');
})->name('app');

// Livros
Route::resource('books', BookController::class);

// Autores
Route::resource('authors', AuthorController::class);

// Categorias
Route::resource('categories', CategoryController::class);

// Empréstimos
Route::resource('loans', LoanController::class);

// Rotas extras para Empréstimos
Route::post('books/{book}/loan', [LoanController::class, 'loanBook'])->name('books.loan');
Route::post('loans/{loan}/return', [LoanController::class, 'returnLoan'])->name('loans.return');