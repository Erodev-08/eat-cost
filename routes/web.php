<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecetaController;
use App\Http\Controllers\CalculoRecetaController;
use App\Http\Controllers\GoogleAuthController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Receta;
use App\Models\RecetaCalc;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::view('/terminos', 'terms')->name('terms.show');
Route::view('/privacidad', 'privacy')->name('privacy.show');

Route::get('/dashboard', function () {
    $user = Auth::user();
    //$recentRecetas = Receta::paginate(5);
    $recentRecetas = Receta::where('id_usuario', $user->id_usuario)->paginate(5);
    $recetasCount = Receta::where('id_usuario', $user->id_usuario)->count();
    $calculosCount = RecetaCalc::whereHas('receta', function ($query) use ($user) {
        $query->where('id_usuario', $user->id_usuario);
    })->count();
    $ingredientesCount = Receta::where('id_usuario', $user->id_usuario)->count();
    return view('dashboard', compact('user', 'recetasCount', 'recentRecetas', 'calculosCount', 'ingredientesCount'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'user'])->name('profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::delete('/profile/image', [ProfileController::class, 'deleteProfileImage'])->name('profile.image.destroy');
    Route::get('/profile/user', [ProfileController::class, 'user'])->name('profile.user');
    Route::patch('/profile/cover', [ProfileController::class, 'updateCover'])->name('profile.cover.update');
    Route::delete('/profile/cover', [ProfileController::class, 'deleteCover'])->name('profile.cover.destroy');
    Route::get('/profile/configuracion', [ProfileController::class, 'config'])->name('profile.configuracion');

    Route::get('/profile/receta', [ProfileController::class, 'recetaview'])->name('profile.recetas');
    Route::get('/profile/receta/create', [ProfileController::class, 'recetaviewCreate'])->name('profile.recetas.create');
    Route::post('/profile/receta/stora', [ProfileController::class, 'recetaviewStore'])->name('profile.recetas.store');
    Route::get('/profile/receta/{receta}', [ProfileController::class, 'recetaviewShow'])->name('profile.recetas.show');
    Route::get('profile/receta/{receta}/edit', [ProfileController::class, 'recetaviewEdit'])->name('profile.recetas.edit');
    Route::put('/profile/receta/{receta}', [ProfileController::class, 'recetaviewUpdate'])->name('profile.recetas.update');
    Route::delete('/profile/receta/{receta}', [ProfileController::class, 'recetaviewDestroy'])->name('profile.recetas.destroy');
    Route::get('/profile/mis-recetas-elaboradas', [ProfileController::class, 'recetaselaboradasview'])->name('profile.user.mis-recetas-elaboradas');

    Route::get('/receta/create', [RecetaController::class, 'create'])->name('recetas.create');
    Route::post('/receta/store', [RecetaController::class, 'store'])->name('recetas.store');
    Route::get('/receta/{receta}/edit', [RecetaController::class, 'edit'])->name('recetas.edit');
    Route::put('/receta/{receta}', [RecetaController::class, 'update'])->name('recetas.update');
    Route::delete('/receta/{receta}', [RecetaController::class, 'destroy'])->name('recetas.destroy');
});

Route::get('/receta/{receta}', [RecetaController::class, 'show'])->name('recetas.show');
Route::get('/receta', [RecetaController::class, 'index'])->name('recetas');
Route::get('/recetas/{receta}/calcular', [CalculoRecetaController::class, 'create'])
    ->name('recetas.calcular');

Route::post('/recetas/{receta}/calcular', [CalculoRecetaController::class, 'store'])
    ->name('recetas.calcular.store');

Route::get('/mis-recetas-elaboradas', [CalculoRecetaController::class, 'index'])
    ->name('recetas.elaboradas.index');

Route::get('/mis-recetas-elaboradas/{recetaElaborada}', [CalculoRecetaController::class, 'show'])
    ->name('recetas.elaboradas.show');

Route::get('/mis-recetas-elaboradas/{recetaElaborada}/documento', [CalculoRecetaController::class, 'document'])
    ->name('recetas.elaboradas.document');

Route::get('/mis-recetas-elaboradas/{recetaElaborada}/excel', [CalculoRecetaController::class, 'exportExcel'])
    ->name('recetas.elaboradas.excel');

Route::get('/google-auth/redirect', [
    GoogleAuthController::class,
    'redirect'
])->name('google');

Route::get('/google-auth/callback', [
    GoogleAuthController::class,
    'callback'
])->name('google.callback');

require __DIR__.'/auth.php';
