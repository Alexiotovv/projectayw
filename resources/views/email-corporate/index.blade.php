@extends('bases.public_home')

@section('script_head')
<style>
    .pricing-area {
        padding: 100px 0;
    }
    
    .single-pricing {
        background: #fff;
        padding: 40px 30px;
        border-radius: 10px;
        position: relative;
        margin-bottom: 30px;
        box-shadow: 0 5px 30px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        border: 2px solid #050505;
    }
    
    .single-pricing:hover {
        transform: translateY(-10px);
        border-color: #4a6cf7;
    }
    
    .single-pricing.popular {
        border-color: #4a6cf7;
        transform: scale(1.05);
    }
    
    .single-pricing.popular:hover {
        transform: translateY(-10px) scale(1.05);
    }
    
    .popular-badge {
        position: absolute;
        top: -15px;
        left: 50%;
        transform: translateX(-50%);
        background: #4a6cf7;
        color: #fff;
        padding: 8px 20px;
        border-radius: 30px;
        font-size: 14px;
        font-weight: 600;
    }
    
    .pricing-header {
        text-align: center;
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 1px solid #e9ecef;
    }
    
    .pricing-title {
        font-size: 24px;
        font-weight: 700;
        margin-bottom: 10px;
        color: #333;
    }
    
    .pricing-price {
        font-size: 48px;
        font-weight: 800;
        color: #4a6cf7;
        line-height: 1;
        margin-bottom: 5px;
    }
    
    .pricing-period {
        font-size: 16px;
        color: #666;
    }
    
    .pricing-features {
        list-style: none;
        padding: 0;
        margin-bottom: 30px;
    }
    
    .pricing-features li {
        padding: 8px 0;
        color: #555;
        position: relative;
        padding-left: 25px;
    }
    
    .pricing-features li:before {
        content: '✓';
        position: absolute;
        left: 0;
        color: #4a6cf7;
        font-weight: bold;
    }
    
    .pricing-btn {
        text-align: center;
    }
    
    .service-benefits {
        background: #f9f9f9;
        padding: 60px 0;
    }
    
    .benefit-item {
        text-align: center;
        margin-bottom: 30px;
    }
    
    .benefit-icon {
        width: 70px;
        height: 70px;
        line-height: 70px;
        background: #4a6cf7;
        border-radius: 50%;
        margin: 0 auto 20px;
        color: #fff;
        font-size: 30px;
    }
    
    .faq-item {
        margin-bottom: 20px;
        border: 1px solid #e9ecef;
        border-radius: 10px;
        padding: 20px;
    }
    
    .faq-question {
        font-weight: 600;
        color: #333;
        margin-bottom: 10px;
    }
    
    .faq-answer {
        color: #666;
        margin-bottom: 0;
    }
    
    .contact-form-box {
        background: #fff;
        padding: 40px;
        border-radius: 10px;
        box-shadow: 0 5px 30px rgba(0, 0, 0, 0.1);
    }
</style>
@endsection

@section('public_contenido')
<!-- Start Page Title Section -->
<div class="page-title-area page-title-bg">
    <div class="d-table">
        <div class="d-table-cell">
            <div class="container">
                <div class="page-title-content">
                    <h2>{{ __('email_corporate.page_title') }}</h2>
                    <ul>
                        <li><a href="{{ route('inicio') }}">{{ __('home.menu_home') }}</a></li>
                        <li>{{ __('email_corporate.breadcrumb_services') }}</li>
                        <li>{{ __('email_corporate.page_title') }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Page Title Section -->

<!-- Start Pricing Section -->
<section class="pricing-area section-padding">
    <div class="container">
        <div class="section-title">
            <h6 class="sub-title">{{ __('email_corporate.plans_subtitle') }}</h6>
            <h2>{{ $serviceInfo['title'] }}</h2>
            <p class="mb-5">{{ $serviceInfo['subtitle'] }}</p>
        </div>
        
        <div class="row">
            @foreach($plans as $plan)
            <div class="col-lg-4 col-md-6">
                <div class="single-pricing {{ $plan['popular'] ? 'popular' : '' }}">
                    @if($plan['popular'])
                    <div class="popular-badge">{{ __('email_corporate.plan_popular_badge') }}</div>
                    @endif
                    
                    <div class="pricing-header">
                        <h3 class="pricing-title">{{ $plan['name'] }}</h3>
                        <div class="pricing-price">s/{{ $plan['price'] }}</div>
                        <div class="pricing-period">{{ __('email_corporate.plan_period_prefix') }} {{ __('email_corporate.plan_period') }}</div>
                    </div>
                    
                    <ul class="pricing-features">
                        @foreach($plan['features'] as $feature)
                        <li>{{ $feature }}</li>
                        @endforeach
                    </ul>
                    
                    <div class="pricing-btn">
                        <button type="button" class="default-btn me-2" data-bs-toggle="modal" data-bs-target="#contactModal" onclick="selectPlan('{{ $plan['id'] }}', '{{ $plan['name'] }}')">
                            {{ __('email_corporate.plan_hire') }} <span></span>
                        </button>
                        
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- End Pricing Section -->

<!-- Start Benefits Section -->
<section class="service-benefits section-padding">
    <div class="container">
        <div class="section-title">
            <h2>{{ __('email_corporate.benefits_title') }}</h2>
            <p>{{ __('email_corporate.benefits_subtitle') }}</p>
        </div>
        
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="benefit-item">
                    <div class="benefit-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h4>{{ __('email_corporate.benefit_security_title') }}</h4>
                    <p>{{ __('email_corporate.benefit_security_text') }}</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <div class="benefit-item">
                    <div class="benefit-icon">
                        <i class="fas fa-rocket"></i>
                    </div>
                    <h4>{{ __('email_corporate.benefit_speed_title') }}</h4>
                    <p>{{ __('email_corporate.benefit_speed_text') }}</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <div class="benefit-item">
                    <div class="benefit-icon">
                        <i class="fas fa-headset"></i>
                    </div>
                    <h4>{{ __('email_corporate.benefit_support_title') }}</h4>
                    <p>{{ __('email_corporate.benefit_support_text') }}</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <div class="benefit-item">
                    <div class="benefit-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h4>{{ __('email_corporate.benefit_scalability_title') }}</h4>
                    <p>{{ __('email_corporate.benefit_scalability_text') }}</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Benefits Section -->

<!-- Start FAQ Section -->
<section class="section-padding">
    <div class="container">
        <div class="section-title">
            <h2>{{ __('email_corporate.faq_title') }}</h2>
            <p>{{ __('email_corporate.faq_subtitle') }}</p>
        </div>
        
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                @foreach($serviceInfo['faq'] as $faq)
                <div class="faq-item">
                    <h5 class="faq-question">{{ $faq['question'] }}</h5>
                    <p class="faq-answer">{{ $faq['answer'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
<!-- End FAQ Section -->

<!-- Start Contact Form Modal -->
<div class="modal fade" id="contactModal" tabindex="-1" aria-labelledby="contactModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="contactModalLabel">{{ __('email_corporate.modal_title') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="contact-form-box">
                    <form id="serviceContactForm" method="POST" action="{{ route('email.corporate.contact') }}">
                        @csrf
                        <input type="hidden" id="selectedPlan" name="plan" value="">
                        <input type="hidden" id="requestType" name="request_type" value="contract">
                        
                        <!-- Selección de tipo de dominio -->
                        <div class="mb-4">
                            <label class="form-label fw-bold">{{ __('email_corporate.form_what_need') }}</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-check card p-3 mb-2">
                                        <input class="form-check-input" type="radio" name="domain_type" 
                                               id="new_domain" value="new" checked>
                                        <label class="form-check-label fw-bold" for="new_domain">
                                            <i class="fas fa-plus-circle text-primary me-2"></i>{{ __('email_corporate.form_new_domain') }}
                                        </label>
                                        <small class="text-muted">{{ __('email_corporate.form_new_domain_sub') }}</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check card p-3 mb-2">
                                        <input class="form-check-input" type="radio" name="domain_type" 
                                               id="existing_domain" value="existing">
                                        <label class="form-check-label fw-bold" for="existing_domain">
                                            <i class="fas fa-link text-success me-2"></i>{{ __('email_corporate.form_existing_domain') }}
                                        </label>
                                        <small class="text-muted">{{ __('email_corporate.form_existing_domain_sub') }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Sección para dominio NUEVO -->
                        <div id="newDomainSection">
                            <div class="card border-primary mb-4">
                                <div class="card-header bg-primary text-white">
                                    <h6 class="mb-0"><i class="fas fa-search me-2"></i>{{ __('email_corporate.form_search_domain_title') }}</h6>
                                </div>
                                <div class="card-body">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" id="domainSearch" 
                                               placeholder="{{ __('email_corporate.form_search_placeholder') }}" aria-label="{{ __('email_corporate.form_search_domain_title') }}">
                                        <select class="form-select" id="domainTld" style="max-width: 150px;">
                                            <option value=".com">.com</option>
                                            <option value=".pe">.pe</option>
                                            <option value=".com.pe">.com.pe</option>
                                            <option value=".net">.net</option>
                                            <option value=".org">.org</option>
                                            <option value=".io">.io</option>
                                            <option value=".co">.co</option>
                                            <option value=".info">.info</option>
                                            <option value=".biz">.biz</option>
                                        </select>
                                        <button class="btn btn-primary" type="button" id="btnSearchDomain">
                                            <i class="fas fa-search"></i> {{ __('email_corporate.form_search_btn') }}
                                        </button>
                                    </div>
                                    
                                    <!-- Loading -->
                                    <div id="domainLoading" class="text-center mt-3" style="display: none;">
                                        <div class="spinner-border spinner-border-sm text-primary" role="status">
                                            <span class="visually-hidden">Buscando...</span>
                                        </div>
                                        <span class="ms-2">{{ __('email_corporate.form_searching') }}</span>
                                    </div>
                                    
                                    <!-- Resultados de búsqueda -->
                                    <div id="domainResults" style="display: none;">
                                        <h6 class="mb-3">{{ __('email_corporate.form_results') }}</h6>
                                        <div id="domainResultContent"></div>
                                    </div>
                                    
                                    <!-- Sugerencias -->
                                    <div id="domainSuggestions" class="mt-3" style="display: none;">
                                        <h6 class="mb-2">{{ __('email_corporate.form_suggestions') }}</h6>
                                        <div id="suggestionsList" class="row"></div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Dominio seleccionado -->
                            <div id="selectedDomainInfo" class="alert alert-success mb-3" style="display: none;">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-1"><i class="fas fa-check-circle me-2"></i>{{ __('email_corporate.form_selected_domain') }}</h6>
                                        <p class="mb-0" id="selectedDomainText"></p>
                                        <small class="text-muted" id="selectedDomainPrice"></small>
                                    </div>
                                    <input type="hidden" id="selectedDomainInput" name="selected_domain">
                                    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="clearDomainSelection()">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Sección para dominio EXISTENTE -->
                        <div id="existingDomainSection" style="display: none;">
                            <div class="card border-success mb-4">
                                <div class="card-header bg-success text-white">
                                    <h6 class="mb-0"><i class="fas fa-link me-2"></i>{{ __('email_corporate.form_configure_dns_title') }}</h6>
                                </div>
                                <div class="card-body">
                                    <div class="form-group mb-3">
                                        <label for="existingDomain" class="form-label">{{ __('email_corporate.form_existing_domain_lbl') }}</label>
                                        <input type="text" class="form-control" id="existingDomain" name="existing_domain" 
                                               placeholder="{{ __('email_corporate.form_existing_domain_ph') }}">
                                    </div>
                                    
                                    <div class="alert alert-info">
                                        <h6><i class="fas fa-info-circle me-2"></i>{{ __('email_corporate.form_dns_required') }}</h6>
                                        <p class="mb-2">{{ __('email_corporate.form_dns_text') }}</p>
                                        <div class="bg-dark text-light p-3 rounded">
                                            <code class="d-block mb-1">ns1.aywsolution.com</code>
                                            <code class="d-block">ns2.aywsolution.com</code>
                                        </div>
                                        <p class="mt-2 mb-0 small">
                                            {{ __('email_corporate.form_dns_guide') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="alert alert-info mb-4">
                            <h6><i class="fas fa-info-circle me-2"></i>{{ __('email_corporate.form_process_title') }}</h6>
                            <p class="mb-0 small">
                                {{ __('email_corporate.form_process_1') }}<br>
                                {{ __('email_corporate.form_process_2') }}<br>
                                {{ __('email_corporate.form_process_3') }}<br>
                                {{ __('email_corporate.form_process_4') }}<br>
                                {{ __('email_corporate.form_process_5') }}
                            </p>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="name" class="form-label">{{ __('email_corporate.form_full_name') }}</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="company" class="form-label">{{ __('email_corporate.form_company') }}</label>
                                    <input type="text" class="form-control" id="company" name="company" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="email" class="form-label">{{ __('email_corporate.form_email') }}</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="phone" class="form-label">{{ __('email_corporate.form_phone') }}</label>
                                    <input type="text" class="form-control" id="phone" name="phone" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group mb-3" id="domainFieldContainer">
                            <label for="domain" class="form-label">{{ __('email_corporate.form_domain_label') }}</label>
                            <input type="text" class="form-control" id="domain" name="domain" required>
                            <small class="text-muted">{{ __('email_corporate.form_domain_hint') }}</small>
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="currentService" class="form-label">{{ __('email_corporate.form_current_service') }}</label>
                            <select class="form-control" id="currentService" name="current_service">
                                <option value="">{{ __('email_corporate.form_select') }}</option>
                                <option value="none">{{ __('email_corporate.form_no_service') }}</option>
                                <option value="gmail">{{ __('email_corporate.form_gmail_service') }}</option>
                                <option value="other">{{ __('email_corporate.form_other_service') }}</option>
                            </select>
                        </div>
                        
                        <div class="form-group mb-4">
                            <label for="message" class="form-label">{{ __('email_corporate.form_comments') }}</label>
                            <textarea class="form-control" id="message" name="message" rows="3" placeholder="{{ __('email_corporate.form_comments_ph') }}"></textarea>
                        </div>
                        
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('email_corporate.form_cancel') }}</button>
                            <button type="submit" class="default-btn" id="submitBtn">
                                <i class="fas fa-paper-plane me-2"></i>{{ __('email_corporate.form_submit') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Contact Form Modal -->
@endsection


@section('script_footer')

<script>
    // Translation strings passed from Blade
    const ec = {
        domain_available:      @json(__('email_corporate.domain_available')),
        domain_unavailable:    @json(__('email_corporate.domain_unavailable')),
        domain_already_reg:    @json(__('email_corporate.domain_already_reg')),
        domain_try_other:      @json(__('email_corporate.domain_try_other')),
        per_year:              @json(__('email_corporate.per_year')),
        btn_select:            @json(__('email_corporate.btn_select')),
        price_label:           @json(__('email_corporate.price_label')),
        domain_selected_alert: @json(__('email_corporate.domain_selected_alert')),
        enter_domain_name:     @json(__('email_corporate.enter_domain_name')),
        min_2_chars:           @json(__('email_corporate.min_2_chars')),
        invalid_format:        @json(__('email_corporate.invalid_format')),
        conn_error:            @json(__('email_corporate.conn_error')),
        select_domain_first:   @json(__('email_corporate.select_domain_first')),
        enter_existing_domain: @json(__('email_corporate.enter_existing_domain')),
        invalid_domain_format: @json(__('email_corporate.invalid_domain_format')),
        sending:               @json(__('email_corporate.sending')),
        form_submit:           @json(__('email_corporate.form_submit')),
        modal_trial_title:     @json(__('email_corporate.modal_trial_title')),
        modal_contract_title:  @json(__('email_corporate.modal_contract_title')),
        trial_process_title:   @json(__('email_corporate.trial_process_title')),
        trial_process_steps:   @json(__('email_corporate.trial_process_steps')),
        domain_invalid_alert:  @json(__('email_corporate.domain_invalid_alert')),
        success_message:       @json(__('email_corporate.success_message')),
        error_message:         @json(__('email_corporate.error_message')),
    };

    // CSRF Token para AJAX
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Precios de dominios por TLD (en Euros)
    const domainPrices = {
        '.com': { eur: 10.99, soles: 45.10 },
        '.net': { eur: 11.99, soles: 49.20 },
        '.org': { eur: 11.99, soles: 49.20 },
        '.pe': { eur: 35.00, soles: 143.50 },
        '.com.pe': { eur: 25.00, soles: 102.50 },
        '.io': { eur: 39.99, soles: 164.00 },
        '.co': { eur: 29.99, soles: 123.00 },
        '.info': { eur: 9.99, soles: 41.00 },
        '.biz': { eur: 9.99, soles: 41.00 }
    };

    // Tasa de cambio EUR a PEN (aproximada)
    const exchangeRate = 4.10;

    // Generar UUID v4 para x-request-id
    function generateUuid4() {
        return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
            const r = Math.random() * 16 | 0;
            const v = c === 'x' ? r : (r & 0x3 | 0x8);
            return v.toString(16);
        });
    }

    // Cambiar entre dominio nuevo/existente
    document.querySelectorAll('input[name="domain_type"]').forEach(radio => {
        radio.addEventListener('change', function() {
            if (this.value === 'new') {
                document.getElementById('newDomainSection').style.display = 'block';
                document.getElementById('existingDomainSection').style.display = 'none';
                document.getElementById('domainFieldContainer').style.display = 'none';
                document.getElementById('domain').value = '';
                document.getElementById('existingDomain').required = false;
                document.getElementById('domain').required = true;
            } else {
                document.getElementById('newDomainSection').style.display = 'none';
                document.getElementById('existingDomainSection').style.display = 'block';
                document.getElementById('domainFieldContainer').style.display = 'block';
                document.getElementById('domain').value = '';
                document.getElementById('selectedDomainInfo').style.display = 'none';
                document.getElementById('existingDomain').required = true;
                document.getElementById('domain').required = false;
            }
        });
    });

    // Buscar dominio
    document.getElementById('btnSearchDomain').addEventListener('click', searchDomain);
    document.getElementById('domainSearch').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            searchDomain();
        }
    });

    async function searchDomain() {
        const keyword = document.getElementById('domainSearch').value.trim();
        const tld = document.getElementById('domainTld').value;
        
        if (!keyword) {
            showAlert(ec.enter_domain_name, 'warning');
            return;
        }
        
        if (keyword.length < 2) {
            showAlert(ec.min_2_chars, 'warning');
            return;
        }
        
        const domainToCheck = keyword + tld;
        
        // Validar formato básico
        if (!isValidDomainFormat(domainToCheck)) {
            showAlert(ec.invalid_format, 'warning');
            return;
        }
        
        // Limpiar resultados anteriores
        hideElement('domainResults');
        hideElement('domainSuggestions');
        showElement('domainLoading');
        
        try {
            const response = await fetch('/api/domain/check', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ 
                    domain: domainToCheck,
                    x_request_id: generateUuid4() // Enviamos nuestro UUID
                })
            });
            
            const result = await response.json();
            hideElement('domainLoading');
            
            if (result.success) {
                showDomainResult(result);
                
                // Si el dominio no está disponible, mostrar sugerencias
                if (!result.available) {
                    getDomainSuggestions(keyword);
                }
            } else {
                showError(result.message || 'Error al verificar el dominio');
            }
            
        } catch (error) {
            console.error('Error en búsqueda:', error);
            hideElement('domainLoading');
            showError(ec.conn_error);
        }
    }

    function showDomainResult(result) {
        showElement('domainResults');
        const domainResultContent = document.getElementById('domainResultContent');
        
        if (result.available) {
            const priceInfo = domainPrices[result.tld] || domainPrices['.com'];
            
            domainResultContent.innerHTML = `
                <div class="alert alert-success animate__animated animate__fadeIn">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-1"><i class="fas fa-check-circle me-2"></i>${ec.domain_available}</h6>
                            <p class="mb-1"><strong>${result.domain}</strong></p>
                            <p class="mb-0">
                                <span class="badge bg-primary me-2">€${priceInfo.eur.toFixed(2)}</span>
                                <span class="badge bg-success">S/ ${priceInfo.soles.toFixed(2)}</span>
                                <small class="text-muted ms-2">${ec.per_year}</small>
                            </p>
                        </div>
                        <button class="btn btn-success" onclick="selectDomain('${result.domain}', ${priceInfo.eur}, ${priceInfo.soles})">
                            <i class="fas fa-cart-plus me-2"></i>${ec.btn_select}
                        </button>
                    </div>
                </div>
            `;
        } else {
            domainResultContent.innerHTML = `
                <div class="alert alert-danger animate__animated animate__fadeIn">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-times-circle me-3 fs-4"></i>
                        <div>
                            <h6 class="mb-1">${ec.domain_unavailable}</h6>
                            <p class="mb-0"><strong>${result.domain}</strong> ${ec.domain_already_reg}</p>
                            <p class="mb-0 small mt-1">${ec.domain_try_other}</p>
                        </div>
                    </div>
                </div>
            `;
        }
    }

    async function getDomainSuggestions(keyword) {
        try {
            const popularTlds = ['.com', '.net', '.org', '.pe', '.com.pe', '.io', '.co', '.info'];
            const suggestions = [];
            
            // Verificar disponibilidad para cada TLD popular
            for (const tld of popularTlds) {
                const domain = keyword + tld;
                
                const response = await fetch('/api/domain/check', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ 
                        domain: domain,
                        x_request_id: generateUuid4()
                    })
                });
                
                const result = await response.json();
                
                if (result.success && result.available) {
                    const priceInfo = domainPrices[tld] || domainPrices['.com'];
                    suggestions.push({
                        domain: domain,
                        price_eur: priceInfo.eur,
                        price_soles: priceInfo.soles,
                        tld: tld
                    });
                    
                    // Limitar a 4 sugerencias
                    if (suggestions.length >= 4) break;
                }
            }
            
            if (suggestions.length > 0) {
                showSuggestions(suggestions);
            }
            
        } catch (error) {
            console.error('Error obteniendo sugerencias:', error);
        }
    }

    function showSuggestions(suggestions) {
        const suggestionsList = document.getElementById('suggestionsList');
        suggestionsList.innerHTML = '';
        
        suggestions.forEach(suggestion => {
            const col = document.createElement('div');
            col.className = 'col-md-6 mb-2';
            col.innerHTML = `
                <div class="card border-success animate__animated animate__fadeInUp">
                    <div class="card-body p-2">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <span class="fw-bold">${suggestion.domain}</span>
                                <small class="d-block text-muted">
                                    €${suggestion.price_eur.toFixed(2)} (S/ ${suggestion.price_soles.toFixed(2)}) / año
                                </small>
                            </div>
                            <button class="btn btn-sm btn-outline-success" 
                                    onclick="selectDomain('${suggestion.domain}', ${suggestion.price_eur}, ${suggestion.price_soles})">
                                <i class="fas fa-check"></i>
                            </button>
                        </div>
                    </div>
                </div>
            `;
            suggestionsList.appendChild(col);
        });
        
        showElement('domainSuggestions');
    }

    function selectDomain(domain, priceEur, priceSoles) {
        document.getElementById('selectedDomainText').textContent = domain;
        document.getElementById('selectedDomainPrice').textContent = 
            `${ec.price_label}: €${priceEur.toFixed(2)} (S/ ${priceSoles.toFixed(2)}) ${ec.per_year}`;
        document.getElementById('selectedDomainInput').value = domain;
        document.getElementById('domain').value = domain;
        showElement('selectedDomainInfo');
        
        // Scroll suave a la sección del dominio seleccionado
        document.getElementById('selectedDomainInfo').scrollIntoView({ 
            behavior: 'smooth', 
            block: 'nearest' 
        });
        
        // Mostrar notificación
        showAlert(`${ec.domain_selected_alert} "${domain}"`, 'success');
    }

    function clearDomainSelection() {
        hideElement('selectedDomainInfo');
        document.getElementById('selectedDomainInput').value = '';
        document.getElementById('domain').value = '';
    }

    function showError(message) {
        showElement('domainResults');
        const domainResultContent = document.getElementById('domainResultContent');
        
        domainResultContent.innerHTML = `
            <div class="alert alert-warning animate__animated animate__shakeX">
                <i class="fas fa-exclamation-triangle me-2"></i>${message}
            </div>
        `;
    }

    function showAlert(message, type = 'info') {
        const alertClass = {
            'success': 'alert-success',
            'warning': 'alert-warning',
            'danger': 'alert-danger',
            'info': 'alert-info'
        }[type] || 'alert-info';
        
        const alertId = 'temp-alert-' + Date.now();
        const alertHTML = `
            <div id="${alertId}" class="alert ${alertClass} alert-dismissible fade show position-fixed top-0 end-0 m-3" style="z-index: 9999; max-width: 300px;">
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        `;
        
        document.body.insertAdjacentHTML('beforeend', alertHTML);
        
        // Auto-remover después de 5 segundos
        setTimeout(() => {
            const alert = document.getElementById(alertId);
            if (alert) {
                alert.remove();
            }
        }, 5000);
    }

    function isValidDomainFormat(domain) {
        const pattern = /^[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,}$/i;
        return pattern.test(domain);
    }

    function showElement(elementId) {
        const element = typeof elementId === 'string' ? document.getElementById(elementId) : elementId;
        if (element) element.style.display = 'block';
    }

    function hideElement(elementId) {
        const element = typeof elementId === 'string' ? document.getElementById(elementId) : elementId;
        if (element) element.style.display = 'none';
    }

    // Validación del formulario
    document.getElementById('serviceContactForm').addEventListener('submit', function(e) {
        const domainType = document.querySelector('input[name="domain_type"]:checked').value;
        const submitBtn = document.getElementById('submitBtn');
        
        if (domainType === 'new') {
            const selectedDomain = document.getElementById('selectedDomainInput').value;
            if (!selectedDomain) {
                e.preventDefault();
                showAlert(ec.select_domain_first, 'warning');
                return false;
            }
        }
        
        if (domainType === 'existing') {
            const existingDomain = document.getElementById('existingDomain').value.trim();
            if (!existingDomain) {
                e.preventDefault();
                showAlert(ec.enter_existing_domain, 'warning');
                return false;
            }
            
            if (!isValidDomainFormat(existingDomain)) {
                e.preventDefault();
                showAlert(ec.invalid_domain_format, 'warning');
                return false;
            }
        }
        
        // Deshabilitar botón para evitar múltiples envíos
        submitBtn.disabled = true;
        submitBtn.innerHTML = `<i class="fas fa-spinner fa-spin me-2"></i>${ec.sending}`;
        
        return true;
    });


    
    // Resetear botón si el formulario no se envía
    document.getElementById('serviceContactForm').addEventListener('change', function() {
        const submitBtn = document.getElementById('submitBtn');
        if (submitBtn.disabled) {
            submitBtn.disabled = false;
            submitBtn.innerHTML = `<i class="fas fa-paper-plane me-2"></i>${ec.form_submit}`;
        }
    });
</script>



<script>
    function selectPlan(planId, planName, type = 'contract') {
        // Actualizar campos ocultos
        document.getElementById('selectedPlan').value = planId;
        document.getElementById('requestType').value = type;
        
        // Actualizar título del modal según el tipo
        const modalTitle = document.getElementById('contactModalLabel');
        if (type === 'trial') {
            modalTitle.textContent = ec.modal_trial_title + ' - ' + planName;
        } else {
            modalTitle.textContent = ec.modal_contract_title + ' - ' + planName;
        }
        
        // Mostrar información en el formulario
        const infoAlert = document.querySelector('.alert-info h6');
        if (type === 'trial') {
            infoAlert.innerHTML = '<i class="fas fa-info-circle me-2"></i>' + ec.trial_process_title;
            document.querySelector('.alert-info p').innerHTML = ec.trial_process_steps;
        }
    }
    
    // Manejar envío del formulario
    document.getElementById('serviceContactForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Validación básica
        const domain = document.getElementById('domain').value;
        if (!domain.includes('.')) {
            alert(ec.domain_invalid_alert);
            return false;
        }
        
        // Enviar formulario
        const formData = new FormData(this);
        
        fetch(this.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(ec.success_message);
                // Cerrar modal
                const modal = bootstrap.Modal.getInstance(document.getElementById('contactModal'));
                modal.hide();
                // Limpiar formulario
                this.reset();
            } else {
                alert(ec.error_message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert(ec.error_message);
        });
    });
</script>

@if(session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        alert('{{ session('success') }}');
    });
</script>
@endif
@endsection 