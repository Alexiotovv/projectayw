<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomesController;
use App\Http\Controllers\ContactosController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\InscripcionCursoController;


Route::get('/',[HomesController::class,'index'])->name('inicio');
Route::get('/contacto/index',[ContactosController::class,'index'])->name('contacto.index');
Route::post('/contacto/store',[ContactosController::class,'store'])->name('contacto.store');
Route::view('/customers', 'customers.index')->name('customers');

Route::view('/portfolio', 'portfolio.portfolio-index')->name('portfolio');

//Cursos
Route::get('/courses/index',[CoursesController::class,'index'])->name('courses.index');

//Inscripción
Route::get('/inscripcion-curso', [InscripcionCursoController::class, 'create'])->name('inscripcion.curso');
Route::post('/inscripcion-curso', [InscripcionCursoController::class, 'store'])->name('inscripcion.curso.store');


