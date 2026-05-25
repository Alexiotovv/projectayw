@extends('bases.admin_base')

@section('title', 'Contratar Servicios')
@section('page-title', 'Catálogo de Servicios')
@section('breadcrumb', 'Servicios')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h4 mb-0">Elige tu plan</h2>
    <a href="{{ route('customer.services') }}" class="btn btn-outline-secondary">Ver mis servicios</a>
</div>

<div class="row g-3">
    @forelse($plans as $plan)
    <div class="col-lg-4 col-md-6">
        <div class="card h-100 shadow-sm border-0">
            <div class="card-body">
                <span class="badge bg-{{ $plan->type === 'vps' ? 'primary' : 'info' }} mb-2">{{ strtoupper($plan->type) }}</span>
                <h5 class="card-title">{{ $plan->name }}</h5>
                <p class="text-muted small">{{ $plan->description }}</p>

                <div class="mb-2">
                    <span class="h4 fw-bold">S/. {{ number_format($plan->price, 2) }}</span>
                    <span class="text-muted">/{{ $plan->billing_cycle === 'yearly' ? 'año' : 'mes' }}</span>
                </div>

                <ul class="small text-muted ps-3 mb-3">
                    @foreach(($plan->features ?? []) as $feature)
                    <li>{{ $feature }}</li>
                    @endforeach
                </ul>

                <form action="{{ route('customer.services.acquire', $plan) }}" method="POST">
                    @csrf
                    <div class="mb-2">
                        <label class="form-label">Nombre del servicio</label>
                        <input type="text" class="form-control" name="service_name" value="{{ old('service_name') }}" placeholder="Ej: VPS Tienda Online" required>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Dominio (opcional)</label>
                        <input type="text" class="form-control" name="domain" value="{{ old('domain') }}" placeholder="midominio.com">
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Método de pago</label>
                        <select name="payment_method_id" class="form-select" required>
                            <option value="">Selecciona...</option>
                            @foreach($paymentMethods as $method)
                            <option value="{{ $method->id }}">
                                {{ $method->name }} ({{ strtoupper($method->type) }})
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" name="auto_renew" value="1" id="renew_{{ $plan->id }}" checked>
                        <label class="form-check-label" for="renew_{{ $plan->id }}">Renovación automática</label>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">
                        Adquirir ahora
                    </button>
                </form>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <div class="alert alert-info mb-0">No hay planes disponibles actualmente.</div>
    </div>
    @endforelse
</div>
@endsection
