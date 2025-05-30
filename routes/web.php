<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EquiposController;
use App\Http\Controllers\CalendarioController;
use App\Http\Controllers\TorneoController;
use App\Http\Controllers\InscripcionesController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\EstadisticasController;
use App\Http\Controllers\JugadorEnTorneoController;
use App\Http\Controllers\ModuloController;
use Illuminate\Support\Facades\Route;

// Route::view("/","home")->name("home");
Route::get('/', [CalendarioController::class, 'home'])->name('home');

Route::resource("equipos", EquiposController::class)
->middleware('auth');

Route::resource("users", UsersController::class)
->middleware('auth');

Route::post('/users/{id}/hacer-organizador', [UsersController::class, 'hacerOrganizador'])->name('users.hacerOrganizador');

Route::get('/inscripciones/store/{torneo}', [InscripcionesController::class, 'store'])->name('inscripciones.store')->middleware('auth');

Route::get('/torneos/{id}/estado', [TorneoController::class, 'estado']);

Route::post('/torneos/{id}/iniciar', [TorneoController::class, 'iniciar'])->name('torneos.iniciar');

Route::middleware('auth')->post('/torneos/{torneo}/preparado', [JugadorEnTorneoController::class, 'marcarPreparado'])
    ->name('torneos.preparado');

Route::get('/jugador-en-torneo/{torneo}', [JugadorEnTorneoController::class, 'show'])->name('jugadorEnTorneo.show');

Route::get('/torneos/{torneo}/unirse', [JugadorEnTorneoController::class, 'showFormularioUnirse'])
    ->name('jugadorEnTorneo.formularioUnirse')
    ->middleware('auth');

Route::post('/modulo/{modulo}/enlace', [ModuloController::class, 'updateLink'])->name('modulos.updateLink');

Route::get('/modulos/{modulo}/comprobar', [ModuloController::class, 'comprobarEstadoModulo'])->name('modulos.comprobarEstado');

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