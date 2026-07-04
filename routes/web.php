<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomesController;
use App\Http\Controllers\ContactosController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\InscripcionCursoController;


use App\Http\Controllers\PublicController;
use App\Http\Controllers\PublicServiceController;
use App\Http\Controllers\PublicServiceCheckoutController;
use App\Http\Controllers\Customer\Auth\LoginController;
use App\Http\Controllers\Customer\DashboardController;
use App\Http\Controllers\Customer\ServiceController;
use App\Http\Controllers\Customer\PaymentController;
use App\Http\Controllers\EmailCorporateController;
use App\Http\Controllers\DomainController;
use App\Http\Controllers\CertificadoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\ServicePlanController;
use App\Http\Controllers\Admin\PaymentMethodController;
use App\Http\Controllers\Admin\PaymentReviewController;
use App\Http\Controllers\Admin\CustomerServiceController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\UserRoleController;
use App\Http\Controllers\Admin\UserController;


//Login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');
Route::get('/reset-password/{token}', [AuthController::class, 'showResetPasswordForm'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');

Route::get('/lang/{locale}', function (string $locale) {
    if (! in_array($locale, ['en', 'es'], true)) {
        abort(404);
    }

    session(['locale' => $locale]);
    app()->setLocale($locale);

    $previousUrl = url()->previous();

    return $previousUrl ? redirect()->to($previousUrl) : redirect()->route('inicio');
})->name('lang.switch');


Route::middleware(['auth', 'role:superadmin|admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/', [AdminController::class, 'dashboard']);

    // Certificados
    Route::resource('certificados', CertificadoController::class)->except(['show']);
    Route::get('certificados/preview', [CertificadoController::class, 'preview'])->name('certificados.preview');

    // Gestión de Roles (solo superadmin)
    Route::resource('roles', RoleController::class)->except(['show']);

    // Usuarios y sus roles
    Route::get('users/roles', [UserRoleController::class, 'index'])->name('users.roles');
    Route::get('users/{user}/roles', [UserRoleController::class, 'edit'])->name('users.roles.edit');
    Route::put('users/{user}/roles', [UserRoleController::class, 'update'])->name('users.roles.update');

    // Gestión de usuarios (CRUD)
    Route::resource('users', UserController::class)->except(['show']);

    // Catálogo dinámico de servicios
    Route::resource('service-plans', ServicePlanController::class)->except(['show']);

    // Medios de pago (tarjeta / QR / transferencia / efectivo)
    Route::resource('payment-methods', PaymentMethodController::class)->except(['show']);

    // Revisión administrativa de pagos de clientes
    Route::get('payments', [PaymentReviewController::class, 'index'])->name('payments.index');
    Route::get('payments/{payment}', [PaymentReviewController::class, 'show'])->name('payments.show');
    Route::post('payments/{payment}/approve', [PaymentReviewController::class, 'approve'])->name('payments.approve');
    Route::post('payments/{payment}/reject', [PaymentReviewController::class, 'reject'])->name('payments.reject');
    Route::delete('payments/{payment}', [PaymentReviewController::class, 'destroy'])->name('payments.destroy');

    // Servicios contratados por clientes (superadmin/admin)
    Route::get('customer-services', [CustomerServiceController::class, 'index'])->name('customer-services.index');
    Route::delete('customer-services/{service}', [CustomerServiceController::class, 'destroy'])->name('customer-services.destroy');

    // Módulo de consultas del formulario de contacto
    Route::middleware('permission:view_contact_messages')->group(function () {
        Route::get('contact-messages', [ContactMessageController::class, 'index'])->name('contact-messages.index');
        Route::put('contact-messages/{contacto}', [ContactMessageController::class, 'update'])->name('contact-messages.update');
        Route::delete('contact-messages/{contacto}', [ContactMessageController::class, 'destroy'])->name('contact-messages.destroy');
    });
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

    Route::post('/admin/certificados/{certificado}/send-email', [CertificadoController::class, 'enviarPorCorreo'])
        ->name('certificados.send-email');
        
    Route::get('/admin/certificados/preview', [CertificadoController::class, 'preview'])
        ->name('certificados.preview');
});

// nuevas rutas
// Ruta customers - redirige al login
Route::get('/customers', function () {
    return redirect()->route('login');
})->name('customers');


// Dominios
Route::prefix('api/domain')->group(function () {
    Route::post('/check', [DomainController::class, 'checkAvailability'])->name('domain.check');
    Route::post('/suggestions', [DomainController::class, 'getSuggestions'])->name('domain.suggestions');
});

Route::get('/email-corporate', [EmailCorporateController::class, 'index'])->name('email.corporate');
Route::post('/email-corporate/contact', [EmailCorporateController::class, 'contactForm'])->name('email.corporate.contact');

Route::get('/services', [PublicServiceController::class, 'index'])->name('public.services.index');
Route::get('/services/plan/{servicePlan}/checkout', [PublicServiceCheckoutController::class, 'create'])->name('public.services.checkout.create');
Route::post('/services/plan/{servicePlan}/checkout', [PublicServiceCheckoutController::class, 'store'])->name('public.services.checkout.store');
Route::get('/services/{typeSlug}', [PublicServiceController::class, 'show'])->name('public.services.show');





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
        Route::get('/services/catalog', [ServiceController::class, 'catalog'])->name('services.catalog');
        Route::post('/services/{servicePlan}/acquire', [ServiceController::class, 'acquire'])->name('services.acquire');
        Route::get('/services/{id}', [ServiceController::class, 'show'])->name('services.show');
        Route::get('/services/{id}/renewal', [ServiceController::class, 'requestRenewal'])->name('services.requestRenewal');
        Route::get('/services/{id}/support', [ServiceController::class, 'requestSupport'])->name('services.requestSupport');

        Route::get('/payments', [PaymentController::class, 'index'])->name('payments');
        Route::get('/payments/{id}', [PaymentController::class, 'show'])->name('payments.show');
        Route::post('/payments/{id}/method', [PaymentController::class, 'updateMethod'])->name('payments.updateMethod');
        Route::post('/payments/{id}/submit', [PaymentController::class, 'submit'])->name('payments.submit');

        Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');
        Route::put('/profile', [DashboardController::class, 'updateProfile'])->name('profile.update');
        Route::get('/profile/email/verify/{id}/{hash}', [DashboardController::class, 'verifyPendingEmail'])
            ->middleware(['signed', 'throttle:6,1'])
            ->name('profile.email.verify');
    });
});

////////////////////////////////////


Route::get('/',[HomesController::class,'index'])->name('inicio');
Route::get('/contacto/index',[ContactosController::class,'index'])->name('contacto.index');
Route::post('/contacto/store',[ContactosController::class,'store'])->name('contacto.store');
// Route::view('/customers', 'customers.index')->name('customers');

Route::view('/portfolio', 'portfolio.portfolio-index')->name('portfolio');
Route::view('/about-us', 'about.about-us')->name('about.us');

//Cursos
Route::get('/courses/index',[CoursesController::class,'index'])->name('courses.index');

//Inscripción
Route::get('/inscripcion-curso', [InscripcionCursoController::class, 'create'])->name('inscripcion.curso');
Route::post('/inscripcion-curso', [InscripcionCursoController::class, 'store'])->name('inscripcion.curso.store');


