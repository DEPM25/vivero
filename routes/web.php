<?php
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

Route::resource('viveros', ViveroController::class);
Route::get('viveros-por-finca/{finca_id}', [ViveroController::class, 'getViverosPorFinca'])->name('viveros.por.finca');
