<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EquiposController;
use App\Http\Controllers\CalendarioController;
use App\Http\Controllers\TorneoController;
use App\Http\Controllers\EstadisticasController;
use Illuminate\Support\Facades\Route;

// Route::view("/","home")->name("home");
Route::get('/', [CalendarioController::class, 'home'])->name('home');

// Route::get('/solo-admin', function () {
//     return 'Bienvenido, administrador.';
// })->middleware('solo.admin');

// Route::get('/admin-o-organizador', function () {
//     return 'Bienvenido, admin u organizador.';
// })->middleware('admin.organizador');

Route::resource("equipos", EquiposController::class)
->middleware('auth');

Route::resource("estadisticas", EstadisticasController::class)
->middleware('auth');

Route::resource("calendarios", CalendarioController::class)
->middleware('auth');

Route::resource("torneos", TorneoController::class)
->middleware('auth');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';