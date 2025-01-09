<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\DashboardController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');
Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');

Route::resource('projects', ProjectController::class);
Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
Route::get('projects/{project}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
Route::put('projects/{project}', [ProjectController::class, 'update'])->name('projects.update');
Route::delete('projects/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');
Route::get('/projects/export', [ProjectController::class, 'export'])->name('projects.export');

Route::get('/projects/{project_id}/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
Route::post('/projects/{project}/tasks', [TaskController::class, 'store'])->name('tasks.store');
Route::get('/tasks/{project_id}', [TaskController::class, 'show'])->name('tasks.show');
Route::get('/projects/{project_id}/tasks', [TaskController::class, 'show'])->name('projects.tasks');

Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');
Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
Route::patch('tasks/{task}/update-status', [TaskController::class, 'updateStatus'])->name('tasks.updateStatus');
Route::delete('tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');


Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::resource('projects', ProjectController::class);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
