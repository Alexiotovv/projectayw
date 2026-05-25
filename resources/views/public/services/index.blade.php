@extends('bases.public_home')

@section('public_contenido')
<div class="page-title-area">
    <div class="d-table">
        <div class="d-table-cell">
            <div class="container">
                <div class="page-title-content">
                    <h2>Servicios</h2>
                    <ul>
                        <li><a href="{{ route('inicio') }}">Home</a></li>
                        <li>Servicios</li>
                        @if($currentType)
                        <li>{{ $currentTypeLabel }}</li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="services-section pt-100 pb-70">
    <div class="container">
        <div class="section-title">
            <h6 class="sub-title">Catalogo Dinamico</h6>
            <h2>{{ $currentType ? 'Planes de ' . $currentTypeLabel : 'Todos nuestros planes de servicio' }}</h2>
            <p>Explora los planes publicados desde el panel de administracion.</p>
        </div>

        <div class="row mb-4">
            <div class="col-12 d-flex flex-wrap gap-2 justify-content-center">
                <a href="{{ route('public.services.index') }}" class="default-btn-one {{ $currentType ? '' : 'active' }}">Todos</a>
                @foreach(($publicServiceTypes ?? []) as $serviceType)
                <a href="{{ route('public.services.show', $serviceType['slug']) }}" class="default-btn-one {{ $currentType === $serviceType['slug'] ? 'active' : '' }}">{{ $serviceType['label'] }}</a>
                @endforeach
            </div>
        </div>

        <div class="row">
            @forelse($plans as $plan)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="single-services-item h-100">
                    <h3>{{ $plan->name }}</h3>
                    <p class="mb-1"><strong>Tipo:</strong> {{ \Illuminate\Support\Str::headline(str_replace('-', ' ', $plan->type)) }}</p>
                    <p class="mb-1"><strong>Ciclo:</strong> {{ $plan->billing_cycle === 'yearly' ? 'Anual' : 'Mensual' }}</p>
                    <p class="mb-3"><strong>Precio:</strong> S/. {{ number_format($plan->price, 2) }}</p>
                    @if($plan->description)
                    <p>{{ $plan->description }}</p>
                    @endif
                    @if(!empty($plan->features))
                    <ul>
                        @foreach($plan->features as $feature)
                        <li>{{ $feature }}</li>
                        @endforeach
                    </ul>
                    @endif
                    <a href="{{ route('public.services.checkout.create', $plan) }}" class="default-btn">Solicitar este plan <span></span></a>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="alert alert-info text-center">No hay servicios publicados para este tipo.</div>
            </div>
            @endforelse
        </div>
    </div>
</section>
@endsection
