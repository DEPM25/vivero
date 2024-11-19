<?php

use App\Http\Controllers\ProdutoControlController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaborController;
use App\Http\Controllers\ViveroController;
use App\Http\Controllers\ProductorController;

Route::resource('labores', LaborController::class);

Route::get('/productores/registro', [ProductorController::class, 'showRegistroForm'])->name('productores.registro');
Route::post('/productores/registro', [ProductorController::class, 'store'])->name('productores.store');
Route::get('/', function () {
    return view('welcome');
});

Route::get('/productos', [ProdutoControlController::class, 'index'])->name('productos.index');
Route::get('/productos/create', [ProdutoControlController::class, 'create'])->name('productos.create');
Route::post('/productos', [ProdutoControlController::class, 'store'])->name('productos.store');
Route::get('/productos/{id}/edit', [ProdutoControlController::class, 'edit'])->name('productos.edit');
Route::put('/productos/{id}', [ProdutoControlController::class, 'update'])->name('productos.update');
Route::delete('/productos/{id}', [ProdutoControlController::class, 'destroy'])->name('productos.destroy');
Route::get('/productos/search', [ProdutoControlController::class, 'search'])->name('productos.search');

Route::resource('viveros', ViveroController::class);
Route::get('viveros-por-finca/{finca_id}', [ViveroController::class, 'getViverosPorFinca'])->name('viveros.por.finca');
