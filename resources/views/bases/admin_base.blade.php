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
            --sidebar-width: 230px;
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
            font-size: 0.92rem;
            line-height: 1.45;
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
            padding: 20px 16px;
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
            font-size: 20px;
            color: var(--primary-color);
        }
        
        .sidebar-header h3 {
            font-size: 1.05rem;
            font-weight: 600;
            margin-bottom: 5px;
            color: white;
        }
        
        .sidebar-header p {
            font-size: 0.75rem;
            color: rgba(255, 255, 255, 0.7);
            margin-bottom: 0;
        }
        
        .sidebar-user {
            padding: 12px 16px;
            background: rgba(255, 255, 255, 0.05);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
        }
        
        .sidebar-user-avatar {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: var(--secondary-color);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 8px;
            font-weight: bold;
            color: white;
        }
        
        .sidebar-user-info h6 {
            font-size: 0.82rem;
            margin-bottom: 2px;
            color: white;
        }
        
        .sidebar-user-info small {
            font-size: 0.72rem;
            color: rgba(255, 255, 255, 0.6);
        }
        
        /* Sidebar Menu */
        .sidebar-menu {
            padding: 14px 0;
            height: calc(100vh - 180px);
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
            margin-bottom: 3px;
        }
        
        .nav-link {
            padding: 10px 16px;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            display: flex;
            align-items: center;
            border-left: 3px solid transparent;
            transition: all 0.3s;
            font-size: 0.88rem;
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
            width: 20px;
            font-size: 0.95rem;
            margin-right: 8px;
        }
        
        .nav-link .badge {
            margin-left: auto;
            font-size: 0.7rem;
            padding: 3px 6px;
        }
        
        #sidebar .dropdown-menu {
            background: rgba(0, 0, 0, 0.2);
            border: none;
            box-shadow: none;
            padding: 0;
        }
        
        #sidebar .dropdown-item {
            padding: 7px 18px 7px 40px;
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.82rem;
        }
        
        #sidebar .dropdown-item:hover {
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
            padding: 12px;
            background: rgba(0, 0, 0, 0.2);
            text-align: center;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .sidebar-footer small {
            font-size: 0.72rem;
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
            font-size: 1.15rem;
            cursor: pointer;
            margin-right: 20px;
            display: none;
        }
        
        .page-title h1 {
            font-size: 1.2rem;
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
            font-size: 1.05rem;
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

        .user-dropdown.dropdown-toggle::after {
            display: none;
        }
        
        .user-dropdown:hover {
            background: rgba(0, 0, 0, 0.05);
        }
        
        .user-avatar {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: var(--secondary-color);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 8px;
            font-weight: bold;
            color: white;
        }
        
        .user-info h6 {
            font-size: 0.82rem;
            margin-bottom: 2px;
            font-weight: 600;
        }
        
        .user-info small {
            font-size: 0.72rem;
            color: #6c757d;
        }
        
        /* Dropdown Menu */
        .dropdown-menu-end {
            background-color: #ffffff;
            border: none;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            padding: 10px 0;
            min-width: 200px;
        }

        .dropdown-menu-end .dropdown-item {
            color: #212529;
            font-size: 0.82rem;
            padding: 8px 14px;
        }

        .dropdown-menu-end .dropdown-item:hover {
            background-color: #f3f4f6;
            color: #111827;
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
            font-size: 0.88rem;
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
            padding: 6px 12px;
            font-size: 0.82rem;
            line-height: 1.25;
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
            padding: 4px 8px;
            font-size: 0.75rem;
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
            font-size: 0.82rem;
        }
        
        .form-control, .form-select {
            border-radius: 6px;
            border: 1px solid #ddd;
            padding: 7px 11px;
            font-size: 0.84rem;
            line-height: 1.25;
        }

        textarea.form-control {
            min-height: 92px;
        }

        .content-area .form-check-label {
            font-size: 0.82rem;
        }

        .content-area .table {
            font-size: 0.84rem;
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

        [data-bs-theme="dark"] .dropdown-menu-end {
            background-color: #1e1e1e;
            border: 1px solid #333;
        }

        [data-bs-theme="dark"] .dropdown-menu-end .dropdown-item {
            color: #e0e0e0;
        }

        [data-bs-theme="dark"] .dropdown-menu-end .dropdown-item:hover {
            background-color: #2a2a2a;
            color: #ffffff;
        }
    </style>
    
    @stack('styles')
</head>
<body>
    @php
        $homeDashboardRoute = auth()->check() && auth()->user()->hasAnyRole(['superadmin', 'admin'])
            ? route('admin.dashboard')
            : route('customer.dashboard');
    @endphp
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
                @can('view_dashboard')
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.dashboard', 'customer.dashboard') ? 'active' : '' }}"
                       href="{{ $homeDashboardRoute }}">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                @endcan

                @canany(['view_certificados', 'create_certificados', 'edit_certificados', 'delete_certificados'])
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('certificados.*') ? 'active' : '' }}"
                       href="{{ route('certificados.index') }}">
                        <i class="fas fa-certificate"></i>
                        <span>Certificados</span>
                        @php
                            $pendingCount = App\Models\Certificado::count();
                        @endphp
                        @if($pendingCount > 0)
                            <span class="badge bg-danger">{{ $pendingCount }}</span>
                        @endif
                    </a>
                </li>
                @endcanany

                @canany(['view_users', 'edit_users'])
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#usuariosSubmenu" data-bs-toggle="collapse" data-bs-target="#usuariosSubmenu" aria-expanded="false">
                        <i class="fas fa-users-cog"></i>
                        <span>Usuarios</span>
                        <i class="fas fa-chevron-right ms-auto"></i>
                    </a>
                    <div class="collapse" id="usuariosSubmenu">
                        <ul class="nav flex-column ps-4">
                            @can('view_users')
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('admin.users.index') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">
                                    <i class="fas fa-user-friends"></i>
                                    <span>Todos los Usuarios</span>
                                </a>
                            </li>
                            @endcan
                            @can('edit_users')
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('admin.users.create') ? 'active' : '' }}" href="{{ route('admin.users.create') }}">
                                    <i class="fas fa-user-plus"></i>
                                    <span>Nuevo Usuario</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('admin.users.roles*') ? 'active' : '' }}" href="{{ route('admin.users.roles') }}">
                                    <i class="fas fa-user-tag"></i>
                                    <span>Roles de Usuarios</span>
                                </a>
                            </li>
                            @endcan
                        </ul>
                    </div>
                </li>
                @endcanany

                @can('manage_services')
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('customer.services*') ? 'active' : '' }}"
                       href="{{ route('customer.services') }}">
                        <i class="fas fa-server"></i>
                        <span>Mis Servicios</span>
                    </a>
                </li>
                @endcan

                @role('superadmin')
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.service-plans.*') ? 'active' : '' }}"
                       href="{{ route('admin.service-plans.index') }}">
                        <i class="fas fa-layer-group"></i>
                        <span>Planes de Servicio</span>
                    </a>
                </li>
                @endrole

                @role('superadmin')
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.payment-methods.*') ? 'active' : '' }}"
                       href="{{ route('admin.payment-methods.index') }}">
                        <i class="fas fa-qrcode"></i>
                        <span>Medios de Pago</span>
                    </a>
                </li>
                @endrole

                @if(auth()->check() && auth()->user()->hasAnyRole(['superadmin', 'admin']))
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.payments.*') ? 'active' : '' }}"
                       href="{{ route('admin.payments.index') }}">
                        <i class="fas fa-money-check-alt"></i>
                        <span>Revisar Pagos</span>
                    </a>
                </li>
                @endif

                @if(auth()->check() && auth()->user()->hasAnyRole(['superadmin', 'admin']))
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.customer-services.*') ? 'active' : '' }}"
                       href="{{ route('admin.customer-services.index') }}">
                        <i class="fas fa-server"></i>
                        <span>Servicios Contratados</span>
                    </a>
                </li>
                @endif

                @can('view_payments')
                @if(auth()->check() && auth()->user()->hasRole('customer'))
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('customer.payments*') ? 'active' : '' }}"
                       href="{{ route('customer.payments') }}">
                        <i class="fas fa-credit-card"></i>
                        <span>Pagos</span>
                    </a>
                </li>
                @endif
                @endcan

                @can('update_profile')
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('customer.profile') ? 'active' : '' }}"
                       href="{{ route('customer.profile') }}">
                        <i class="fas fa-user"></i>
                        <span>Mi Perfil</span>
                    </a>
                </li>
                @endcan

                @canany(['view_roles', 'create_roles'])
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#rolesPermisosSubmenu" data-bs-toggle="collapse" data-bs-target="#rolesPermisosSubmenu" aria-expanded="false">
                        <i class="fas fa-user-shield"></i>
                        <span>Roles y Permisos</span>
                        <i class="fas fa-chevron-right ms-auto"></i>
                    </a>
                    <div class="collapse" id="rolesPermisosSubmenu">
                        <ul class="nav flex-column ps-4">
                            @can('view_roles')
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('admin.roles.index') ? 'active' : '' }}"
                                   href="{{ route('admin.roles.index') }}">
                                    <i class="fas fa-list"></i>
                                    <span>Lista de Roles</span>
                                </a>
                            </li>
                            @endcan
                            @can('create_roles')
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('admin.roles.create') ? 'active' : '' }}"
                                   href="{{ route('admin.roles.create') }}">
                                    <i class="fas fa-plus-circle"></i>
                                    <span>Nuevo Rol</span>
                                </a>
                            </li>
                            @endcan
                        </ul>
                    </div>
                </li>
                @endcanany

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
                            <li class="breadcrumb-item"><a href="{{ $homeDashboardRoute }}">Home</a></li>
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
                <div class="dropdown">
                    <a class="user-dropdown dropdown-toggle text-decoration-none"
                       href="#"
                       id="userMenuDropdown"
                       role="button"
                       data-bs-toggle="dropdown"
                       aria-expanded="false">
                        <div class="user-avatar">
                            {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
                        </div>
                        <div class="user-info">
                            <h6>{{ Auth::user()->name ?? 'Administrador' }}</h6>
                            <small>{{ Auth::user()->is_admin ? 'Administrador' : 'Usuario' }}</small>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="userMenuDropdown">
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
                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item">
                                <i class="fas fa-sign-out-alt me-2"></i>
                                Cerrar Sesión
                            </button>
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

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    <strong>Se encontraron errores:</strong>
                    <ul class="mb-0 mt-2 ps-3">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            
            <!-- Page Content -->
            @hasSection('admin_contenido')
                @yield('admin_contenido')
            @else
                @yield('content')
            @endif
        </div>
        
        <!-- Footer -->
        <footer class="main-footer">
            <small>
                <i class="fas fa-code"></i> AYW Solution v1.0
            </small>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Sidebar toggle on mobile
            var sidebar = document.getElementById('sidebar');
            var sidebarToggle = document.getElementById('sidebar-toggle');
            if (sidebar && sidebarToggle) {
                sidebarToggle.addEventListener('click', function () {
                    sidebar.classList.toggle('active');
                });
            }

            // Theme toggle
            var html = document.documentElement;
            var themeToggle = document.getElementById('theme-toggle');
            var savedTheme = localStorage.getItem('theme') || 'light';
            html.setAttribute('data-bs-theme', savedTheme);

            if (themeToggle) {
                var icon = themeToggle.querySelector('i');
                if (icon) {
                    icon.classList.remove('fa-moon', 'fa-sun');
                    icon.classList.add(savedTheme === 'dark' ? 'fa-sun' : 'fa-moon');
                }

                themeToggle.addEventListener('click', function () {
                    var currentTheme = html.getAttribute('data-bs-theme') || 'light';
                    var newTheme = currentTheme === 'dark' ? 'light' : 'dark';
                    html.setAttribute('data-bs-theme', newTheme);
                    localStorage.setItem('theme', newTheme);

                    if (icon) {
                        icon.classList.toggle('fa-moon');
                        icon.classList.toggle('fa-sun');
                    }
                });
            }

            // Expand submenu if there is an active child route
            document.querySelectorAll('.collapse .nav-link.active').forEach(function (activeLink) {
                var parentCollapse = activeLink.closest('.collapse');
                if (!parentCollapse) return;

                parentCollapse.classList.add('show');
                var trigger = document.querySelector('[href="#' + parentCollapse.id + '"]');
                if (trigger) {
                    trigger.classList.add('active');
                    trigger.setAttribute('aria-expanded', 'true');
                }
            });

            // Initialize tooltips
            document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(function (el) {
                new bootstrap.Tooltip(el);
            });
        });
    </script>
    
    @stack('scripts')
</body>
</html>