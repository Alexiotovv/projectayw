@extends('bases.public_home')

@section('public_contenido')
<!-- Start Page Title Section -->
<div class="page-title-area">
    <div class="d-table">
        <div class="d-table-cell">
            <div class="container">
                <div class="page-title-content">
                    <h2>Our Portfolio</h2>
                    <ul>
                        <li><a href="{{ route('inicio') }}">Home</a></li>
                        <li>Portfolio</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Page Title Section -->

<!-- Start Portfolio Section -->
<section class="portfolio-section section-padding">
    <div class="container">
        <div class="section-title text-center mb-5">
            <h6 class="sub-title">Our Work</h6>
            <h2>Some of Our Recent Projects</h2>
            <p>Here are some systems and software solutions we’ve developed for our clients.</p>
        </div>

        <!-- Reemplaza las etiquetas <img> por enlaces que apunten a la imagen (wrap) -->
<div class="row g-4">
    <!-- Portfolio Item 1 -->
    <div class="col-lg-4 col-md-6">
        <div class="card h-100 shadow-sm border-0">
            <a href="{{ asset('assets/img/portfolio/sistema1.png') }}" class="image-link">
                <img src="{{ asset('assets/img/portfolio/sistema1.png') }}" class="card-img-top rounded-top zoomable" alt="System 1" data-title="Ticket Management for User Support">
            </a>
            <div class="card-body text-center">
                <h5 class="card-title">Ticket Management for User Support</h5>
                <p class="card-text text-muted">A ticket management system for handling user support requests in a government agency.</p>
            </div>
        </div>
    </div>

    <!-- Portfolio Item 2 -->
    <div class="col-lg-4 col-md-6">
        <div class="card h-100 shadow-sm border-0">
            <a href="{{ asset('assets/img/portfolio/sistema2.png') }}" class="image-link">
                <img src="{{ asset('assets/img/portfolio/sistema2.png') }}" class="card-img-top rounded-top zoomable" alt="System 2" data-title="Document Management System">
            </a>
            <div class="card-body text-center">
                <h5 class="card-title">Document Management System</h5>
                <p class="card-text text-muted">Digitize, organize, and control document workflows securely.</p>
            </div>
        </div>
    </div>

    <!-- Portfolio Item 3 -->
    <div class="col-lg-4 col-md-6">
        <div class="card h-100 shadow-sm border-0">
            <a href="{{ asset('assets/img/portfolio/sistema3.png') }}" class="image-link">
                <img src="{{ asset('assets/img/portfolio/sistema3.png') }}" class="card-img-top rounded-top zoomable" alt="System 3" data-title="Inventory Control">
            </a>
            <div class="card-body text-center">
                <h5 class="card-title">🛍️ WordPress & WooCommerce Catalog System</h5>
                <p class="card-text text-muted">A dynamic and customizable product catalog built with WordPress and WooCommerce. It allows easy product management, categories, and online inquiries — ideal for businesses wanting to showcase their products without a full e-commerce setup.</p>
            </div>
        </div>
    </div>

    <!-- Portfolio Item 4 -->
    <div class="col-lg-4 col-md-6">
        <div class="card h-100 shadow-sm border-0">
            <a href="{{ asset('assets/img/portfolio/sistema4.png') }}" class="image-link">
                <img src="{{ asset('assets/img/portfolio/sistema4.png') }}" class="card-img-top rounded-top zoomable" alt="System 4" data-title="School Management Platform">
            </a>
            <div class="card-body text-center">
                <h5 class="card-title">🍽️ Restaurant Management System</h5>
                <p class="card-text text-muted">A complete restaurant solution that manages menus, orders, tables, and staff efficiently.</p>
            </div>
        </div>
    </div>

    <!-- Portfolio Item 5 -->
    <div class="col-lg-4 col-md-6">
        <div class="card h-100 shadow-sm border-0">
            <a href="{{ asset('assets/img/portfolio/sistema5.png') }}" class="image-link">
                <img src="{{ asset('assets/img/portfolio/sistema5.png') }}" class="card-img-top rounded-top zoomable" alt="System 5" data-title="School & Evaluation Management System">
            </a>
            <div class="card-body text-center">
                <h5 class="card-title">🎓 School & Evaluation Management System</h5>
                <p class="card-text text-muted">An academic management platform designed to handle student records, courses, grades, and online evaluations.</p>
            </div>
        </div>
    </div>

    <!-- Portfolio Item 6 -->
    <div class="col-lg-4 col-md-6">
        <div class="card h-100 shadow-sm border-0">
            <a href="{{ asset('assets/img/portfolio/sistema6.png') }}" class="image-link">
                <img src="{{ asset('assets/img/portfolio/sistema6.png') }}" class="card-img-top rounded-top zoomable" alt="System 6" data-title="School Payment Collection System with Python Automation">
            </a>
            <div class="card-body text-center">
                <h5 class="card-title">💰 School Payment Collection System with Python Automation</h5>
                <p class="card-text text-muted">An intelligent system that automates student fee tracking and payment reminders using Python.</p>
            </div>
        </div>
    </div>
</div>

        </div>
    </div>
</section>
<!-- End Portfolio Section -->

<!-- Start Hire Section -->
<section class="hire-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 col-md-12">
                <div class="hire-content text-center">
                    <h2>Let's create something amazing together.</h2>
                    <p>Need a custom software or web system? Let’s bring your ideas to life.</p>
                    <div class="hire-btn">
                        <a class="default-btn-one" href="{{ route('contacto.index') }}">Contact Us<span></span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Hire Section -->

<!-- Modal para zoom -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content bg-transparent border-0 text-center">
      <img id="modalImageSrc" src="" class="img-fluid rounded shadow-lg" alt="">
      <h5 id="modalImageTitle" class="text-white mt-2"></h5>
    </div>
  </div>
</div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const modal = new bootstrap.Modal(document.getElementById('imageModal'));
    const modalImg = document.getElementById('modalImageSrc');
    const modalTitle = document.getElementById('modalImageTitle');

    document.querySelectorAll('.zoomable').forEach(img => {
        img.addEventListener('click', () => {
            modalImg.src = img.src;
            modalTitle.innerText = img.dataset.title || '';
            modal.show();
        });
    });
});
</script>
@endsection
{{-- Pega esto al final de tu blade (usa la sección que tu layout espera): --}}
@section('script_footer')
<script>
$(function(){
    // Inicializa Magnific Popup (ya está incluido en tu base: jquery.magnific-popup.min.js)
    $('.image-link').magnificPopup({
        type: 'image',
        mainClass: 'mfp-fade',
        removalDelay: 300,
        gallery: { enabled: true },
        image: {
            titleSrc: function(item) {
                // toma data-title del <img> o el alt
                return item.el.find('img').data('title') || item.el.find('img').attr('alt');
            }
        }
    });
});
</script>
@endsection
