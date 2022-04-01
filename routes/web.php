<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DataController;
use App\Http\Controllers\TablesController;


Route::get('/', [DataController::class, 'index'])->name('index');
// Route::get('/categorias', [HomeCategoriasController::class, 'index'])->name('home.categorias');
Route::resource('database',DataController::class)->names('admin.databases');

Route::resource('table', TablesController::class)->names('admin.tables');

// Route::resource('municipios', MunicipiosController::class)->names('admin.municipios');