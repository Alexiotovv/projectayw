@extends('bases.public_home')

@section('public_contenido')
<!-- Start Page Title Section -->
<div class="page-title-area">
    <div class="d-table">
        <div class="d-table-cell">
            <div class="container">
                <div class="page-title-content">
                    <h2>About Us</h2>
                    <ul>
                        <li><a href="{{ route('inicio') }}">Home</a></li>
                        <li>About Us</li>
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
                    <h6 class="sub-title">Quiénes Somos</h6>
                    <h2>Transformamos la tecnología en resultados para tu organización</h2>
                    <p>Somos una empresa peruana especializada en el desarrollo e implementación de soluciones tecnológicas integrales, comprometida con impulsar la transformación digital de las organizaciones mediante la innovación, la seguridad y la eficiencia.</p>
                    <p>En AYW Solution brindamos servicios de desarrollo de software, ciberseguridad, infraestructura y soporte TI, automatización de procesos digitales e industriales, dashboards gerenciales y soluciones basadas en inteligencia artificial, ayudando a empresas e instituciones a optimizar sus operaciones y alcanzar sus objetivos estratégicos.</p>
                    <div class="about-btn-box">
                        <a class="default-btn" href="{{ route('contacto.index') }}">Contáctanos<span></span></a>
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
                    <h3>Misión</h3>
                    <p>Brindar soluciones tecnológicas innovadoras y seguras que impulsen la transformación digital de las organizaciones, mediante el desarrollo de software, la automatización de procesos, la ciberseguridad y la inteligencia artificial, contribuyendo al crecimiento, la eficiencia y la competitividad de nuestros clientes.</p>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="feature-single-item">
                    <i class="fas fa-eye" style="font-size: 32px; color: #0f5cc8; margin-bottom: 15px;"></i>
                    <h3>Visión</h3>
                    <p>Ser una empresa líder en soluciones tecnológicas y transformación digital en Perú y Latinoamérica, reconocida por nuestra innovación, calidad y compromiso, ayudando a las organizaciones a adoptar tecnologías emergentes que generen un impacto positivo y sostenible en sus procesos y resultados.</p>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 mt-4">
                <div class="feature-single-item">
                    <i class="fas fa-handshake" style="font-size: 32px; color: #0f5cc8; margin-bottom: 15px;"></i>
                    <h3>Nuestro propósito</h3>
                    <p>Convertimos los desafíos tecnológicos en oportunidades de crecimiento, desarrollando soluciones innovadoras que permiten a las organizaciones ser más eficientes, seguras y competitivas en un mundo cada vez más digital.</p>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 mt-4">
                <div class="feature-single-item">
                    <i class="fas fa-shield-alt" style="font-size: 32px; color: #0f5cc8; margin-bottom: 15px;"></i>
                    <h3>Nuestra promesa</h3>
                    <p>Ser un aliado estratégico de confianza, acompañando a nuestros clientes en cada etapa de su transformación digital con tecnología, compromiso y excelencia.</p>
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
                    <h2>En AYW Solution, transformamos la tecnología en resultados para tu organización.</h2>
                    <p>Nuestro equipo combina experiencia técnica, creatividad y un enfoque orientado al cliente para diseñar soluciones a medida que generan valor, mejoran la productividad y contribuyen al crecimiento sostenible de nuestros clientes.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Quote Section -->
@endsection
