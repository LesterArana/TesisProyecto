<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmpleadosController;
use App\Http\Controllers\PuestoController;
use App\Http\Controllers\DocumentacionController;
use App\Http\Controllers\NominaController;
use App\Http\Controllers\DeduccionController;

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/dashboard', function () {return view('dashboard');})->name('dashboard');
    

    // Rutas para Empleados y Puestos
    Route::resource('empleados', EmpleadosController::class);
    Route::resource('puestos', PuestoController::class);
    route::resource('documentaciones', DocumentacionController::class);
    Route::get('/empleados/{id}/edit', [EmpleadosController::class, 'edit'])->name('empleados.edit');
    Route::put('/empleados/{id}', [EmpleadosController::class, 'update'])->name('empleados.update');

    
    // Rutas para Documentación
    Route::get('/documentaciones', [DocumentacionController::class, 'index'])->name('documentaciones.index');
    Route::get('/documentaciones/create', [DocumentacionController::class, 'create'])->name('documentaciones.create');
    Route::get('/documentaciones/{id}', [DocumentacionController::class, 'show'])->name('documentaciones.show');
    Route::post('/documentaciones', [DocumentacionController::class, 'store'])->name('documentaciones.store');
    Route::delete('/documentaciones/{documentacion}', [DocumentacionController::class, 'destroy'])->name('documentaciones.destroy');
    Route::put('/empleados/{id}', [EmpleadosController::class, 'update'])->name('empleados.update');


   //Rutas nomina
  

   Route::resource('nominas', NominaController::class);
   Route::get('/nominas/create', [NominaController::class, 'create'])->name('nominas.create');
Route::post('/nominas', [NominaController::class, 'store'])->name('nominas.store');


//Rutas deducciones
Route::resource('nominas', NominaController::class);
Route::resource('deducciones', DeduccionController::class);
Route::resource('nominas', NominaController::class);





   
});







