<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmpleadosController;
use App\Http\Controllers\PuestoController;
use App\Http\Controllers\DocumentacionController;
use App\Http\Controllers\NominaController;
use App\Http\Controllers\DeduccionController;


Auth::routes();

// Ruta para la generación de PDF de nóminas
Route::get('nominas/pdf', [NominaController::class, 'pdf'])->name('nominas.pdf');


// Ruta principal del sitio
Route::get('/', [HomeController::class, 'index'])->name('home');

// Grupo de rutas protegidas por autenticación
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('layout.index');
    Route::get('/home', [AdminController::class, 'index'])->name('layout.index');

    // Rutas para Empleados
    Route::resource('empleados', EmpleadosController::class);
    Route::get('/empleados/{id}/edit', [EmpleadosController::class, 'edit'])->name('empleados.edit');
    Route::put('/empleados/{id}', [EmpleadosController::class, 'update'])->name('empleados.update');

    // Rutas para Puestos
    Route::resource('puestos', PuestoController::class);

    // Rutas para Documentación
    Route::resource('documentaciones', DocumentacionController::class);
    Route::get('/documentaciones/{id}', [DocumentacionController::class, 'show'])->name('documentaciones.show');

    // Rutas para Nóminas
    Route::resource('nominas', NominaController::class);

    // Rutas para Deducciones
    Route::resource('deducciones', DeduccionController::class);
});
