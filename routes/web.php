<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistroController;

Route::get('/', [RegistroController::class, 'index'])->name('registro.index');
Route::post('/registro', [RegistroController::class, 'store'])->name('registro.store');
