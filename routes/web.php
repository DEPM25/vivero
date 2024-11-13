<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductorController;

Route::get('/productores/registro', [ProductorController::class, 'showRegistroForm'])->name('productores.registro');
Route::post('/productores/registro', [ProductorController::class, 'store'])->name('productores.store');
Route::get('/', function () {
    return view('welcome');
});
