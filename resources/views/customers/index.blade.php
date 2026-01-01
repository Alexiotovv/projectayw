@extends('bases.public_home')
@section('script_head')
    <style>
        .clients-section {
            background-color: #f9f9f9;
        }
        .client-item {
            transition: transform 0.3s ease;
        }
        .client-item:hover {
            transform: scale(1.02);
        }
        .client-info h4 {
            font-weight: 600;
            margin-bottom: 5px;
        }
        .client-info p {
            color: #555;
            margin: 0;
        }

    </style>
@endsection
@section('public_contenido')
	<!-- Start Page Title Section -->
	<div class="page-title-area">
		<div class="d-table">
			<div class="d-table-cell">
				<div class="container">
					<div class="page-title-content">
						<h2>Contact</h2>
						<ul>
							<li><a href="{{route('inicio')}}">Home</a>
							</li>
							<li>Contact</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Page Title Section -->
	
	<!-- Start Clients Section -->
<section class="clients-section section-padding">
    <div class="container">
        <div class="section-title text-center">
            <h6 class="sub-title">They trust us</h6>
            <h2>Our Clients</h2>
        </div>

        <div class="clients-list">
            {{-- Cliente 1 (Izquierda) --}}
            <div class="client-item d-flex align-items-center mb-5 flex-row">
                <div class="client-logo me-4">
                    <img src="{{ asset('assets/img/clients/gobperu.png') }}" alt="Client 1" class="img-fluid" style="max-width:120px;">
                </div>
                <div class="client-info">
                    <h4>Regional Health Directorate of Loreto/Junín – Peru</h4>
                    <p>🔬 Development of systems for malaria registration, monitoring, and control.
                        Automation of COVID-19 patient management using Python in 2020.</p>
                </div>
            </div>

            {{-- Cliente 2 (Derecha) --}}
            <div class="client-item d-flex align-items-center mb-5 flex-row-reverse text-end">
                <div class="client-logo ms-4">
                    <img src="{{ asset('assets/img/clients/vallejo.png') }}" alt="Client 2" class="img-fluid" style="max-width:120px;">
                </div>
                <div class="client-info">
                    <h4>Cesar Vallejo Cooperative School of Iquitos</h4>
                    <p>📚 Grade management system and payment automation.</p>
                </div>
            </div>

            {{-- Cliente 3 (Izquierda) --}}
            <div class="client-item d-flex align-items-center mb-5 flex-row">
                <div class="client-logo me-4">
                    <img src="{{ asset('assets/img/clients/selvasanta.png') }}" alt="Client 3" class="img-fluid" style="max-width:120px;">
                </div>
                <div class="client-info">
                    <h4>SelvaSanta</h4>
                    <p>💧 Billing and invoicing system in the field of water treatment and distribution.</p>
                </div>
            </div>

            {{-- Cliente 4 (Derecha) --}}
            <div class="client-item d-flex align-items-center mb-5 flex-row-reverse text-end">
                <div class="client-logo ms-4">
                    <img src="{{ asset('assets/img/clients/clients.png') }}" alt="Client 4" class="img-fluid" style="max-width:120px;">
                </div>
                <div class="client-info">
                    <h4>Other Clients”</h4>
                    <p>🧬💻The staff was part of or a collaborator with NAMRU-6, the U.S. Naval Medical Research Unit for Tropical Diseases, and EMSER, a company that provides Software as a Service (SaaS) solutions in Argentina..</p>
                </div>
            </div>

            {{-- Cliente 5 (Izquierda) --}}
            {{-- <div class="client-item d-flex align-items-center mb-5 flex-row">
                <div class="client-logo me-4">
                    <img src="{{ asset('assets/img/clients/client5.png') }}" alt="Client 5" class="img-fluid" style="max-width:120px;">
                </div>
                <div class="client-info">
                    <h4>Client Five</h4>
                    <p>Retail company improving customer experience through technology.</p>
                </div>
            </div> --}}

            {{-- Cliente 6 (Derecha) --}}
            {{-- <div class="client-item d-flex align-items-center mb-5 flex-row-reverse text-end">
                <div class="client-logo ms-4">
                    <img src="{{ asset('assets/img/clients/client6.png') }}" alt="Client 6" class="img-fluid" style="max-width:120px;">
                </div>
                <div class="client-info">
                    <h4>Client Six</h4>
                    <p>Engineering firm implementing process automation systems.</p>
                </div>
            </div> --}}

            {{-- Cliente 7 (Izquierda) --}}
            {{-- <div class="client-item d-flex align-items-center mb-5 flex-row">
                <div class="client-logo me-4">
                    <img src="{{ asset('assets/img/clients/client7.png') }}" alt="Client 7" class="img-fluid" style="max-width:120px;">
                </div>
                <div class="client-info">
                    <h4>Client Seven</h4>
                    <p>Tourism company using AI to enhance customer engagement.</p>
                </div>
            </div> --}}

            {{-- Cliente 8 (Derecha) --}}
            {{-- <div class="client-item d-flex align-items-center mb-5 flex-row-reverse text-end">
                <div class="client-logo ms-4">
                    <img src="{{ asset('assets/img/clients/client8.png') }}" alt="Client 8" class="img-fluid" style="max-width:120px;">
                </div>
                <div class="client-info">
                    <h4>Client Eight</h4>
                    <p>Nonprofit organization optimizing resource management digitally.</p>
                </div>
            </div> --}}
        </div>
    </div>
</section>
<!-- End Clients Section -->	
	
	<!-- Start Hire Section -->
	<section class="hire-section">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 col-md-12">
					<div class="hire-content">
						<h2>Digitally transform and grow your business.</h2>
						<p>Gain a competitive advantage, optimize resources, implement solutions, or automate processes.</p>
						<div class="hire-btn">
							{{-- <a class="default-btn" href="tel:12345678">Call Now<span></span></a> --}}
							<a class="default-btn-one" href="">Contact<span></span></a>
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
							<p>Somos una empresa dedicada a soluciones de Tecnologías de la información y mejoras de procesos.</p>
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
								<h3>Nuestros Servicios</h3>
							</div>
							<ul class="footer-quick-links">
								<li><a href="#">Soluciones TI</a></li>
								<li><a href="#">Desarrollo de Software</a></li>
								<li><a href="#">Automatización de Procesos</a></li>
								<li><a href="#">Ciberseguridad</a></li>
								
							</ul>
						</div>
					</div>
					{{-- <div class="col-lg-2 col-md-6 col-sm-6">
						<div class="single-footer-widget">
							<div class="footer-heading">
								<h3>Useful Links</h3>
							</div>
							<ul class="footer-quick-links">
								<li><a href="about.html">About Us</a></li>
								<li><a href="portfolio.html">Case Study</a></li>
								<li><a href="contact.html">Contact Us</a></li>
								<li><a href="privacy-policy.html">Privacy Policy</a></li>
								<li><a href="terms-condition.html">Terms & Conditions</a></li>
							</ul>
						</div>
					</div> --}}
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
								<span>Perú,</span>
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

@section('script_footer')
    <script src="https://www.google.com/recaptcha/api.js"></script>
	<script>
        
		function onSubmit(token) {
			document.getElementById("contact-form").submit();
		}
	</script>
@endsection