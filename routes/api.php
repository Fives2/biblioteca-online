<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BookController;

Route::name('api.')->group(function () {
    Route::apiResource('books', BookController::class);
});