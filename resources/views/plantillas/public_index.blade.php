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
								<h1>AYW Servicios y Soluciones a companías de Negocios</h1>
								<p>Ofrecemos servicios de innovación tecnológica y transformación digital.</p>
								<div class="banner-btn">
									<a class="default-btn-one" href="">Nuestro Servicios <span></span></a>
									<a class="default-btn-two" href="">Contáctanos <span></span></a>
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
                        <h3>Asesoramos & Guiamos</h3>
                        <p>Nuestro compromiso es más que un vínculo, es conexión.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-single-item">
                        <img src="../../../assets/img/icon/feature-icon-2.svg" alt="icon">
                        <h3>Equipo Dedicado</h3>
                        <p>Tenemos un equipo de expertos dedicado a solucionar problemas complejos.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-single-item">
                        <img src="../../../assets/img/icon/feature-icon-3.svg" alt="icon">
                        <h3>Enfocados a Negocios</h3>
                        <p>Tu crecimiento es nuestro placer para que sigas creciendo.</p>
						
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
						<h6 class="sub-title">Nuestra Companía</h6> 
						<h2>Brindar a su empresa un servicio de TI de calidad es nuestra pasión.</h2>
						<p>Algunos de nuestros servicios son:</p>
						<div class="skills">
							<div class="skill-item">
								<h6>Consultoría de TI <em> </em></h6>
								<div class="skill-progress">
									<div class="progres" data-value="100%"></div>
								</div>
							</div>
							<div class="skill-item">
								<h6>Desarrollo de Software<em> </em></h6>
								<div class="skill-progress">
									<div class="progres" data-value="100%"></div>
								</div>
							</div>
							<div class="skill-item">
								<h6>Automatizaciones<em> </em></h6>
								<div class="skill-progress">
									<div class="progres" data-value="100%"></div>
								</div>
							</div>
						</div>
						<div class="about-btn-box"> 
							<a class="default-btn" href="">Contactar <span></span></a>
						</div>
					</div>
				</div>
				<div class="col-lg-6 col-md-12">
					<div class="about-image">
						<img src="../../../assets/img/about.jpg" alt="About image">
						<div class="years-design">
							<h2>23</h2>
							<h5>Years Of Experience</h5>
                        </div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- End About Section -->
	
	<!-- Start Counter Section -->
	{{-- <section class="counter-area section-padding">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-6 counter-item">
					<div class="single-counter">
						<div class="counter-contents">
							<h2>
								<span class="counter-number">23</span>
								<span>+</span>
							</h2>
							<h3 class="counter-heading">Years Helping Business</h3>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-6 counter-item">
					<div class="single-counter">
						<div class="counter-contents">
							<h2>
								<span class="counter-number">250</span>
								<span>+</span>
							</h2>
							<h3 class="counter-heading">Working Employees</h3>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-6 counter-item">
					<div class="single-counter">
						<div class="counter-contents">
							<h2>
								<span class="counter-number">4500</span>
								<span>+</span>
							</h2>
							<h3 class="counter-heading">Complete Projects</h3>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-6 counter-item">
					<div class="single-counter">
						<div class="counter-contents">
							<h2>
								<span class="counter-number">3000</span>
								<span>+</span>
							</h2>
							<h3 class="counter-heading">Happy Customers</h3>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section> --}}
	<!-- End Counter Section -->
	
	<!-- Start Services Section -->
	{{-- <section class="services-section section-padding">
		<div class="container">
			<div class="row">
                <div class="col-md-12">
					<div class="section-title">
						<h6 class="sub-title">What We Provide</h6>
						<h2>Our Services</h2>
					</div>
                </div>
				<div class="col-lg-4 col-md-6">
					<div class="single-services-item">
						<div class="services-icon">
							<i class="flaticon-project-management"></i>
						</div>
						<h3>IT Solution</h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt dolore magna aliqua</p>
						<div class="services-btn">
							<a href="#" class="read-more"><i class="bi bi-arrow-right-short"></i> Read More</a>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6">
					<div class="single-services-item">
						<div class="services-icon">
							<i class="flaticon-development"></i>
						</div>
						<h3>Web Development</h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt dolore magna aliqua</p>
						<div class="services-btn">
							<a href="#" class="read-more"><i class="bi bi-arrow-right-short"></i> Read More</a>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6">
					<div class="single-services-item">
						<div class="services-icon">
							<i class="flaticon-analytics"></i>
						</div>
						<h3>Startup Solutions</h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt dolore magna aliqua</p>
						<div class="services-btn">
							<a href="#" class="read-more"><i class="bi bi-arrow-right-short"></i> Read More</a>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6">
					<div class="single-services-item">
						<div class="services-icon">
							<i class="flaticon-cpu-1"></i>
						</div>
						<h3>Networking Services</h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt dolore magna aliqua</p>
						<div class="services-btn">
							<a href="#" class="read-more"><i class="bi bi-arrow-right-short"></i> Read More</a>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6">
					<div class="single-services-item">
						<div class="services-icon">
							<i class="flaticon-coding"></i>
						</div>
						<h3>SEO Optimization</h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt dolore magna aliqua</p>
						<div class="services-btn">
							<a href="#" class="read-more"><i class="bi bi-arrow-right-short"></i> Read More</a>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6">
					<div class="single-services-item">
						<div class="services-icon">
							<i class="flaticon-mobile-app"></i>
						</div>
						<h3>Apps Development</h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt dolore magna aliqua</p>
						<div class="services-btn">
							<a href="#" class="read-more"><i class="bi bi-arrow-right-short"></i> Read More</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section> --}}
	<!-- End Services Section -->
	
	<!-- Start Portfolio Section -->
    {{-- <section class="portfolio-area bg-grey section-padding">
        <div class="container">
            <div class="row">
				<div class="col-md-12">
					<div class="section-title">
						<h6 class="sub-title">Recent Works</h6>
						<h2>Our Portfolio</h2>
					</div>
				</div>
                <div class="col-md-12">
                    <div class="portfolio-list">
                        <ul class="nav" id="portfolio-flters">
                            <li class="filter filter-active" data-filter=".all">all</li>
                            <li class="filter" data-filter=".branding">branding</li>
                            <li class="filter" data-filter=".application">application</li>
                            <li class="filter" data-filter=".webdesign">web design</li>
                            <li class="filter" data-filter=".photography">photography</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="portfolio-container">
				<div class="row">
                    <!-- portfolio-item -->
                    <div class="col-lg-4 col-md-6 portfolio-grid-item all branding">
                        <div class="portfolio-item">
							<img src="../../../assets/img/portfolio/portfolio-1.jpg" alt="image">
                            <div class="portfolio-content-overlay">
								<p>App Store | Social Media</p>
								<h3><a href="single-portfolio.html">Creative Web Design</a></h3>
                            </div>
                        </div>
                    </div>
                    <!-- portfolio-item -->
                    <div class="col-lg-4 col-md-6 portfolio-grid-item all photography">
                        <div class="portfolio-item">
							<img src="../../../assets/img/portfolio/portfolio-2.jpg" alt="image">
                            <div class="portfolio-content-overlay">
								<p>App Store | Social Media</p>
								<h3><a href="single-portfolio.html">Creative Web Design</a></h3>
                            </div>
                        </div>
                    </div>
                    <!-- portfolio-item -->
                    <div class="col-lg-4 col-md-6 portfolio-grid-item all branding webdesign">
                        <div class="portfolio-item">
							<img src="../../../assets/img/portfolio/portfolio-3.jpg" alt="image">
                            <div class="portfolio-content-overlay">
								<p>App Store | Social Media</p>
								<h3><a href="single-portfolio.html">Creative Web Design</a></h3>
                            </div>
                        </div>
                    </div>
                    <!-- portfolio-item -->
                    <div class="col-lg-4 col-md-6 portfolio-grid-item all webdesign">
                        <div class="portfolio-item">
							<img src="../../../assets/img/portfolio/portfolio-4.jpg" alt="image">
                            <div class="portfolio-content-overlay">
								<p>App Store | Social Media</p>
								<h3><a href="single-portfolio.html">Creative Web Design</a></h3>
                            </div>
                        </div>
                    </div>
                    <!-- portfolio-item -->
                    <div class="col-lg-4 col-md-6 portfolio-grid-item all application">
                        <div class="portfolio-item">
							<img src="../../../assets/img/portfolio/portfolio-5.jpg" alt="image">
                            <div class="portfolio-content-overlay">
								<p>App Store | Social Media</p>
								<h3><a href="single-portfolio.html">Creative Web Design</a></h3>
                            </div>
                        </div>
                    </div>
                    <!-- portfolio-item -->
                    <div class="col-lg-4 col-md-6 portfolio-grid-item all application photography">
                        <div class="portfolio-item">
							<img src="../../../assets/img/portfolio/portfolio-6.jpg" alt="image">
                            <div class="portfolio-content-overlay">
								<p>App Store | Social Media</p>
								<h3><a href="single-portfolio.html">Creative Web Design</a></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <!-- End Portfolio Section -->
	
	<!-- Start Pricing Section -->
	{{-- <section class="price-area pt-100 pb-70">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="section-title">
						<h6 class="sub-title">Popular Package</h6>
						<h2>Pricing Plans</h2>
					</div>
				</div>
				<div class="col-lg-4 col-md-6">
					<div class="single-pricing-content">
						<div class="price-tag">
							<h3>Startup</h3>
						</div>
						<div class="price-heading">
							<div class="price-usd">
								<h2>$29.00 <span class="price-small-text">- Per month</span></h2>
							</div>
						</div>
						<div class="price-body">
							<ul>
								<li>Personal Use</li>
								<li>Unlimited Projects</li>
								<li>Project Management</li>
								<li class="offer-list-none"><del>27/7 Support</del></li>
								<li class="offer-list-none"><del>Basic support on Github</del></li>
								<li class="offer-list-none"><del>Help center access</del></li>
							</ul>
						</div>
						<div class="price-btn">
							<a href="#" class="price-btn-one">Get Started</a>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6">
					<div class="single-pricing-content">
						<div class="price-tag">
							<h3>Standard</h3>
						</div>
						<div class="price-heading">
							<div class="price-usd">
								<h2>$45.00<span class="price-small-text">- Per month</span></h2>
							</div>
						</div>
						<div class="price-body">
							<ul>
								<li>Personal Use</li>
								<li>Unlimited Projects</li>
								<li>Project Management</li>
								<li>27/7 Support</li>
								<li class="offer-list-none"><del>Basic support on Github</del></li>
								<li class="offer-list-none"><del>Help center access</del></li>
							</ul>
						</div>
						<div class="price-btn">
							<a href="#" class="price-btn-one">Get Started</a>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6">
					<div class="single-pricing-content">
						<div class="price-tag">
							<h3>Premium</h3>
						</div>
						<div class="price-heading">
							<div class="price-usd">
								<h2>$75.00<span class="price-small-text">- Per month</span></h2>
							</div>
						</div>
						<div class="price-body">
							<ul>
								<li>Personal Use</li>
								<li>Unlimited Projects</li>
								<li>Project Management</li>
								<li>27/7 Support</li>
								<li>Basic support on Github</li>
								<li>Help center access</li>
							</ul>
						</div>
						<div class="price-btn">
							<a href="#" class="price-btn-one">Get Started</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section> --}}
	<!-- End Pricing Section -->
	
	<!-- Start Hire Section -->
	<section class="hire-section">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 col-md-12">
					<div class="hire-content">
						<h6 class="sub-title">Quieres trabajar con nosotros</h6>
						<h2>Transforme digitalmente y haga crecer su negocio</h2>
						<p>Obtenga ventaja competitiva, optimice recursos, implemente soluciones o automatice procesos.</p>
						<div class="hire-btn">
							{{-- <a class="default-btn" href="tel:12345678">Call Now<span></span></a> --}}
							<a class="default-btn-one" href="">Contactar<span></span></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- End Hire Section -->
	
	<!-- Start Testimonial Section -->
	{{-- <section class="testimonial-section pt-100 pb-50">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="section-title">
						<h6 class="sub-title">Our Testimonial</h6>
						<h2>Client Feedback</h2>
					</div>
				</div>
				<div class="col-lg-12 col-md-12">
					<div class="testimonial-slider owl-carousel owl-theme">
						<!-- testimonials item -->
						<div class="single-testimonial">
							<div class="rating-box">
								<ul>
									<li><i class="fa fa-star"></i></li>
									<li><i class="fa fa-star"></i></li>
									<li><i class="fa fa-star"></i></li>
									<li><i class="fa fa-star"></i></li>
									<li><i class="fa fa-star"></i></li>
								</ul>
							</div>
							<div class="testimonial-content">
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. enim ad minim veniam, quis nostrud exercitation.</p>
							</div>
							<div class="avatar">
								<img src="../../../assets/img/client/testimonial-1.jpg" alt="testimonial images">
							</div>
							<div class="testimonial-bio">
								<div class="bio-info">
									<h3>Saabir al-Obeid</h3>
									<span>Turkey</span>
								</div>
							</div>
						</div>
						<!-- testimonials item -->
						<div class="single-testimonial">
							<div class="rating-box">
								<ul>
									<li><i class="fa fa-star"></i></li>
									<li><i class="fa fa-star"></i></li>
									<li><i class="fa fa-star"></i></li>
									<li><i class="fa fa-star"></i></li>
									<li><i class="fa fa-star"></i></li>
								</ul>
							</div>
							<div class="testimonial-content">
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. enim ad minim veniam, quis nostrud exercitation.</p>
							</div>
							<div class="avatar">
								<img src="../../../assets/img/client/testimonial-2.jpg" alt="testimonial images">
							</div>
							<div class="testimonial-bio">
								<div class="bio-info">
									<h3>Zahra Burnett</h3>
									<span>United States</span>
								</div>
							</div>
						</div>
						<!-- testimonials item -->
						<div class="single-testimonial">
							<div class="rating-box">
								<ul>
									<li><i class="fa fa-star"></i></li>
									<li><i class="fa fa-star"></i></li>
									<li><i class="fa fa-star"></i></li>
									<li><i class="fa fa-star"></i></li>
									<li><i class="fa fa-star"></i></li>
								</ul>
							</div>
							<div class="testimonial-content">
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. enim ad minim veniam, quis nostrud exercitation.</p>
							</div>
							<div class="avatar">
								<img src="../../../assets/img/client/testimonial-3.jpg" alt="testimonial images">
							</div>
							<div class="testimonial-bio">
								<div class="bio-info">
									<h3>Stevie Wills</h3>
									<span>Germany</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section> --}}
	<!-- End Testimonial Section -->
	
	<!-- Start Team Section -->
	{{-- <section class="team-area section-padding">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="section-title">
						<h6 class="sub-title">Team Member</h6>
						<h2>Expert Team</h2>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="single-team-box">
						<div class="team-image">
							<img src="../../../assets/img/team/team-1.jpg" alt="team">
							<div class="team-social-icon">
								<a href="#"><i class="fab fa-facebook-f"></i></a>
								<a href="#"><i class="fab fa-twitter"></i></a>
								<a href="#"><i class="fab fa-linkedin"></i></a>
							</div>
						</div>
						<div class="team-info">
							<h3>Ava Farrington</h3>
							<span>Founder, CEO</span>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="single-team-box">
						<div class="team-image">
							<img src="../../../assets/img/team/team-2.jpg" alt="team">
							<div class="team-social-icon">
								<a href="#"><i class="fab fa-facebook-f"></i></a>
								<a href="#"><i class="fab fa-twitter"></i></a>
								<a href="#"><i class="fab fa-linkedin"></i></a>
							</div>
						</div>
						<div class="team-info">
							<h3>Kevin Haley</h3>
							<span>Co-Founder, CTO</span>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="single-team-box">
						<div class="team-image">
							<img src="../../../assets/img/team/team-3.jpg" alt="team">
							<div class="team-social-icon">
								<a href="#"><i class="fab fa-facebook-f"></i></a>
								<a href="#"><i class="fab fa-twitter"></i></a>
								<a href="#"><i class="fab fa-linkedin"></i></a>
							</div>
						</div>
						<div class="team-info">
							<h3>Alishia Fulton</h3>
							<span>Chief Creative Officer</span>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="single-team-box">
						<div class="team-image">
							<img src="../../../assets/img/team/team-4.jpg" alt="team">
							<div class="team-social-icon">
								<a href="#"><i class="fab fa-facebook-f"></i></a>
								<a href="#"><i class="fab fa-twitter"></i></a>
								<a href="#"><i class="fab fa-linkedin"></i></a>
							</div>
						</div>
						<div class="team-info">
							<h3>Lucas Martinez</h3>
							<span>Project Manager</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section> --}}
	<!-- End Team Section -->
	
	<!-- Start Blog Section -->
	{{-- <section class="blog-section bg-grey pt-100 pb-70">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="section-title">
						<h6 class="sub-title">Blog & Article</h6>
						<h2>Recent Blog</h2>
					</div>
				</div>
				<div class="col-lg-4 col-md-6">
					<div class="blog-single-item">
						<div class="blog-image">
							<a href="single-blog.html">
								<img src="../../../assets/img/blog/blog-1.jpg" alt="image">
							</a>
						</div>
						<div class="blog-description">
							<ul class="blog-info">
								<li>
									<a href="#"><i class="bi bi-person-circle"></i> Author</a>
								</li>
								<li>
									<a href="#"><i class="bi bi-calendar-check"></i> 17 June 2023</a>
								</li>
							</ul>
							<div class="blog-text">
								<h3>
                                    <a href="single-blog.html">
										Planning for a Safe Return to the Workplace IT Solutions
                                    </a>
                                </h3>
								<p>Lorem ipsum dolor sit amet, consectetu adipiscing elit, sed eiusmod tempor incididunt ut labore dolore magna aliqua</p>
								<div class="blog-btn"> <a href="single-blog.html" class="read-more"><i class="bi bi-arrow-right-short"></i> Read More</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6">
					<div class="blog-single-item">
						<div class="blog-image">
							<a href="single-blog.html">
								<img src="../../../assets/img/blog/blog-2.jpg" alt="image">
							</a>
						</div>
						<div class="blog-description">
							<ul class="blog-info">
								<li>
									<a href="#"><i class="bi bi-person-circle"></i> Author</a>
								</li>
								<li>
									<a href="#"><i class="bi bi-calendar-check"></i> 20 June 2023</a>
								</li>
							</ul>
							<div class="blog-text">
								<h3>
									<a href="single-blog.html">
                                       Announcing Our New Smiles for Success Charity
                                    </a>
								</h3>
								<p>Lorem ipsum dolor sit amet, consectetu adipiscing elit, sed eiusmod tempor incididunt ut labore dolore magna aliqua</p>
								<div class="blog-btn">
									<a href="single-blog.html" class="read-more"><i class="bi bi-arrow-right-short"></i> Read More</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6">
					<div class="blog-single-item">
						<div class="blog-image">
							<a href="single-blog.html">
								<img src="../../../assets/img/blog/blog-3.jpg" alt="image">
							</a>
						</div>
						<div class="blog-description">
							<ul class="blog-info">
								<li>
									<a href="#"><i class="bi bi-person-circle"></i> Author</a>
								</li>
								<li>
									<a href="#"><i class="bi bi-calendar-check"></i> 25 June 2023</a>
								</li>
							</ul>
							<div class="blog-text">
								<h3>
                                    <a href="single-blog.html">
                                        Machine Learning Applications for Every Industry
                                    </a>
                                </h3>
								<p>Lorem ipsum dolor sit amet, consectetu adipiscing elit, sed eiusmod tempor incididunt ut labore dolore magna aliqua</p>
								<div class="blog-btn">
									<a href="single-blog.html" class="read-more"><i class="bi bi-arrow-right-short"></i> Read More</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section> --}}
	<!-- End Blog Section -->

	<!-- Start Partner section -->
	{{-- <section class="partner-section pt-100 pb-70">
		<div class="container">
			<div class="partner-title">
				<h6 class="sub-title">Trusted By Over 1500</h6>
				<h2>Our Customers</h2>
			</div>
			<div class="partner-list">
				<div class="partner-item">
					<a href="#0">
						<img src="../../../assets/img/partner/client-1.png" alt="image">
					</a>
				</div>
				<div class="partner-item">
					<a href="#0">
						<img src="../../../assets/img/partner/client-2.png" alt="image">
					</a>
				</div>
				<div class="partner-item">
					<a href="#0">
						<img src="../../../assets/img/partner/client-3.png" alt="image">
					</a>
				</div>
				<div class="partner-item">
					<a href="#0">
						<img src="../../../assets/img/partner/client-4.png" alt="image">
					</a>
				</div>
				<div class="partner-item">
					<a href="#0">
						<img src="../../../assets/img/partner/client-5.png" alt="image">
					</a>
				</div>
				<div class="partner-item">
					<a href="#0">
						<img src="../../../assets/img/partner/client-6.png" alt="image">
					</a>
				</div>
				<div class="partner-item">
					<a href="#0">
						<img src="../../../assets/img/partner/client-7.png" alt="image">
					</a>
				</div>
				<div class="partner-item">
					<a href="#0">
						<img src="../../../assets/img/partner/client-8.png" alt="image">
					</a>
				</div>
				<div class="partner-item">
					<a href="#0">
						<img src="../../../assets/img/partner/client-9.png" alt="image">
					</a>
				</div>
			</div>
		</div>
	</section> --}}
	<!-- End Partner section -->
	
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
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco consectetur laboris.</p>
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
								<li><a href="#">Startup Solutions</a></li>
								<li><a href="#">Web Development</a></li>
								<li><a href="#">Networking Services</a></li>
								<li><a href="#">SEO Optimization</a></li>
								<li><a href="#">Apps Development</a></li>
							</ul>
						</div>
					</div>
					<div class="col-lg-2 col-md-6 col-sm-6">
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
					</div>
					<div class="col-lg-4 col-md-6 col-sm-6">
						<div class="single-footer-widget">
							<div class="footer-heading">
								<h3>Contact Info</h3>
							</div>
							<div class="footer-info-contact">
								<i class="flaticon-phone-call"></i>
								<h3>Phone</h3>
								<span><a href="tel:12345678">080 707 555-321</a></span>
							</div>
							<div class="footer-info-contact">
								<i class="flaticon-envelope"></i>
								<h3>Email</h3>
								<span><a href="mailto:demo@example.com">demo@example.com</a></span>
							</div>
							<div class="footer-info-contact">
								<i class="flaticon-placeholder"></i>
								<h3>Address</h3>
								<span>526  Melrose Street, Water Mill, 11976  New York</span>
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