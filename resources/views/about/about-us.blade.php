@extends('bases.public_home')

@section('public_contenido')
<!-- Start Page Title Section -->
<div class="page-title-area">
    <div class="d-table">
        <div class="d-table-cell">
            <div class="container">
                <div class="page-title-content">
                    <h2>{{ __('home.menu_about') }}</h2>
                    <ul>
                        <li><a href="{{ route('inicio') }}">{{ __('home.menu_home') }}</a></li>
                        <li>{{ __('home.menu_about') }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Page Title Section -->

<!-- Start About Section -->
<section class="about-area section-padding">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-12">
                <div class="about-image">
                    <img src="{{ asset('assets/img/about.jpg') }}" alt="About AYW Solution" class="img-fluid rounded shadow">
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="about-content">
                    <h6 class="sub-title">{{ __('home.about_page_who_we_are') }}</h6>
                    <h2>{{ __('home.about_page_subtitle') }}</h2>
                    <p>{{ __('home.about_page_intro_1') }}</p>
                    <p>{{ __('home.about_page_intro_2') }}</p>
                    <div class="about-btn-box">
                        <a class="default-btn" href="{{ route('contacto.index') }}">{{ __('home.about_page_contact') }}<span></span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End About Section -->

<!-- Start Feature Section -->
<section class="feature-section pt-100 pb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="feature-single-item">
                    <i class="fas fa-bullseye" style="font-size: 32px; color: #0f5cc8; margin-bottom: 15px;"></i>
                    <h3>{{ __('home.about_page_mission_title') }}</h3>
                    <p>{{ __('home.about_page_mission_text') }}</p>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="feature-single-item">
                    <i class="fas fa-eye" style="font-size: 32px; color: #0f5cc8; margin-bottom: 15px;"></i>
                    <h3>{{ __('home.about_page_vision_title') }}</h3>
                    <p>{{ __('home.about_page_vision_text') }}</p>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 mt-4">
                <div class="feature-single-item">
                    <i class="fas fa-handshake" style="font-size: 32px; color: #0f5cc8; margin-bottom: 15px;"></i>
                    <h3>{{ __('home.about_page_purpose_title') }}</h3>
                    <p>{{ __('home.about_page_purpose_text') }}</p>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 mt-4">
                <div class="feature-single-item">
                    <i class="fas fa-shield-alt" style="font-size: 32px; color: #0f5cc8; margin-bottom: 15px;"></i>
                    <h3>{{ __('home.about_page_promise_title') }}</h3>
                    <p>{{ __('home.about_page_promise_text') }}</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Feature Section -->

<!-- Start Quote Section -->
<section class="hire-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 col-md-12">
                <div class="hire-content text-center">
                    <h2>{{ __('home.about_page_quote') }}</h2>
                    <p>{{ __('home.about_page_quote_text') }}</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Quote Section -->
@endsection
