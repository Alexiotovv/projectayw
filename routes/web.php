<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomesController;
use App\Http\Controllers\ContactosController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\InscripcionCursoController;


use App\Http\Controllers\PublicController;
use App\Http\Controllers\Customer\Auth\LoginController;
use App\Http\Controllers\Customer\DashboardController;
use App\Http\Controllers\Customer\ServiceController;
use App\Http\Controllers\Customer\PaymentController;
use App\Http\Controllers\EmailCorporateController;
use App\Http\Controllers\DomainController;
use App\Http\Controllers\CertificadoController;
use App\Http\Controllers\AuthController;


//Login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // O si quieres que /admin redirija al dashboard:
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // Certificados
    Route::resource('certificados', CertificadoController::class)->except(['show']);
    Route::get('certificados/preview', [CertificadoController::class, 'preview'])->name('certificados.preview');
});


// Rutas públicas
Route::get('/certificados/verificar', [CertificadoController::class, 'verificar'])
    ->name('certificados.verificar');
    
Route::post('/certificados/buscar', [CertificadoController::class, 'buscar'])
    ->name('certificado.buscar');
    
Route::get('/certificados/{hash}', [CertificadoController::class, 'show'])
    ->name('certificados.show');
    
Route::get('/certificados/{hash}/pdf', [CertificadoController::class, 'pdf'])
    ->name('certificados.pdf');

// Rutas de administración (protegidas)
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/certificados', [CertificadoController::class, 'index'])
        ->name('certificados.index');
        
    Route::get('/admin/certificados/crear', [CertificadoController::class, 'create'])
        ->name('certificados.create');
        
    Route::post('/admin/certificados', [CertificadoController::class, 'store'])
        ->name('certificados.store');
        
    Route::get('/admin/certificados/{id}/editar', [CertificadoController::class, 'edit'])
        ->name('certificados.edit');
        
    Route::put('/admin/certificados/{id}', [CertificadoController::class, 'update'])
        ->name('certificados.update');
        
    Route::delete('/admin/certificados/{id}', [CertificadoController::class, 'destroy'])
        ->name('certificados.destroy');
        
    Route::get('/admin/certificados/preview', [CertificadoController::class, 'preview'])
        ->name('certificados.preview');
});

// nuevas rutas
// Ruta customers - redirige al login
Route::get('/customers', function () {
    return redirect()->route('customer.login');
})->name('customers');


// Dominios
Route::prefix('api/domain')->group(function () {
    Route::post('/check', [DomainController::class, 'checkAvailability'])->name('domain.check');
    Route::post('/suggestions', [DomainController::class, 'getSuggestions'])->name('domain.suggestions');
});

Route::get('/email-corporate', [EmailCorporateController::class, 'index'])->name('email.corporate');
Route::post('/email-corporate/contact', [EmailCorporateController::class, 'contactForm'])->name('email.corporate.contact');





// Grupo de rutas para clientes
Route::prefix('customer')->name('customer.')->group(function () {
    // Autenticación
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    
    // Registro
    Route::get('/register', [LoginController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [LoginController::class, 'register']);
    
    // Rutas protegidas
    Route::middleware(['auth:web', 'customer'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/services', [ServiceController::class, 'index'])->name('services');
        Route::get('/payments', [PaymentController::class, 'index'])->name('payments');
        Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');
    });
});

////////////////////////////////////


Route::get('/',[HomesController::class,'index'])->name('inicio');
Route::get('/contacto/index',[ContactosController::class,'index'])->name('contacto.index');
Route::post('/contacto/store',[ContactosController::class,'store'])->name('contacto.store');
// Route::view('/customers', 'customers.index')->name('customers');

Route::view('/portfolio', 'portfolio.portfolio-index')->name('portfolio');

//Cursos
Route::get('/courses/index',[CoursesController::class,'index'])->name('courses.index');

//Inscripción
Route::get('/inscripcion-curso', [InscripcionCursoController::class, 'create'])->name('inscripcion.curso');
Route::post('/inscripcion-curso', [InscripcionCursoController::class, 'store'])->name('inscripcion.curso.store');


