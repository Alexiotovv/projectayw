{{-- resources/views/bases/admin_base.blade.php --}}
<!DOCTYPE html>
<html lang="es" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Panel Admin') - AYW Solution</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --sidebar-width: 250px;
            --header-height: 70px;
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --accent-color: #1abc9c;
            --dark-bg: #1e2a3a;
            --light-bg: #f8f9fa;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--light-bg);
            color: #333;
            overflow-x: hidden;
        }
        
        /* ===== SIDEBAR ===== */
        #sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background: linear-gradient(180deg, var(--primary-color) 0%, var(--dark-bg) 100%);
            color: white;
            transition: all 0.3s ease;
            z-index: 1000;
            box-shadow: 3px 0 15px rgba(0, 0, 0, 0.1);
        }
        
        .sidebar-header {
            padding: 25px 20px;
            background: rgba(0, 0, 0, 0.2);
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .sidebar-header .logo {
            width: 50px;
            height: 50px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
        }
        
        .sidebar-header .logo i {
            font-size: 24px;
            color: var(--primary-color);
        }
        
        .sidebar-header h3 {
            font-size: 1.3rem;
            font-weight: 700;
            margin-bottom: 5px;
            color: white;
        }
        
        .sidebar-header p {
            font-size: 0.85rem;
            color: rgba(255, 255, 255, 0.7);
            margin-bottom: 0;
        }
        
        .sidebar-user {
            padding: 15px 20px;
            background: rgba(255, 255, 255, 0.05);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
        }
        
        .sidebar-user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--secondary-color);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 10px;
            font-weight: bold;
            color: white;
        }
        
        .sidebar-user-info h6 {
            font-size: 0.9rem;
            margin-bottom: 2px;
            color: white;
        }
        
        .sidebar-user-info small {
            font-size: 0.8rem;
            color: rgba(255, 255, 255, 0.6);
        }
        
        /* Sidebar Menu */
        .sidebar-menu {
            padding: 20px 0;
            height: calc(100vh - 200px);
            overflow-y: auto;
        }
        
        .sidebar-menu::-webkit-scrollbar {
            width: 5px;
        }
        
        .sidebar-menu::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.05);
        }
        
        .sidebar-menu::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 5px;
        }
        
        .nav-item {
            margin-bottom: 5px;
        }
        
        .nav-link {
            padding: 12px 20px;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            display: flex;
            align-items: center;
            border-left: 3px solid transparent;
            transition: all 0.3s;
        }
        
        .nav-link:hover {
            color: white;
            background: rgba(255, 255, 255, 0.1);
            border-left: 3px solid var(--accent-color);
        }
        
        .nav-link.active {
            color: white;
            background: rgba(255, 255, 255, 0.1);
            border-left: 3px solid var(--accent-color);
        }
        
        .nav-link i {
            width: 25px;
            font-size: 1.1rem;
            margin-right: 10px;
        }
        
        .nav-link .badge {
            margin-left: auto;
            font-size: 0.7rem;
            padding: 3px 6px;
        }
        
        .dropdown-menu {
            background: rgba(0, 0, 0, 0.2);
            border: none;
            box-shadow: none;
            padding: 0;
        }
        
        .dropdown-item {
            padding: 8px 20px 8px 45px;
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.9rem;
        }
        
        .dropdown-item:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white;
        }
        
        .dropdown-toggle::after {
            margin-left: auto;
            transition: transform 0.3s;
        }
        
        .dropdown-toggle[aria-expanded="true"]::after {
            transform: rotate(90deg);
        }
        
        /* Sidebar Footer */
        .sidebar-footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            padding: 15px;
            background: rgba(0, 0, 0, 0.2);
            text-align: center;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .sidebar-footer small {
            font-size: 0.8rem;
            color: rgba(255, 255, 255, 0.5);
        }
        
        /* ===== MAIN CONTENT ===== */
        #main-content {
            margin-left: var(--sidebar-width);
            transition: all 0.3s ease;
            min-height: 100vh;
        }
        
        /* Top Header */
        .top-header {
            height: var(--header-height);
            background: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            position: sticky;
            top: 0;
            z-index: 100;
            display: flex;
            align-items: center;
            padding: 0 25px;
        }
        
        .header-left {
            display: flex;
            align-items: center;
        }
        
        #sidebar-toggle {
            background: none;
            border: none;
            color: var(--primary-color);
            font-size: 1.4rem;
            cursor: pointer;
            margin-right: 20px;
            display: none;
        }
        
        .page-title h1 {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 5px;
            color: var(--primary-color);
        }
        
        .breadcrumb {
            background: none;
            padding: 0;
            margin-bottom: 0;
        }
        
        .breadcrumb-item a {
            color: var(--secondary-color);
            text-decoration: none;
        }
        
        .breadcrumb-item.active {
            color: #6c757d;
        }
        
        .header-right {
            margin-left: auto;
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        /* Header Icons */
        .header-icon {
            position: relative;
            cursor: pointer;
            color: #6c757d;
            font-size: 1.2rem;
            transition: color 0.3s;
        }
        
        .header-icon:hover {
            color: var(--primary-color);
        }
        
        .header-icon .badge {
            position: absolute;
            top: -5px;
            right: -5px;
            font-size: 0.6rem;
            padding: 3px 6px;
        }
        
        /* User Dropdown */
        .user-dropdown {
            display: flex;
            align-items: center;
            cursor: pointer;
            padding: 5px 10px;
            border-radius: 50px;
            transition: background 0.3s;
        }
        
        .user-dropdown:hover {
            background: rgba(0, 0, 0, 0.05);
        }
        
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--secondary-color);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 10px;
            font-weight: bold;
            color: white;
        }
        
        .user-info h6 {
            font-size: 0.9rem;
            margin-bottom: 2px;
            font-weight: 600;
        }
        
        .user-info small {
            font-size: 0.8rem;
            color: #6c757d;
        }
        
        /* Dropdown Menu */
        .dropdown-menu-end {
            border: none;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            padding: 10px 0;
            min-width: 200px;
        }
        
        .dropdown-divider {
            margin: 5px 0;
        }
        
        /* ===== CONTENT AREA ===== */
        .content-area {
            padding: 25px;
            min-height: calc(100vh - var(--header-height));
        }
        
        /* Stats Cards */
        .stat-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            border-left: 4px solid var(--secondary-color);
            transition: all 0.3s;
            height: 100%;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }
        
        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 15px;
        }
        
        .stat-icon.primary {
            background: rgba(52, 152, 219, 0.1);
            color: var(--secondary-color);
        }
        
        .stat-icon.success {
            background: rgba(46, 204, 113, 0.1);
            color: #2ecc71;
        }
        
        .stat-icon.warning {
            background: rgba(241, 196, 15, 0.1);
            color: #f1c40f;
        }
        
        .stat-icon.danger {
            background: rgba(231, 76, 60, 0.1);
            color: #e74c3c;
        }
        
        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 5px;
            color: var(--primary-color);
        }
        
        .stat-title {
            font-size: 0.9rem;
            color: #6c757d;
            margin-bottom: 10px;
        }
        
        .stat-change {
            font-size: 0.85rem;
            font-weight: 600;
        }
        
        .stat-change.positive {
            color: #27ae60;
        }
        
        .stat-change.negative {
            color: #e74c3c;
        }
        
        /* Cards */
        .card {
            border: none;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            border-radius: 10px;
            margin-bottom: 25px;
            overflow: hidden;
        }
        
        .card-header {
            background: white;
            border-bottom: 1px solid #eee;
            padding: 15px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        
        .card-header h5 {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 0;
            color: var(--primary-color);
        }
        
        .card-header .btn {
            font-size: 0.9rem;
            padding: 5px 15px;
        }
        
        .card-body {
            padding: 20px;
        }
        
        /* Tables */
        .table {
            margin-bottom: 0;
        }
        
        .table thead th {
            border-bottom: 2px solid #eee;
            font-weight: 600;
            color: var(--primary-color);
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
        }
        
        .table tbody tr {
            transition: background 0.3s;
        }
        
        .table tbody tr:hover {
            background: rgba(52, 152, 219, 0.05);
        }
        
        /* Buttons */
        .btn {
            border-radius: 6px;
            font-weight: 500;
            padding: 8px 16px;
            font-size: 0.9rem;
        }
        
        .btn-primary {
            background: var(--secondary-color);
            border-color: var(--secondary-color);
        }
        
        .btn-primary:hover {
            background: #2980b9;
            border-color: #2980b9;
        }
        
        .btn-success {
            background: #27ae60;
            border-color: #27ae60;
        }
        
        .btn-warning {
            background: #f39c12;
            border-color: #f39c12;
        }
        
        .btn-danger {
            background: #e74c3c;
            border-color: #e74c3c;
        }
        
        .btn-sm {
            padding: 5px 10px;
            font-size: 0.8rem;
        }
        
        /* Badges */
        .badge {
            font-weight: 500;
            padding: 5px 10px;
            border-radius: 50px;
            font-size: 0.8rem;
        }
        
        /* Forms */
        .form-label {
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 8px;
        }
        
        .form-control, .form-select {
            border-radius: 6px;
            border: 1px solid #ddd;
            padding: 10px 15px;
            font-size: 0.95rem;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
        }
        
        /* Alerts */
        .alert {
            border-radius: 8px;
            border: none;
            padding: 15px;
        }
        
        /* Footer */
        .main-footer {
            padding: 20px;
            background: white;
            border-top: 1px solid #eee;
            text-align: center;
            color: #6c757d;
            font-size: 0.9rem;
        }
        
        /* ===== RESPONSIVE ===== */
        @media (max-width: 992px) {
            #sidebar {
                margin-left: -250px;
            }
            
            #sidebar.active {
                margin-left: 0;
            }
            
            #main-content {
                margin-left: 0;
            }
            
            #sidebar-toggle {
                display: block;
            }
            
            .top-header {
                padding: 0 15px;
            }
            
            .content-area {
                padding: 15px;
            }
        }
        
        @media (max-width: 768px) {
            .header-right {
                gap: 10px;
            }
            
            .user-info {
                display: none;
            }
            
            .user-avatar {
                margin-right: 0;
            }
            
            .page-title h1 {
                font-size: 1.3rem;
            }
        }
        
        /* ===== DARK MODE ===== */
        [data-bs-theme="dark"] body {
            background-color: #121212;
            color: #e0e0e0;
        }
        
        [data-bs-theme="dark"] .top-header,
        [data-bs-theme="dark"] .card,
        [data-bs-theme="dark"] .stat-card {
            background-color: #1e1e1e;
            color: #e0e0e0;
        }
        
        [data-bs-theme="dark"] .card-header {
            background-color: #252525;
            border-color: #333;
        }
        
        [data-bs-theme="dark"] .table {
            color: #e0e0e0;
        }
        
        [data-bs-theme="dark"] .table thead th {
            border-color: #333;
            color: #b0b0b0;
        }
        
        [data-bs-theme="dark"] .table tbody tr {
            border-color: #333;
        }
        
        [data-bs-theme="dark"] .form-control,
        [data-bs-theme="dark"] .form-select {
            background-color: #252525;
            border-color: #333;
            color: #e0e0e0;
        }
        
        [data-bs-theme="dark"] .form-control:focus,
        [data-bs-theme="dark"] .form-select:focus {
            background-color: #252525;
            border-color: var(--secondary-color);
        }
    </style>
    
    @stack('styles')
</head>
<body>
    <!-- Sidebar -->
    <div id="sidebar">
        <!-- Sidebar Header -->
        <div class="sidebar-header">
            <div class="logo">
                <i class="fas fa-shield-alt"></i>
            </div>
            <h3>AYW Admin</h3>
            <p>Panel de Control</p>
        </div>
        
        <!-- User Info -->
        <div class="sidebar-user">
            <div class="sidebar-user-avatar">
                {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
            </div>
            <div class="sidebar-user-info">
                <h6>{{ Auth::user()->name ?? 'Administrador' }}</h6>
                <small>{{ Auth::user()->is_admin ? 'Administrador' : 'Usuario' }}</small>
            </div>
        </div>
        
        <!-- Sidebar Menu -->
        <div class="sidebar-menu">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" 
                       href="{{ route('admin.dashboard') }}">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('certificados.*') ? 'active' : '' }}" 
                       href="{{ route('certificados.index') }}">
                        <i class="fas fa-certificate"></i>
                        <span>Certificados</span>
                        @php
                            $pendingCount = App\Models\Certificado::count(); // Cambia esto según tu lógica
                        @endphp
                        @if($pendingCount > 0)
                            <span class="badge bg-danger">{{ $pendingCount }}</span>
                        @endif
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="#cursosSubmenu" data-bs-toggle="collapse">
                        <i class="fas fa-graduation-cap"></i>
                        <span>Cursos</span>
                        <i class="fas fa-chevron-right ms-auto"></i>
                    </a>
                    <div class="collapse" id="cursosSubmenu">
                        <ul class="nav flex-column ps-4">
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <i class="fas fa-list"></i>
                                    <span>Lista de Cursos</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <i class="fas fa-plus-circle"></i>
                                    <span>Nuevo Curso</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <i class="fas fa-users"></i>
                                    <span>Estudiantes</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="fas fa-chart-line"></i>
                        <span>Estadísticas</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="#usuariosSubmenu" data-bs-toggle="collapse">
                        <i class="fas fa-users-cog"></i>
                        <span>Usuarios</span>
                        <i class="fas fa-chevron-right ms-auto"></i>
                    </a>
                    <div class="collapse" id="usuariosSubmenu">
                        <ul class="nav flex-column ps-4">
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <i class="fas fa-user-friends"></i>
                                    <span>Todos los Usuarios</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <i class="fas fa-user-tie"></i>
                                    <span>Clientes</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <i class="fas fa-user-shield"></i>
                                    <span>Administradores</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="fas fa-cog"></i>
                        <span>Configuración</span>
                    </a>
                </li>
                
                <li class="nav-item mt-4">
                    <a class="nav-link" href="{{ route('inicio') }}" target="_blank">
                        <i class="fas fa-external-link-alt"></i>
                        <span>Ver Sitio Web</span>
                    </a>
                </li>
            </ul>
        </div>
        
        <!-- Sidebar Footer -->
        <div class="sidebar-footer">
            <small>
                <i class="fas fa-code"></i> AYW Solution v1.0
            </small>
        </div>
    </div>
    
    <!-- Main Content -->
    <div id="main-content">
        <!-- Top Header -->
        <header class="top-header">
            <div class="header-left">
                <button id="sidebar-toggle" type="button">
                    <i class="fas fa-bars"></i>
                </button>
                
                <div class="page-title">
                    <h1>@yield('page-title', 'Dashboard')</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">@yield('breadcrumb', 'Dashboard')</li>
                        </ol>
                    </nav>
                </div>
            </div>
            
            <div class="header-right">
                <!-- Theme Toggle -->
                <div class="header-icon" id="theme-toggle">
                    <i class="fas fa-moon"></i>
                </div>
                
                <!-- Notifications -->
                <div class="header-icon dropdown">
                    <i class="fas fa-bell" data-bs-toggle="dropdown"></i>
                    <span class="badge bg-danger">3</span>
                    <div class="dropdown-menu dropdown-menu-end">
                        <h6 class="dropdown-header">Notificaciones</h6>
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-certificate text-primary me-2"></i>
                            Nuevo certificado generado
                        </a>
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-user text-success me-2"></i>
                            Nuevo usuario registrado
                        </a>
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-comment text-warning me-2"></i>
                            Nuevo mensaje recibido
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-bell me-2"></i>
                            Ver todas
                        </a>
                    </div>
                </div>
                
                <!-- User Dropdown -->
                <div class="user-dropdown dropdown">
                    <div class="user-avatar">
                        {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
                    </div>
                    <div class="user-info" data-bs-toggle="dropdown">
                        <h6>{{ Auth::user()->name ?? 'Administrador' }}</h6>
                        <small>{{ Auth::user()->is_admin ? 'Administrador' : 'Usuario' }}</small>
                    </div>
                    <div class="dropdown-menu dropdown-menu-end">
                        <h6 class="dropdown-header">Cuenta</h6>
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-user me-2"></i>
                            Mi Perfil
                        </a>
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-cog me-2"></i>
                            Configuración
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt me-2"></i>
                            Cerrar Sesión
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </header>
        
        <!-- Content Area -->
        <div class="content-area">
            <!-- Flash Messages -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            
            @if(session('warning'))
                <div class="alert alert-warning alert-dismissible fade show">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    {{ session('warning') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            
            @if(session('info'))
                <div class="alert alert-info alert-dismissible fade show">
                    <i class="fas fa-info-circle me-2"></i>
                    {{ session('info') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            
            <!-- Page Content -->
            @yield('admin_contenido')
        </div>
        
        <!-- Footer -->
        <footer class="main-footer">
            <p class="mb-0">
                &copy; {{ date('Y') }} AYW Solution - Panel de Administración
                <span class="text-muted mx-2">|</span>
                <small>Último acceso: {{ now()->format('d/m/Y H:i') }}</small>
            </p>
        </footer>
    </div>
    
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Sidebar Toggle
        $(document).ready(function() {
            $('#sidebar-toggle').click(function() {
                $('#sidebar').toggleClass('active');
            });
            
            // Close sidebar on mobile when clicking outside
            $(document).click(function(event) {
                if ($(window).width() <= 992) {
                    if (!$(event.target).closest('#sidebar, #sidebar-toggle').length) {
                        $('#sidebar').removeClass('active');
                    }
                }
            });
            
            // Theme Toggle
            $('#theme-toggle').click(function() {
                const currentTheme = $('html').attr('data-bs-theme');
                const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
                
                $('html').attr('data-bs-theme', newTheme);
                const icon = $(this).find('i');
                icon.toggleClass('fa-moon fa-sun');
                
                // Save to localStorage
                localStorage.setItem('theme', newTheme);
            });
            
            // Load saved theme
            const savedTheme = localStorage.getItem('theme') || 'light';
            $('html').attr('data-bs-theme', savedTheme);
            const themeIcon = $('#theme-toggle i');
            themeIcon.removeClass('fa-moon fa-sun');
            themeIcon.addClass(savedTheme === 'dark' ? 'fa-sun' : 'fa-moon');
            
            // Auto close dropdowns on mobile
            $('.dropdown-menu a').click(function() {
                if ($(window).width() <= 768) {
                    $(this).closest('.dropdown').removeClass('show');
                }
            });
            
            // Active menu highlighting
            const currentUrl = window.location.href;
            $('.sidebar-menu .nav-link').each(function() {
                if (this.href === currentUrl) {
                    $(this).addClass('active');
                    // Expand parent if exists
                    const parentCollapse = $(this).closest('.collapse');
                    if (parentCollapse.length) {
                        parentCollapse.addClass('show');
                        parentCollapse.prev('.nav-link').attr('aria-expanded', 'true');
                    }
                }
            });
            
            // Initialize tooltips
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            });
        });
    </script>
    
    @stack('scripts')
</body>
</html>