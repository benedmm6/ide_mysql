<?php

use Illuminate\Support\Facades\Route;

// CONTROLADORES

use App\Http\Controllers\DataController;
use App\Http\Controllers\TablesController;
use App\Http\Controllers\ConstrainController;
use App\Http\Controllers\ColumnsController;
// RUTAS RESOURCE

// RUTA INDEX
Route::get('/', [DataController::class, 'index'])->name('index');

// RUTA RESOURCE DATABASES
Route::resource('database',DataController::class)->names('admin.databases');

// RUTA RESOURCE TABLE
Route::resource('table', TablesController::class)->names('admin.tables');

// RUTA RESOURCE CONSTRAINT
Route::resource('constraint', ConstrainController::class)->names('admin.constraints');

// RUTA RESOURCE COLUMNS
Route::resource('columns', ColumnsController::class)->names('admin.columns');
