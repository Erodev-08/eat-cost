<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecetaController;
use App\Http\Controllers\CalculoRecetaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::view('/terminos', 'terms')->name('terms.show');
Route::view('/privacidad', 'privacy')->name('privacy.show');
Route::view('/contacto', 'contact')->name('contact');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::delete('/profile/image', [ProfileController::class, 'deleteProfileImage'])->name('profile.image.destroy');
    Route::get('/profile/user', [ProfileController::class, 'user'])->name('profile.user');
    Route::patch('/profile/cover', [ProfileController::class, 'updateCover'])->name('profile.cover.update');
    Route::delete('/profile/cover', [ProfileController::class, 'deleteCover'])->name('profile.cover.destroy');
    Route::get('/profile/configuracion', [ProfileController::class, 'config'])->name('profile.configuracion');
});

Route::get('/receta/create', [RecetaController::class, 'create'])->name('recetas.create');

Route::get('/receta/{receta}/edit', [RecetaController::class, 'edit'])->name('recetas.edit');
Route::get('/receta/{receta}', [RecetaController::class, 'show'])->name('recetas.show');
Route::post('/receta/store', [RecetaController::class, 'store'])->name('recetas.store');
Route::put('/receta/{receta}', [RecetaController::class, 'update'])->name('recetas.update');
Route::delete('/receta/{receta}', [RecetaController::class, 'destroy'])->name('recetas.destroy');
Route::get('/receta', [RecetaController::class, 'index'])->name('recetas');
Route::get('/recetas/{receta}/calcular', [CalculoRecetaController::class, 'create'])
    ->name('recetas.calcular');

Route::post('/recetas/{receta}/calcular', [CalculoRecetaController::class, 'store'])
    ->name('recetas.calcular.store');

Route::get('/mis-recetas-elaboradas', [CalculoRecetaController::class, 'index'])
    ->name('recetas.elaboradas.index');

Route::get('/mis-recetas-elaboradas/{recetaElaborada}', [CalculoRecetaController::class, 'show'])
    ->name('recetas.elaboradas.show');

Route::get('/mis-recetas-elaboradas', [CalculoRecetaController::class, 'index'])
    ->name('recetas.elaboradas.index');
require __DIR__.'/auth.php';
