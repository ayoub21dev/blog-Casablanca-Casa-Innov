<?php

use Illuminate\Support\Facades\Route;
use app\Http\Controllers\ArticleController;

Route::get('articles/create', [ArticleController::class, 'create'])->name('articles.create');
Route::post('articles', [ArticleController::class, 'store'])->name('articles.store');
