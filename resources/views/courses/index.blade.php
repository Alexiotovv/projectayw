@extends('bases.public_home')

@section('public_contenido')
	<!-- Start Page Title Section -->
	<div class="page-title-area">
		<div class="d-table">
			<div class="d-table-cell">
				<div class="container">
					<div class="page-title-content">
						<h2>Curso Taller VPS + Laravel</h2>
						<ul>
							<li><a href="{{ route('inicio') }}">Home</a></li>
							<li>Curso VPS</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Page Title Section -->

	<!-- Start Course Section -->
	<section class="contact-section section-padding">
		<div class="container">
			<div class="section-title">
				<h6 class="sub-title">Curso Taller Práctico</h6>
				<h2>Configura tu VPS y publica Laravel desde cero</h2>
				<p>
					Taller práctico donde aprenderás a desplegar una aplicación Laravel
					en un servidor real con dominio propio.
				</p>
			</div>

			<div class="row align-items-center">
				<div class="col-lg-6">
					<div class="contact-form">
						<h4>🚀 ¿Qué aprenderás?</h4>
						<ul class="list-unstyled mt-3">
							<li>✔️ Comprar y configurar un VPS Ubuntu 22</li>
							<li>✔️ Conectarte por SSH y manejar comandos básicos</li>
							<li>✔️ Instalar Apache, PHP y MySQL</li>
							<li>✔️ Publicar una aplicación Laravel</li>
							<li>✔️ Comprar y configurar dominio en Cloudflare</li>
							<li>✔️ Seguridad básica del servidor</li>
						</ul>

						<hr>

						<h4>📅 Modalidad y Duración</h4>
						<p>
							<strong>2 días</strong> – 3 horas por día<br>
							Total: <strong>6 horas 100% prácticas</strong>
						</p>

						<h4>💰 Inversión</h4>
						<ul class="list-unstyled">
							<li>💻 <strong>Modalidad Virtual:</strong> S/ 50.00</li>
							<li>🏫 <strong>Modalidad Presencial:</strong> S/ 80.00</li>
						</ul>
						<p>
							<small>*El alumno cubre el costo de su VPS y dominio</small>
						</p>

						<h4>👨‍🎓 Dirigido a:</h4>
						<p>
							Jóvenes, estudiantes y personas que desean aprender
							despliegue real de aplicaciones web.
						</p>

						<!-- Sección del Instructor - Añadida aquí -->
						<div class="instructor-section mt-4 p-3" style="background-color: #f8f9fa; border-radius: 8px; border-left: 4px solid #007bff;">
							<h5>👨‍🏫 Impartido por:</h5>
							<div class="d-flex align-items-center mt-3">
								<div class="me-3">
									<img src="{{ asset('assets/img/foto_alex.jpeg') }}" 
										 alt="Alex Vásquez" 
										 class="rounded-circle"
										 style="width: 80px; height: 80px; object-fit: cover; border: 3px solid #007bff;">
								</div>
								<div>
									<h6 class="mb-1" style="font-weight: 600;">Alex Vásquez</h6>
									<p class="mb-2" style="font-size: 0.9rem;">Especialista en Desarrollo Web y DevOps</p>
									<div class="d-flex gap-2">
										<a href="https://www.linkedin.com/in/alexvasquezv/" 
										   target="_blank"
										   class="btn btn-sm btn-outline-primary"
										   style="font-size: 0.8rem; padding: 0.25rem 0.5rem;">
											<i class="fab fa-linkedin"></i> LinkedIn
										</a>
										<a href="https://alexvasquez.aywsolution.com/" 
										   target="_blank"
										   class="btn btn-sm btn-outline-success"
										   style="font-size: 0.8rem; padding: 0.25rem 0.5rem;">
											<i class="fas fa-briefcase"></i> Portafolio
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-lg-6">
					<div class="contact-form">
						<h4>📌 Al finalizar el taller tendrás:</h4>
						<ul class="list-unstyled">
							<li>✅ VPS configurado y seguro</li>
							<li>✅ Laravel funcionando en producción</li>
							<li>✅ Dominio apuntando correctamente</li>
							<li>✅ Proyecto accesible desde Internet</li>
						</ul>

						<hr>

						<h4>📲 Inscripciones</h4>
						<p>
							Contáctanos para reservar tu cupo:<br>
							<strong>avasquez@aywsolution.com</strong><br>
							<strong>WhatsApp: +51 980 534 198</strong>
						</p>

						<a href="https://wa.me/51980534198?text=Hola%2C%20buenas%20tardes.%0ADeseo%20inscribirme%20en%20el%20Curso%20Taller%20de%20Configuraci%C3%B3n%20de%20VPS%20Ubuntu%2022%20con%20Laravel.%0AModalidad:%20Virtual%20o%20Presencial.%0AGracias."
						   target="_blank"
						   class="default-btn submit-btn mt-3">
							💬 Más información <span></span>
						</a>

						<!-- En tu vista del curso, agrega esto donde quieras el botón -->
						
							<a href="{{ route('inscripcion.curso') }}" class="default-btn submit-btn">
								📝 Registrarme al Curso <span></span>
							</a>
							<p class="mt-2"><small>¡Cupos limitados!</small></p>
						

						<p class="mt-3">
							<small>Cupos limitados · Taller práctico guiado paso a paso</small>
						</p>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- End Course Section -->

	<!-- Start Hire Section -->
	<section class="hire-section">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 col-md-12">
					<div class="hire-content">
						<h2>Aprende haciendo, no solo viendo tutoriales</h2>
						<p>
							En pocas horas entenderás cómo funcionan los servidores
							que usan los proyectos reales.
						</p>
						<div class="hire-btn">
							<a class="default-btn-one"
							   href="https://wa.me/51980534198?text=%F0%9F%98%83%20%C2%A1Hola%2C%20buenas%20tardes%21%0A%F0%9F%92%BB%20Me%20interesa%20inscribirme%20al%20**Curso%20Taller%20de%20VPS%20Ubuntu%2022%20%2B%20Laravel**.%0A%F0%9F%93%8C%20**Modalidad%3A**%20Virtual%20o%20Presencial.%0A%F0%9F%8C%9F%20%C2%A1Muchas%20gracias%21"
							   target="_blank">
								Consultar Cupos <span></span>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- End Hire Section -->
@endsection