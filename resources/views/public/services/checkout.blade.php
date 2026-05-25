@extends('bases.public_home')

@section('public_contenido')
<div class="page-title-area">
    <div class="d-table">
        <div class="d-table-cell">
            <div class="container">
                <div class="page-title-content">
                    <h2>{{ __('services.checkout_title') }}</h2>
                    <ul>
                        <li><a href="{{ route('inicio') }}">{{ __('services.home') }}</a></li>
                        <li><a href="{{ route('public.services.index') }}">{{ __('services.breadcrumbs_services') }}</a></li>
                        <li>{{ $servicePlan->name }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="contact-section pt-100 pb-70">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-5">
                <div class="single-contact-info-box">
                    <h4 class="mb-3">{{ __('services.plan_summary') }}</h4>
                    <p><strong>Plan:</strong> {{ $servicePlan->name }}</p>
                    <p><strong>{{ __('services.type') }}:</strong> {{ \Illuminate\Support\Str::headline(str_replace('-', ' ', $servicePlan->type)) }}</p>
                    <p><strong>{{ __('services.price') }}:</strong> S/. {{ number_format($servicePlan->price, 2) }}</p>
                    <p><strong>{{ __('services.billing_cycle') }}:</strong> {{ $servicePlan->billing_cycle === 'yearly' ? __('services.yearly') : __('services.monthly') }}</p>
                    @if($servicePlan->description)
                    <p>{{ $servicePlan->description }}</p>
                    @endif
                    @if(!empty($servicePlan->features))
                    <ul>
                        @foreach($servicePlan->features as $feature)
                        <li>{{ $feature }}</li>
                        @endforeach
                    </ul>
                    @endif
                </div>
            </div>

            <div class="col-lg-7">
                <div class="contact-form">
                    <h3 class="mb-3">{{ __('services.complete_data') }}</h3>

                    @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form action="{{ route('public.services.checkout.store', $servicePlan) }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label d-block">{{ __('services.request_type') }}</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="account_mode" id="mode_register" value="register" {{ old('account_mode', 'register') === 'register' ? 'checked' : '' }}>
                                <label class="form-check-label" for="mode_register">{{ __('services.new_customer') }}</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="account_mode" id="mode_login" value="login" {{ old('account_mode') === 'login' ? 'checked' : '' }}>
                                <label class="form-check-label" for="mode_login">{{ __('services.existing_customer') }}</label>
                            </div>
                        </div>

                        <div id="register_fields" style="display: {{ old('account_mode', 'register') === 'register' ? 'block' : 'none' }};">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">{{ __('services.full_name') }} *</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">{{ __('services.company') }} *</label>
                                <input type="text" name="company" class="form-control" value="{{ old('company') }}" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">{{ __('services.email') }} *</label>
                                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">{{ __('services.confirm_email') }} *</label>
                                <input type="email" name="email_confirmation" class="form-control" value="{{ old('email_confirmation') }}" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">{{ __('services.phone') }} *</label>
                                <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">{{ __('services.service_name') }} *</label>
                                <input type="text" name="service_name" class="form-control" value="{{ old('service_name', $servicePlan->name) }}" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">{{ __('services.password') }} *</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">{{ __('services.confirm_password') }} *</label>
                                <input type="password" name="password_confirmation" class="form-control" required>
                            </div>
                        </div>
                        </div>

                        <div id="login_fields" style="display: {{ old('account_mode') === 'login' ? 'block' : 'none' }};">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">{{ __('services.account_email') }} *</label>
                                    <input type="email" name="login_email" class="form-control" value="{{ old('login_email') }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">{{ __('services.password') }} *</label>
                                    <input type="password" name="login_password" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">{{ __('services.domain_optional') }}</label>
                            <input type="text" name="domain" class="form-control" value="{{ old('domain') }}" placeholder="midominio.com">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">{{ __('services.payment_method') }} *</label>
                            <select name="payment_method_id" id="payment_method_id" class="form-select" required>
                                <option value="">{{ __('services.select_option') }}</option>
                                @foreach($paymentMethods as $method)
                                <option value="{{ $method->id }}" data-instructions="{{ e($method->instructions ?? '') }}" data-qr="{{ $method->qr_image_url ?? '' }}" @selected(old('payment_method_id') == $method->id)>
                                    {{ $method->name }} ({{ strtoupper($method->type) }})
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div id="payment_help" class="alert alert-info" style="display:none;"></div>

                        <div id="payment_qr_box" class="mb-3 text-center" style="display:none;">
                            <img id="payment_qr_img" src="" alt="QR" style="max-width:220px;width:100%;border:1px solid #ddd;border-radius:8px;">
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="auto_renew" value="1" id="auto_renew" checked>
                            <label class="form-check-label" for="auto_renew">{{ __('services.auto_renew') }}</label>
                        </div>

                        <div class="form-check mb-4">
                            <input class="form-check-input" type="checkbox" name="terms" id="terms" value="1" required>
                            <label class="form-check-label" for="terms">{{ __('services.accept_terms') }}</label>
                        </div>

                        <button type="submit" class="default-btn">
                            {{ old('account_mode', 'register') === 'login' ? __('services.submit_request_plan') : __('services.submit_register_request') }}
                            <span></span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('script_footer')
<script>
(function () {
    const modeRegister = document.getElementById('mode_register');
    const modeLogin = document.getElementById('mode_login');
    const registerFields = document.getElementById('register_fields');
    const loginFields = document.getElementById('login_fields');
    const select = document.getElementById('payment_method_id');
    const help = document.getElementById('payment_help');
    const qrBox = document.getElementById('payment_qr_box');
    const qrImg = document.getElementById('payment_qr_img');

    function toggleModeFields() {
        const isRegister = modeRegister.checked;
        registerFields.style.display = isRegister ? 'block' : 'none';
        loginFields.style.display = isRegister ? 'none' : 'block';
    }

    function refreshPaymentInfo() {
        const option = select.options[select.selectedIndex];
        if (!option || !option.value) {
            help.style.display = 'none';
            qrBox.style.display = 'none';
            qrImg.src = '';
            return;
        }

        const instructions = option.getAttribute('data-instructions') || '';
        const qr = option.getAttribute('data-qr') || '';

        if (instructions.trim() !== '') {
            help.textContent = instructions;
            help.style.display = 'block';
        } else {
            help.style.display = 'none';
        }

        if (qr.trim() !== '') {
            qrImg.src = qr;
            qrBox.style.display = 'block';
        } else {
            qrBox.style.display = 'none';
            qrImg.src = '';
        }
    }

    modeRegister.addEventListener('change', toggleModeFields);
    modeLogin.addEventListener('change', toggleModeFields);
    toggleModeFields();

    select.addEventListener('change', refreshPaymentInfo);
    refreshPaymentInfo();
})();
</script>
@endsection
