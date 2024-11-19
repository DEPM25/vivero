<?php

use App\Http\Controllers\ProdutoControlController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaborController;
use App\Http\Controllers\ViveroController;
use App\Http\Controllers\ProductorController;

Route::resource('labores', LaborController::class);

Route::get('/productores/registro', [ProductorController::class, 'showRegistroForm'])->name('productores.registro');
Route::post('/productores/registro', [ProductorController::class, 'store'])->name('productores.store');
/**Ruta para editar y borrar */
Route::get('/productores/{id}/edit', [ProductorController::class, 'edit'])->name('productores.edit');
Route::put('/productores/{id}', [ProductorController::class, 'update'])->name('productores.update');
Route::delete('/productores/{id}', [ProductorController::class, 'destroy'])->name('productores.destroy');


Route::get('/', function () {
    return view('welcome');
});

Route::get('/productor', [ProdutoControlController::class, 'index'])->name('productor.index');
Route::get('/productor/create', [ProdutoControlController::class, 'create'])->name('productor.create');
Route::post('/productor', [ProdutoControlController::class, 'store'])->name('productor.store');
Route::get('/productor/{id}/edit', [ProdutoControlController::class, 'edit'])->name('productor.edit');
Route::put('/productor/{id}', [ProdutoControlController::class, 'update'])->name('productor.update');
Route::delete('/productor/{id}', [ProdutoControlController::class, 'destroy'])->name('productor.destroy');
Route::get('/productor/search', [ProdutoControlController::class, 'search'])->name('productor.search');

Route::resource('viveros', ViveroController::class);
Route::get('viveros-por-finca/{finca_id}', [ViveroController::class, 'getViverosPorFinca'])->name('viveros.por.finca');
