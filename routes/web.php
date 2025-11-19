<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('blog')->group(function () {
    Route::get('/', [PostController::class, 'index'])->name('posts.index');
    Route::get('/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/', [PostController::class, 'store'])->name('posts.store');
    Route::get('/{slug}', [PostController::class, 'show'])->name('posts.show');
    Route::get('/{slug}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/{slug}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/{slug}', [PostController::class, 'destroy'])->name('posts.destroy');
});

// ✔ Move these OUTSIDE
Route::get('/student/create', [PostController::class, 'studentForm'])->name('posts.studentForm');
Route::post('/student', [PostController::class, 'student'])->name('posts.student');
Route::get('/students', [PostController::class, 'studentList'])->name('student.list');
Route::get('/student/edit/{id}', [PostController::class, 'studentEdit'])->name('student.edit');
Route::put('/student/update/{id}', [PostController::class, 'studentUpdate'])->name('student.update');
Route::delete('/student/delete/{id}', [PostController::class, 'studentDelete'])->name('student.delete');
Route::get('/student/{id}', [PostController::class, 'studentView'])->name('student.view');
