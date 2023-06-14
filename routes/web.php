<?php

use App\Http\Controllers\API\TaskController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', static function () {
    return Inertia::render('Welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/', [TaskController::class, 'index'])->name('tasks.index');

    Route::prefix('task')->group(function () {
        Route::get('/', [TaskController::class, 'create'])->name('task.create');
        Route::post('/', [TaskController::class, 'store'])->name('task.store');
        Route::get('/{id}', [TaskController::class, 'edit'])->name('task.edit');
        Route::put('/{id}', [TaskController::class, 'update'])->name('task.update');
        Route::get('/{id}/show', [TaskController::class, 'show'])->name('task.show');
        Route::delete('/{id}', [TaskController::class, 'destroy'])->name('task.delete');
    });
});

require __DIR__.'/auth.php';
