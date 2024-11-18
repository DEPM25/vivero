<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ViveroController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('viveros', ViveroController::class);
Route::get('viveros-por-finca/{finca_id}', [ViveroController::class, 'getViverosPorFinca'])->name('viveros.por.finca');