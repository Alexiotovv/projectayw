<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomesController;
use App\Http\Controllers\ContactosController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/',[HomesController::class,'index'])->name('inicio');
Route::get('/contacto/index',[ContactosController::class,'index'])->name('contacto.index');
Route::post('/contacto/store',[ContactosController::class,'store'])->name('contacto.store');
Route::view('/customers', 'customers.index')->name('customers');

Route::view('/portfolio', 'portfolio.portfolio-index')->name('portfolio');
