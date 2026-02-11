<?php

use App\Http\Controllers\Web\NewsPageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\AuthPageController;

Route::get('/', function () {
    return redirect()->route('web.news.index');
});

Route::get('/login', [AuthPageController::class, 'showLogin'])->name('login.form');
Route::post('/login', [AuthPageController::class, 'login'])->name('login');
Route::post('/logout', [AuthPageController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/news', [NewsPageController::class, 'index'])->name('web.news.index');
    Route::get('/news/create', [NewsPageController::class, 'create'])->name('web.news.create');
    Route::post('/news', [NewsPageController::class, 'store'])->name('web.news.store');
    Route::get('/news/{news}', [NewsPageController::class, 'show'])->name('web.news.show');
    Route::get('/news/{news}/edit', [NewsPageController::class, 'edit'])->name('web.news.edit');
    Route::put('/news/{news}', [NewsPageController::class, 'update'])->name('web.news.update');
    Route::delete('/news/{news}', [NewsPageController::class, 'destroy'])->name('web.news.destroy');
});
