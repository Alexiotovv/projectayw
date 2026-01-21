{{-- resources/views/certificados/show.blade.php --}}
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificado - {{ $certificado->nombre_completo }}</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        * {
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
            color-adjust: exact !important;
        }
        .col-1, .col-2, .col-3, .col-4, .col-5, .col-6,
        .col-7, .col-8, .col-9, .col-10, .col-11, .col-12,
        .col, .col-auto, .col-sm-1, .col-sm-2, .col-sm-3,
        .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8,
        .col-sm-9, .col-sm-10, .col-sm-11, .col-sm-12,
        .col-md-1, .col-md-2, .col-md-3, .col-md-4, .col-md-5,
        .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-md-10,
        .col-md-11, .col-md-12, .col-lg-1, .col-lg-2, .col-lg-3,
        .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8,
        .col-lg-9, .col-lg-10, .col-lg-11, .col-lg-12,
        .col-xl-1, .col-xl-2, .col-xl-3, .col-xl-4, .col-xl-5,
        .col-xl-6, .col-xl-7, .col-xl-8, .col-xl-9, .col-xl-10,
        .col-xl-11, .col-xl-12 {
            position: relative !important;
            width: 100% !important;
            padding-right: 15px !important;
            padding-left: 15px !important;
        }
        
        /* Específicamente para el layout de firmas que usa row */
        .col-lg-6, .col-md-6 {
            flex: 0 0 50% !important;
            max-width: 50% !important;
        }
        
        .col-lg-8 {
            flex: 0 0 66.666667% !important;
            max-width: 66.666667% !important;
        }
        
        .col-lg-4 {
            flex: 0 0 33.333333% !important;
            max-width: 33.333333% !important;
        }
        
        .col-12 {
            flex: 0 0 100% !important;
            max-width: 100% !important;
        }
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --accent-color: #1abc9c;
        }


        .certificate-details {
            background: #f8f9fa !important;
            border: 1px solid #e9ecef !important;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }
        
        .details-grid {
            display: flex !important;
            flex-wrap: wrap !important;
            gap: 15px !important;
        }
        
        .detail-item {
            flex: 0 0 calc(50% - 15px) !important;
            display: flex !important;
            flex-direction: column !important;
            margin-bottom: 10px !important;
        }
        
        /* Para que ocupe toda la fila si hay menos elementos */
        .detail-item:nth-last-child(1):nth-child(odd) {
            flex: 0 0 100% !important;
        }


        
        body {
            font-family: 'Georgia', 'Times New Roman', serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #e4e8f0 100%);
            min-height: 100vh;
            padding: 15px;
        }
        
        .certificate-container {
            max-width: 1000px;
            margin: 0 auto;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.12);
            position: relative;
            border: 15px solid transparent;
            border-image: linear-gradient(45deg, #2c3e50, #3498db) 1;
        }
        
        /* Certificate Header - Más compacto */
        .certificate-header {
            background: linear-gradient(90deg, #2c3e50, #1a252f);
            color: white;
            padding: 25px 30px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        
        .certificate-header:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none"><path fill="rgba(255,255,255,0.05)" d="M0,0 L100,0 L100,100 Z"/></svg>');
            background-size: cover;
        }
        
        .certificate-seal {
            width: 100px;
            height: 100px;
            background: radial-gradient(circle, white 60%, #f0f0f0 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
            border: 2px solid #d4af37;
            position: relative;
            z-index: 2;
        }
        
        .certificate-seal:before {
            content: '';
            position: absolute;
            width: 85px;
            height: 85px;
            border: 1px dashed #d4af37;
            border-radius: 50%;
        }
        
        .certificate-seal i {
            font-size: 45px;
            color: #2c3e50;
            z-index: 1;
        }
        
        .certificate-title h1 {
            font-size: 2.2rem;
            font-weight: 800;
            margin-bottom: 5px;
            letter-spacing: 2px;
            text-transform: uppercase;
            font-family: 'Georgia', serif;
        }
        
        .certificate-title p {
            font-size: 1.1rem;
            opacity: 0.9;
            margin-bottom: 0;
            font-style: italic;
            letter-spacing: 0.5px;
        }
        
        /* Certificate Body */
        .certificate-body {
            padding: 35px 40px;
            position: relative;
            background: white;
        }
        
        .certificate-watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 140px;
            color: rgba(44, 62, 80, 0.03);
            font-weight: 900;
            font-family: 'Georgia', serif;
            pointer-events: none;
            z-index: 0;
            white-space: nowrap;
        }
        
        .certificate-content {
            position: relative;
            z-index: 1;
        }
        
        /* Certificate Awarded - Más compacto */
        .certificate-awarded {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid #f0f0f0;
        }
        
        .awarded-to {
            font-size: 1.1rem;
            color: #666;
            margin-bottom: 10px;
            letter-spacing: 0.5px;
        }
        
        .student-name {
            font-size: 2.4rem;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 15px;
            line-height: 1.1;
            font-family: 'Georgia', serif;
            text-shadow: 1px 1px 1px rgba(0,0,0,0.05);
        }
        
        .certificate-description {
            font-size: 1.2rem;
            color: #555;
            margin-bottom: 20px;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
            line-height: 1.5;
        }
        
        .course-name {
            font-size: 1.6rem;
            font-weight: 600;
            color: #3498db;
            margin-bottom: 25px;
            padding: 12px 25px;
            background: linear-gradient(to right, rgba(52, 152, 219, 0.08), rgba(26, 188, 156, 0.08));
            border-radius: 8px;
            display: inline-block;
            border-left: 3px solid #3498db;
        }
        
        /* Certificate Details - MUCHO MÁS COMPACTO */
        .certificate-details {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 25px;
            border: 1px solid #e9ecef;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.02);
        }
        
        .details-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
        }
        
        .detail-item {
            display: flex;
            flex-direction: column;
        }
        
        .detail-label {
            font-weight: 600;
            color: #2c3e50;
            font-size: 0.9rem;
            margin-bottom: 5px;
            display: flex;
            align-items: center;
        }
        
        .detail-label i {
            margin-right: 8px;
            color: #3498db;
            font-size: 1rem;
            min-width: 20px;
        }
        
        .detail-value {
            color: #333;
            font-weight: 500;
            font-size: 0.95rem;
            padding-left: 28px;
        }
        
        .detail-value .code {
            font-family: 'Courier New', monospace;
            background: #2c3e50;
            color: white;
            padding: 5px 10px;
            border-radius: 4px;
            letter-spacing: 1.5px;
            font-size: 0.9rem;
            display: inline-block;
        }
        
        /* Certificate Footer - Más compacto */
        .certificate-footer {
            margin-top: 30px;
            padding-top: 25px;
            border-top: 2px solid #e9ecef;
        }
        
        /* Signatures Section - Compacto */
        .signatures-section {
            display: flex;
            justify-content: space-between;
            margin-bottom: 25px;
            position: relative;
        }
        
        .instructor-signature {
            flex: 1;
            padding-right: 25px;
            position: relative;
        }
        
        .institution-stamp {
            flex: 1;
            padding-left: 25px;
            border-left: 1px solid #e9ecef;
        }
        
        .signature-title {
            font-size: 0.95rem;
            color: #666;
            margin-bottom: 15px;
            text-align: center;
            font-weight: 500;
            letter-spacing: 0.5px;
        }
        
        /* Firma elegante AV - Compacto */
        .av-signature {
            text-align: center;
            margin-bottom: 15px;
            position: relative;
        }
        
        .signature-av {
            font-family: 'Brush Script MT', 'Dancing Script', cursive;
            font-size: 36px;
            color: #2c3e50;
            display: inline-block;
            position: relative;
            padding: 0 30px;
            margin-bottom: 5px;
        }
        
        .signature-av:before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            width: 20px;
            height: 1px;
            background: #2c3e50;
            transform: translateY(-50%);
        }
        
        .signature-av:after {
            content: '';
            position: absolute;
            top: 50%;
            right: 0;
            width: 20px;
            height: 1px;
            background: #2c3e50;
            transform: translateY(-50%);
        }
        
        .signature-name {
            font-size: 1.1rem;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 3px;
            letter-spacing: 0.5px;
        }
        
        .signature-credentials {
            color: #666;
            font-size: 0.85rem;
            line-height: 1.3;
            margin-bottom: 10px;
        }
        
        .signature-separator {
            width: 50px;
            height: 1px;
            background: #ddd;
            margin: 10px auto;
        }
        
        /* Sello de la institución - Compacto */
        .institution-seal {
            text-align: center;
            margin-bottom: 15px;
        }
        
        .seal-circle {
            width: 90px;
            height: 90px;
            border: 2px solid #d4af37;
            border-radius: 50%;
            margin: 0 auto 10px;
            position: relative;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .seal-circle:before {
            content: '';
            position: absolute;
            width: 75px;
            height: 75px;
            border: 1px solid #2c3e50;
            border-radius: 50%;
        }
        
        .seal-initials {
            font-size: 1.5rem;
            font-weight: 700;
            color: #2c3e50;
            z-index: 1;
        }
        
        .institution-name {
            font-size: 1.1rem;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 3px;
        }
        
        .institution-details {
            color: #666;
            font-size: 0.8rem;
            line-height: 1.3;
        }
        
        /* Verification Section - Compacto */
        .verification-section {
            background: linear-gradient(90deg, #2c3e50, #34495e);
            color: white;
            padding: 18px;
            border-radius: 8px;
            text-align: center;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
        }
        
        .verification-title {
            font-size: 1rem;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        
        .verification-code {
            font-family: 'Courier New', monospace;
            font-size: 1.1rem;
            letter-spacing: 2px;
            background: rgba(255, 255, 255, 0.1);
            padding: 8px 15px;
            border-radius: 6px;
            margin: 10px 0;
            display: inline-block;
            border: 1px solid rgba(255, 255, 255, 0.15);
        }
        
        .verification-info {
            font-size: 0.85rem;
            opacity: 0.9;
            margin-bottom: 8px;
            line-height: 1.4;
        }
        
        .verification-link {
            color: #1abc9c;
            text-decoration: none;
            font-weight: 500;
            font-size: 0.85rem;
        }
        
        .verification-link:hover {
            text-decoration: underline;
        }
        
        /* Action Buttons - Más compacto */
        .action-buttons {
            display: flex;
            justify-content: center;
            gap: 12px;
            margin-top: 25px;
            flex-wrap: wrap;
        }
        
        .btn-certificate {
            padding: 10px 20px;
            border-radius: 50px;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.3s;
            border: none;
            cursor: pointer;
            font-size: 0.9rem;
        }
        
        .btn-certificate:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }
        
        .btn-print {
            background: linear-gradient(90deg, #2c3e50, #3498db);
            color: white;
        }
        
        .btn-pdf {
            background: linear-gradient(90deg, #e74c3c, #c0392b);
            color: white;
        }
        
        .btn-copy {
            background: linear-gradient(90deg, #3498db, #2980b9);
            color: white;
        }
        
        .btn-verify {
            background: linear-gradient(90deg, #2ecc71, #27ae60);
            color: white;
        }
        
        /* Print Styles - A4 VERTICAL UNA SOLA PÁGINA */
        @media print {
            body {
                background: white;
                padding: 0;
                margin: 0;
                width: 210mm;
                height: 297mm;
            }
            
            .certificate-container {
                box-shadow: none;
                border-radius: 0;
                width: 100%;
                height: 100%;
                margin: 0;
                border: 10px solid #2c3e50;
                page-break-inside: avoid;
                page-break-after: avoid;
                page-break-before: avoid;
            }
            
            .no-print {
                display: none !important;
            }
            
            .action-buttons {
                display: none;
            }
            
            .btn-certificate {
                display: none;
            }
            
            /* Configurar página A4 vertical */
            @page {
                size: A4 portrait;
                margin: 5mm;
            }
            
            /* Reducir aún más para que quepa */
            .certificate-header {
                padding: 15px 20px !important;
            }
            
            .certificate-seal {
                width: 80px !important;
                height: 80px !important;
                margin-bottom: 10px !important;
            }
            
            .certificate-seal i {
                font-size: 35px !important;
            }
            
            .certificate-title h1 {
                font-size: 1.8rem !important;
                margin-bottom: 3px !important;
            }
            
            .certificate-title p {
                font-size: 1rem !important;
            }
            
            .certificate-body {
                padding: 20px 25px !important;
            }
            
            .student-name {
                font-size: 2rem !important;
                margin-bottom: 10px !important;
            }
            
            .certificate-description {
                font-size: 1rem !important;
                margin-bottom: 15px !important;
            }
            
            .course-name {
                font-size: 1.3rem !important;
                padding: 10px 20px !important;
                margin-bottom: 20px !important;
            }
            
            .certificate-details {
                padding: 15px !important;
                margin-bottom: 15px !important;
            }
            
            .details-grid {
                gap: 10px !important;
            }
            
            .detail-label {
                font-size: 0.85rem !important;
            }
            
            .detail-value {
                font-size: 0.9rem !important;
            }
            
            .certificate-footer {
                margin-top: 20px !important;
                padding-top: 15px !important;
            }
            
            .signatures-section {
                margin-bottom: 15px !important;
            }
            
            .signature-av {
                font-size: 32px !important;
            }
            
            .signature-name {
                font-size: 1rem !important;
            }
            
            .signature-credentials {
                font-size: 0.8rem !important;
            }
            
            .seal-circle {
                width: 75px !important;
                height: 75px !important;
            }
            
            .seal-initials {
                font-size: 1.3rem !important;
            }
            
            .institution-name {
                font-size: 1rem !important;
            }
            
            .institution-details {
                font-size: 0.75rem !important;
            }
            
            .verification-section {
                padding: 12px !important;
            }
            
            .verification-title {
                font-size: 0.9rem !important;
            }
            
            .verification-code {
                font-size: 1rem !important;
                padding: 6px 12px !important;
            }
            
            .verification-info {
                font-size: 0.8rem !important;
            }
            
            .certificate-watermark {
                font-size: 100px !important;
            }
        }
        /* Responsive */
        @media (max-width: 768px) {
            body {
                padding: 10px;
            }
            
            .certificate-header {
                padding: 20px 15px;
            }
            
            .certificate-body {
                padding: 25px 20px;
            }
            
            .certificate-title h1 {
                font-size: 1.8rem;
            }
            
            .student-name {
                font-size: 1.8rem;
            }
            
            .course-name {
                font-size: 1.3rem;
                padding: 10px 18px;
            }
            
            .certificate-watermark {
                font-size: 100px;
            }
            
            .details-grid {
                grid-template-columns: 1fr;
                gap: 12px;
            }
            
            .signatures-section {
                flex-direction: column;
                gap: 25px;
            }
            
            .instructor-signature, 
            .institution-stamp {
                padding: 0;
                border: none;
            }
            
            .action-buttons {
                flex-direction: column;
                align-items: center;
                gap: 10px;
            }
            
            .btn-certificate {
                width: 100%;
                max-width: 280px;
            }
        }
        
        /* Elegant effects */
        .gold-accent {
            color: #d4af37;
        }
        
        .certificate-container:before {
            content: '';
            position: absolute;
            top: 8px;
            left: 8px;
            right: 8px;
            bottom: 8px;
            border: 1px solid rgba(212, 175, 55, 0.2);
            pointer-events: none;
            z-index: 1;
        }
        
        /* Asegurar que todo quepa en pantalla */
        @media screen and (max-height: 900px) {
            .certificate-container {
                max-width: 900px;
            }
            
            .certificate-body {
                padding: 25px 30px;
            }
            
            .student-name {
                font-size: 2rem;
            }
            
            .course-name {
                font-size: 1.4rem;
            }
        }
    </style>
</head>
<body>
    <div class="certificate-container">
        <!-- Certificate Header -->
        <div class="certificate-header">
            <div class="certificate-seal">
                <i class="fas fa-award"></i>
            </div>
            <div class="certificate-title">
                <h1>CERTIFICADO <span class="gold-accent">ACADÉMICO</span></h1>
                <p>DE APROVECHAMIENTO Y EXCELENCIA</p>
            </div>
        </div>
        
        <!-- Certificate Body -->
        <div class="certificate-body">
            <div class="certificate-watermark">
                EXCELENCIA
            </div>
            
            <div class="certificate-content">
                <!-- Awarded To -->
                <div class="certificate-awarded">
                    <div class="awarded-to">EL PRESENTE DOCUMENTO SE OTORGA A</div>
                    <h2 class="student-name">{{ strtoupper($certificado->nombre_completo) }}</h2>
                    <div class="certificate-description">
                        Por haber demostrado dedicación, compromiso y haber completado satisfactoriamente 
                        el programa de estudios especializado:
                    </div>
                    <div class="course-name">{{ $certificado->nombre_curso }}</div>
                </div>
                
                <!-- Certificate Details - NUEVA VERSIÓN COMPACTA -->
                <div class="certificate-details">
                    <div class="details-grid">
                        <div class="detail-item">
                            <div class="detail-label">
                                <i class="fas fa-calendar-alt"></i>
                                <span>Fecha de Expedición</span>
                            </div>
                            <div class="detail-value">
                                {{ date('d', strtotime($certificado->fecha_expedicion)) }}
                                de {{ [
                                    '01' => 'Enero', '02' => 'Febrero', '03' => 'Marzo',
                                    '04' => 'Abril', '05' => 'Mayo', '06' => 'Junio',
                                    '07' => 'Julio', '08' => 'Agosto', '09' => 'Setiembre',
                                    '10' => 'Octubre', '11' => 'Noviembre', '12' => 'Diciembre'
                                ][date('m', strtotime($certificado->fecha_expedicion))] }}
                                de {{ date('Y', strtotime($certificado->fecha_expedicion)) }}
                            </div>
                        </div>
                        
                        <div class="detail-item">
                            <div class="detail-label">
                                <i class="fas fa-clock"></i>
                                <span>Duración del Programa</span>
                            </div>
                            <div class="detail-value">
                                {{ $certificado->horas_duracion ?? 6 }} horas académicas certificadas
                            </div>
                        </div>
                        
                        <div class="detail-item">
                            <div class="detail-label">
                                <i class="fas fa-laptop-house"></i>
                                <span>Modalidad de Estudio</span>
                            </div>
                            <div class="detail-value">
                                {{ $certificado->modalidad ?? 'Virtual' }}
                            </div>
                        </div>
                        
                        <div class="detail-item">
                            <div class="detail-label">
                                <i class="fas fa-certificate"></i>
                                <span>Código de Certificación</span>
                            </div>
                            <div class="detail-value">
                                <span class="code">{{ $certificado->codigo_unico }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Certificate Footer -->
                <div class="certificate-footer">
                    <!-- Signatures Section -->
                    <div class="signatures-section">
                        <!-- Instructor Signature -->
                        <div class="instructor-signature">
                            <div class="signature-title">FIRMA DEL INSTRUCTOR</div>
                            <div class="av-signature">
                                <div class="signature-av">Alex Vasquez</div>
                                <div class="signature-name">ALEX VÁSQUEZ VALDERRAMA</div>
                                <div class="signature-credentials">
                                    Especialista en DevOps & Desarrollo Web<br>
                                    Instructor Certificado AYW Solution
                                </div>
                                <div class="signature-separator"></div>
                                {{-- <div class="signature-credentials">
                                    R.U.C. 20605467891<br>
                                    avasquez@aywsolution.com
                                </div> --}}
                            </div>
                        </div>
                        
                        <!-- Institution Stamp -->
                        <div class="institution-stamp">
                            <div class="signature-title">SELLO INSTITUCIONAL</div>
                            <div class="institution-seal">
                                <!-- Imagen PNG del sello -->
                                <img src="{{ asset('assets/img/logo_ayw.png') }}" 
                                    alt="Sello AYW Solution" 
                                    class="seal-image">
                                
                                <div class="institution-name">AYW SOLUTION</div>
                                <div class="institution-details">
                                    Centro de Formación Tecnológica<br>
                                    {{-- RUC 20605467891<br>
                                    Lima, Perú --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Verification Section -->
                    <div class="verification-section">
                        <div class="verification-title">
                            <i class="fas fa-shield-check"></i>
                            CERTIFICADO VERIFICADO DIGITALMENTE
                        </div>
                        <div class="verification-info">
                            Este certificado cuenta con validación digital y puede ser verificado en cualquier momento
                        </div>
                        <div class="verification-code">{{ $certificado->codigo_unico }}</div>
                        <div class="verification-info">
                            Para verificar la autenticidad, visite:<br>
                            <a href="{{ route('certificados.verificar') }}" class="verification-link">
                                {{ route('certificados.verificar') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Action Buttons -->
    <div class="action-buttons no-print">
        <button onclick="window.print()" class="btn-certificate btn-print">
            <i class="fas fa-print"></i> Imprimir Certificado
        </button>

        @if(method_exists($certificado, 'pdf'))
            <a href="{{ route('certificados.pdf', $certificado->url_hash) }}" 
               class="btn-certificate btn-pdf">
                <i class="fas fa-file-pdf"></i> Descargar PDF
            </a>
        @endif
        
        <button onclick="copyToClipboard('{{ route('certificados.show', $certificado->url_hash) }}')" 
                class="btn-certificate btn-copy">
            <i class="fas fa-copy"></i> Copiar Enlace
        </button>
        
        <a href="{{ route('certificados.verificar') }}" 
           class="btn-certificate btn-verify">
            <i class="fas fa-search"></i> Verificar Otro
        </a>
    </div>
    
    <!-- Back Link -->
    <div class="text-center mt-3 no-print">
        <a href="{{ route('certificados.verificar') }}" class="text-decoration-none" style="color: #2c3e50; font-size: 0.9rem;">
            <i class="fas fa-arrow-left me-2"></i> Volver al verificador de certificados
        </a>
    </div>
    
    
    
    
    
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Copy link to clipboard
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(() => {
                showNotification('Enlace copiado al portapapeles', 'success');
            }).catch(err => {
                showNotification('Error al copiar el enlace', 'error');
                console.error('Error al copiar: ', err);
            });
        }
        
        // Función para mostrar notificaciones elegantes
        function showNotification(message, type) {
            const notification = document.createElement('div');
            notification.className = `notification ${type}`;
            notification.innerHTML = `
                <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'} me-2"></i>
                ${message}
            `;
            
            notification.style.cssText = `
                position: fixed;
                top: 15px;
                right: 15px;
                padding: 12px 20px;
                background: ${type === 'success' ? '#2ecc71' : '#e74c3c'};
                color: white;
                border-radius: 6px;
                box-shadow: 0 3px 10px rgba(0,0,0,0.15);
                z-index: 9999;
                display: flex;
                align-items: center;
                animation: slideIn 0.3s ease-out;
                font-weight: 500;
                font-size: 0.9rem;
            `;
            
            document.body.appendChild(notification);
            
            setTimeout(() => {
                notification.style.animation = 'slideOut 0.3s ease-out';
                setTimeout(() => notification.remove(), 300);
            }, 3000);
        }
        
        // Añadir estilos de animación
        const style = document.createElement('style');
        style.textContent = `
            @keyframes slideIn {
                from {
                    transform: translateX(100%);
                    opacity: 0;
                }
                to {
                    transform: translateX(0);
                    opacity: 1;
                }
            }
            
            @keyframes slideOut {
                from {
                    transform: translateX(0);
                    opacity: 1;
                }
                to {
                    transform: translateX(100%);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);
        
        // Auto-hide alert after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                setTimeout(() => {
                    alert.style.transition = 'opacity 0.5s';
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 500);
                }, 5000);
            });
            
            // Add print event listener
            window.addEventListener('beforeprint', () => {
                document.querySelectorAll('.no-print').forEach(el => {
                    el.style.display = 'none';
                });
            });
            
            window.addEventListener('afterprint', () => {
                document.querySelectorAll('.no-print').forEach(el => {
                    el.style.display = '';
                });
            });
            
            // Efecto de firma con movimiento de escritura
            const signature = document.querySelector('.signature-av');
            if (signature) {
                const originalText = signature.textContent;
                signature.textContent = '';
                
                let i = 0;
                const typeWriter = () => {
                    if (i < originalText.length) {
                        signature.textContent += originalText.charAt(i);
                        i++;
                        setTimeout(typeWriter, 50);
                    }
                };
                
                if (!window.matchMedia('print').matches) {
                    setTimeout(typeWriter, 800);
                } else {
                    signature.textContent = originalText;
                }
            }
        });
    </script>


</body>
</html>