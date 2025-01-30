<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SecretariatController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
// Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index')->name('dashboard');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->prefix('user')->group(function () {
    Route::get('/inicio', [UserController::class, 'index'])->name('user.index');
    Route::post('/perfil', [UserController::class, 'store'])->name('user.store');
    Route::get('/mostrar/{id}', [UserController::class, 'show'])->name('usuarios.show');
    Route::patch('/actualizar/{id}', [UserController::class, 'update'])->name('user.update');
    Route::post('/resetear/{id}', [UserController::class, 'resetear'])->name('usuarios.resetear');
    Route::delete('/eliminar/{id}', [UserController::class, 'destroy'])->name('user.destroy');
    Route::get('/{id}', [UserController::class, 'getUser']);
});

Route::middleware('auth')->prefix('secretariat')->group(function () {
    Route::get('/inicio', [SecretariatController::class, 'index'])->name('secretariat.index');
    Route::post('/perfil', [SecretariatController::class, 'store'])->name('secretariat.store');
    Route::get('/mostrar/{id}', [SecretariatController::class, 'show'])->name('secretariat.show');
    Route::patch('/actualizar/{id}', [SecretariatController::class, 'update'])->name('secretariat.update');
    Route::post('/resetear/{id}', [SecretariatController::class, 'resetear'])->name('secretariat.resetear');
    Route::delete('/eliminar/{id}', [SecretariatController::class, 'destroy'])->name('secretariat.destroy');
    Route::get('/{id}', [SecretariatController::class, 'getUser']);
});
require __DIR__.'/auth.php';
