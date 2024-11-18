<?php

use App\Http\Controllers\ProdutoControlController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/productos/create', [ProdutoControlController::class, 'create'])->name('productos.create');
Route::post('/productos', [ProdutoControlController::class, 'store'])->name('productos.store');
