@extends('bases.admin_base')

@section('page-title', 'Dashboard')
@section('breadcrumb', 'Dashboard')

@section('content')
<div class="row g-4">
    <div class="col-md-3">
        <div class="stat-card">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="stat-number">{{ \App\Models\User::count() }}</div>
                    <div class="stat-title">Usuarios</div>
                </div>
                <div class="stat-icon primary"><i class="fas fa-users"></i></div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="stat-number">{{ \App\Models\Certificado::count() }}</div>
                    <div class="stat-title">Certificados</div>
                </div>
                <div class="stat-icon success"><i class="fas fa-certificate"></i></div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="stat-number">{{ \Spatie\Permission\Models\Role::count() }}</div>
                    <div class="stat-title">Roles</div>
                </div>
                <div class="stat-icon warning"><i class="fas fa-user-tag"></i></div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="stat-number">{{ \App\Models\Payment::where('status', 'pending')->count() }}</div>
                    <div class="stat-title">Pagos Pendientes</div>
                </div>
                <div class="stat-icon danger"><i class="fas fa-money-bill-wave"></i></div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="fas fa-clock me-2"></i>Pagos Pendientes por Revisar</h5>
                <a href="{{ route('admin.payments.index', ['status' => 'pending']) }}" class="btn btn-sm btn-primary">Ver pagos</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Cliente</th>
                                <th>Servicio</th>
                                <th>Monto</th>
                                <th>Método</th>
                                <th>Estado</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse(\App\Models\Payment::with(['user', 'service'])->where('status', 'pending')->latest()->take(5)->get() as $payment)
                            <tr>
                                <td>{{ $payment->user?->name }}</td>
                                <td>{{ $payment->service?->name ?? 'Sin servicio' }}</td>
                                <td>S/. {{ number_format($payment->amount, 2) }}</td>
                                <td>{{ strtoupper($payment->payment_method) }}</td>
                                <td><span class="badge bg-warning">{{ $payment->status }}</span></td>
                                <td class="text-end">
                                    <a href="{{ route('admin.payments.show', $payment) }}" class="btn btn-sm btn-outline-primary">Revisar</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">No hay pagos pendientes.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5><i class="fas fa-info-circle me-2"></i>Bienvenido, {{ Auth::user()->name }}</h5>
            </div>
            <div class="card-body">
                <p class="mb-1">Roles asignados:
                    @foreach(Auth::user()->roles as $role)
                        <span class="badge
                            @if($role->name === 'superadmin') bg-danger
                            @elseif($role->name === 'admin') bg-warning
                            @else bg-secondary @endif me-1">{{ $role->name }}</span>
                    @endforeach
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
