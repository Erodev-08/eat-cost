<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecetaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::view('/terminos', 'terms')->name('terms.show');
Route::view('/privacidad', 'privacy')->name('privacy.show');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/receta/create', function() {
    return view('recetas.create');
})->name('recetas.create');

Route::get('/receta/{receta}', [RecetaController::class, 'show'])->name('recetas.show');
Route::post('receta/store', [RecetaController::class, 'store'])->name('recetas.store');
Route::get('/receta', [RecetaController::class, 'index'])->name('recetas');

require __DIR__.'/auth.php';
