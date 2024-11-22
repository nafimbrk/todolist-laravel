<?php

use App\Http\Controllers\TodoController;
use App\Http\Controllers\TodoPriorityController;
use Illuminate\Support\Facades\Route;



Route::get('/todo', [TodoController::class, 'index'])->name('todo');
Route::get('/todo/tambah', [TodoController::class, 'create'])->name('todo.create');
Route::post('/todo', [TodoController::class, 'store'])->name('todo.post');
Route::get('/todo/{id}/edit', [TodoController::class, 'edit'])->name('todo.edit');
Route::put('/todo/{id}', [TodoController::class, 'update'])->name('todo.update');
Route::delete('/todo/{id}', [TodoController::class, 'destroy'])->name('todo.delete');

Route::get('/todopry', [TodoPriorityController::class, 'index'])->name('todopry');
Route::get('/todopry/tambah', [TodoPriorityController::class, 'create'])->name('todopry.create');
Route::post('/todopry', [TodoPriorityController::class, 'store'])->name('todopry.post');
Route::get('/todopry/{id}/edit', [TodoPriorityController::class, 'edit'])->name('todopry.edit');
Route::put('/todopry/{id}', [TodoPriorityController::class, 'update'])->name('todopry.update');
Route::delete('/todopry/{id}', [TodoPriorityController::class, 'destroy'])->name('todopry.delete');


Route::get('/tasks/category/{id}', [TodoController::class, 'tasksByCategory'])->name('tasks.by.category');
Route::get('/taskspry/category/{id}', [TodoPriorityController::class, 'tasksPryByCategory'])->name('taskspry.by.category');

Route::view('/', 'home');





