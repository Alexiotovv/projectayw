@extends('bases.public_home')

@section('public_contenido')
<div class="page-title-area">
    <div class="d-table">
        <div class="d-table-cell">
            <div class="container">
                <div class="page-title-content">
                    <h2>{{ __('services.title_services') }}</h2>
                    <ul>
                        <li><a href="{{ route('inicio') }}">{{ __('services.home') }}</a></li>
                        <li>{{ __('services.breadcrumbs_services') }}</li>
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
            <h6 class="sub-title">{{ __('services.dynamic_catalog') }}</h6>
            <h2>{{ $currentType ? __('services.plans_for', ['type' => $currentTypeLabel]) : __('services.all_plans_title') }}</h2>
            <p>{{ __('services.catalog_description') }}</p>
        </div>

        <div class="row mb-4">
            <div class="col-12 d-flex flex-wrap gap-2 justify-content-center">
                <a href="{{ route('public.services.index') }}" class="default-btn-one {{ $currentType ? '' : 'active' }}">{{ __('services.filter_all') }}</a>
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
                    <p class="mb-1"><strong>{{ __('services.type') }}:</strong> {{ \Illuminate\Support\Str::headline(str_replace('-', ' ', $plan->type)) }}</p>
                    <p class="mb-1"><strong>{{ __('services.billing_cycle') }}:</strong> {{ $plan->billing_cycle === 'yearly' ? __('services.yearly') : __('services.monthly') }}</p>
                    <p class="mb-3"><strong>{{ __('services.price') }}:</strong> S/. {{ number_format($plan->price, 2) }}</p>
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
                    <a href="{{ route('public.services.checkout.create', $plan) }}" class="default-btn">{{ __('services.request_plan') }} <span></span></a>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="alert alert-info text-center">{{ __('services.no_services_for_type') }}</div>
            </div>
            @endforelse
        </div>
    </div>
</section>
@endsection
