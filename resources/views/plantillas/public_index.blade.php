@extends('bases.public_home')

@section('public_contenido')
	<!-- Start Home Section -->
	<div class="home-area">
		<div class="d-table">
			<div class="d-table-cell">
				<div class="container">
					<div class="row align-items-center">
						<div class="col-lg-6 col-md-12">
							<div class="main-banner-content">
								<h1>{{ __('home.hero_title') }}</h1>
								<p>{{ __('home.hero_text') }}</p>
								<div class="banner-btn">
									<a class="default-btn-one" href="">{{ __('home.hero_services') }} <span></span></a>
									{{-- <a class="default-btn-two" href="{{route('contacto.index')}}">Contact US <span></span></a> --}}
									{{-- <a class="default-btn-two" target="_blank" href="https://wa.me/51980534198"><img src="../../assets/img/icon/whatsapp-fill.png" alt="">{{ __('home.hero_whatsapp') }}<span></span></a> --}}
									{{-- <a class="default-btn-two" href="https://m.me/TU_USUARIO_O_ID_DE_PAGINA" target="_blank" class="btn btn-primary">
									💬 Chat Messenger
									</a> --}}

								</div>
							</div>
						</div>
						<div class="col-lg-6 col-md-12">
							<div class="banner-image">
								<img src="assets/img/home-font.png" alt="image">
							</div>
                        </div>
					</div>
				</div>
			</div>
		</div>
		<div class="creative-shape">
            <img src="assets/img/home-bottom-shape.png" alt="svg shape">
        </div>
	</div>
	<!-- End Home Section -->
	
	<!-- Start Feature Section -->
    <section class="feature-section pt-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="feature-single-item">
                        <img src="../../../assets/img/icon/feature-icon-1.svg" alt="icon">
						<h3>{{ __('home.feature_1_title') }}</h3>
						<p>{{ __('home.feature_1_text') }}</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-single-item">
                        <img src="../../../assets/img/icon/feature-icon-2.svg" alt="icon">
						<h3>{{ __('home.feature_2_title') }}</h3>
						<p>{{ __('home.feature_2_text') }}</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-single-item">
                        <img src="../../../assets/img/icon/feature-icon-3.svg" alt="icon">
						<h3>{{ __('home.feature_3_title') }}</h3>
						<p>{{ __('home.feature_3_text') }}</p>
						
                    </div>
                </div>
            </div>
        </div>
    </section>
	<!-- End Feature Section -->
	
	<!-- Start About Section -->
	<section class="about-area section-padding">
		<div class="container">
			<div class="row d-flex align-items-center">
				<div class="col-lg-6 col-md-12">
					<div class="about-content">
						<h6 class="sub-title">{{ __('home.about_company') }}</h6> 
						<h2>{{ __('home.about_title') }}</h2>
						<p>{{ __('home.about_intro') }}</p>
						<div class="skills">
							<div class="skill-item">
								<h6>{{ __('home.about_service_1') }}, <em> </em></h6>
								<div class="skill-progress">
									<div class="progres" data-value="100%"></div>
								</div>
							</div>
							<div class="skill-item">
								<h6>{{ __('home.about_service_2') }}<em> </em></h6>
								<div class="skill-progress">
									<div class="progres" data-value="100%"></div>
								</div>
							</div>
							<div class="skill-item">
								<h6>{{ __('home.about_service_3') }}<em> </em></h6>
								<div class="skill-progress">
									<div class="progres" data-value="100%"></div>
								</div>
							</div>
						</div>
						<div class="about-btn-box"> 
							<a class="default-btn" href="">{{ __('home.about_contact') }}<span></span></a>
						</div>
					</div>
				</div>
				<div class="col-lg-6 col-md-12">
					<div class="about-image">
						<img src="../../../assets/img/about.jpg" alt="About image">
						{{-- <div class="years-design">
							<h2>5</h2>
							<h5>Years Of Experience</h5>
                        </div> --}}
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- End About Section -->
	
	
	
	<!-- Start Hire Section -->
	<section class="hire-section">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 col-md-12">
					<div class="hire-content">
						{{-- <h6 class="sub-title">Quieres trabajar con nosotros</h6> --}}
						<h2>{{ __('home.hire_title') }}</h2>
						<p>{{ __('home.hire_text') }}</p>
						<div class="hire-btn">
							{{-- <a class="default-btn" href="tel:12345678">Call Now<span></span></a> --}}
							<a class="default-btn-one" href="{{route('contacto.index')}}">{{ __('home.hire_contact') }}<span></span></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- End Hire Section -->
	

	
	<!-- Start Footer & Subscribe Section -->
	<section class="footer-subscribe-wrapper">
		<!-- Start Subscribe Section -->
		<div class="subscribe-area">
			<div class="container">
				<div class="row align-items-center">
					<div class="col-lg-6 col-md-6">
						<div class="subscribe-content">
							<h2>Sign Up Our Newsletter</h2>
							<p>We Offer An Informative Monthly Technology Newsletter - Check It Out.</p>
						</div>
					</div>
					<div class="col-lg-6 col-md-6">
						<form class="newsletter-form">
							<input type="email" class="input-newsletter" name="email" placeholder="Enter Your Email" required autocomplete="off">
							<button type="submit">Subscribe Now</button>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- End Subscribe Section -->
		<!-- Start Footer Section -->
		<div class="footer-area ptb-100">
			<div class="container">
				<div class="row">
					<div class="col-lg-4 col-md-6 col-sm-6">
						<div class="single-footer-widget">
							<a class="footer-logo" href="#">
								<img src="../../../assets/img/logo.png" class="white-logo" alt="logo">
							</a>
							<p>We are a company dedicated to Information Technology solutions and process improvements.</p>
							<ul class="footer-social">
								<li>
									<a href="#"> <i class="fab fa-facebook-f"></i></a>
								</li>
								<li>
									<a href="#"> <i class="fab fa-twitter"></i></a>
								</li>
								<li>
									<a href="#"> <i class="fab fa-youtube"></i></a>
								</li>
								<li>
									<a href="#"> <i class="fab fa-linkedin"></i></a>
								</li>
							</ul>
						</div>
					</div>
					<div class="col-lg-2 col-md-6 col-sm-6">
						<div class="single-footer-widget">
							<div class="footer-heading">
								<h3>Our Services</h3>
							</div>
							<ul class="footer-quick-links">
								<li><a href="#">It Consulting</a></li>
								<li><a href="#">Software Development</a></li>
								<li><a href="#">Process automation</a></li>
								<li><a href="{{asset('courses/index')}}">Courses</a></li>
							</ul>
						</div>
					</div>
					
					<div class="col-lg-4 col-md-6 col-sm-6">
						<div class="single-footer-widget">
							<div class="footer-heading">
								<h3>Contact Info</h3>
							</div>
							<div class="footer-info-contact">
								<i class="flaticon-phone-call"></i>
								<h3>Phone</h3>
								<span><a href="">+51 980534198</a></span>
							</div>
							<div class="footer-info-contact">
								<i class="flaticon-envelope"></i>
								<h3>Email</h3>
								<span><a href="">info@aywsolution.com</a></span>
							</div>
							<div class="footer-info-contact">
								<i class="flaticon-placeholder"></i>
								<h3>Address</h3>
								<span>Perú, </span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End Footer Section -->
	</section>
	<!-- End Footer & Subscribe Section -->
	
	<!-- Start Copy Right Section -->
	<div class="copyright-area">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-lg-6 col-md-6">
					<p><i class="far fa-copyright"></i> 2023 Techvio - All Rights Reserved.</p>
				</div>
				<div class="col-lg-6 col-md-6">
					<ul>
						<li><a href="terms-condition.html">Terms & Conditions</a></li>
						<li><a href="privacy-policy.html">Privacy Policy</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!-- End Copy Right Section -->
	
	<!-- Start Go Top Section -->
	<div class="go-top">
		<i class="fas fa-chevron-up"></i>
		<i class="fas fa-chevron-up"></i>
	</div>
	<!-- End Go Top Section -->
@endsection
