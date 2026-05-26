<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\Api\ApiBookController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoanController;

// Página inicial
Route::get('/', function () {
    return view('app');
})->name('app');

// CRUD WEB
Route::resource('books', BookController::class);
Route::resource('authors', AuthorController::class);
Route::resource('categories', CategoryController::class);
Route::resource('loans', LoanController::class);


Route::get('/json/books', [ApiBookController::class, 'index']);