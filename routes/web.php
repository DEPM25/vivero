<?php

use App\Http\Controllers\LaborController;
use Illuminate\Support\Facades\Route;

Route::resource('labores', LaborController::class);
