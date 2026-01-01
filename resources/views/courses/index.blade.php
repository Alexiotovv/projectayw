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
							<strong>info@aywsolution.com</strong><br>
							<strong>WhatsApp: +51 980 534 198</strong>
						</p>

						<a href="https://wa.me/51980534198?text=Hola%2C%20buenas%20tardes.%0ADeseo%20inscribirme%20en%20el%20Curso%20Taller%20de%20Configuraci%C3%B3n%20de%20VPS%20Ubuntu%2022%20con%20Laravel.%0AModalidad:%20Virtual%20o%20Presencial.%0AGracias."
						   target="_blank"
						   class="default-btn submit-btn mt-3">
							Inscribirme Ahora <span></span>
						</a>

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
							   href="https://wa.me/51980534198?text=Hola%2C%20quiero%20informaci%C3%B3n%20sobre%20el%20Curso%20Taller%20VPS%20y%20Laravel."
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
