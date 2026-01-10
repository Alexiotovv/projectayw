@extends('customer.layouts.app')

@section('title', 'Mis Servicios')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h4">Mis Servicios</h2>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newServiceModal">
        <i class="fas fa-plus me-2"></i>Contratar Servicio
    </button>
</div>

@if($services->isEmpty())
<div class="card shadow">
    <div class="card-body text-center py-5">
        <i class="fas fa-server fa-4x text-muted mb-3"></i>
        <h5>No tienes servicios contratados</h5>
        <p class="text-muted">Comienza contratando tu primer servicio de correo corporativo.</p>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newServiceModal">
            Contratar Primer Servicio
        </button>
    </div>
</div>
@else
<div class="card shadow">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Servicio</th>
                        <th>Tipo</th>
                        <th>Plan</th>
                        <th>Correos/Espacio</th>
                        <th>Estado</th>
                        <th>Vencimiento</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($services as $service)
                    <tr>
                        <td>
                            <strong>{{ $service->name }}</strong><br>
                            <small class="text-muted">{{ $service->domain }}</small>
                        </td>
                        <td>
                            @switch($service->type)
                                @case('email')
                                    <span class="badge bg-info">Correo</span>
                                    @break
                                @case('hosting')
                                    <span class="badge bg-success">Hosting</span>
                                    @break
                                @case('domain')
                                    <span class="badge bg-warning">Dominio</span>
                                    @break
                            @endswitch
                        </td>
                        <td>{{ $service->plan }}</td>
                        <td>
                            @if($service->type == 'email')
                                <i class="fas fa-envelope me-1"></i> {{ $service->email_accounts }} cuentas<br>
                                <i class="fas fa-database me-1"></i> {{ $service->storage_gb }} GB
                            @else
                                <i class="fas fa-database me-1"></i> {{ $service->storage_gb }} GB
                            @endif
                        </td>
                        <td>
                            <span class="badge bg-{{ $service->status == 'active' ? 'success' : ($service->status == 'suspended' ? 'warning' : 'danger') }}">
                                {{ $service->status }}
                            </span>
                        </td>
                        <td>
                            {{ $service->expiry_date->format('d/m/Y') }}<br>
                            <small class="text-muted">{{ $service->expiry_date->diffForHumans() }}</small>
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('customer.services.show', $service->id) }}" 
                                   class="btn btn-info" title="Ver detalles">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @if($service->status == 'active')
                                <a href="{{ route('customer.services.requestSupport', $service->id) }}" 
                                   class="btn btn-warning" title="Soporte">
                                    <i class="fas fa-headset"></i>
                                </a>
                                <a href="{{ route('customer.services.requestRenewal', $service->id) }}" 
                                   class="btn btn-success" title="Renovar">
                                    <i class="fas fa-redo"></i>
                                </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- Paginación -->
        <div class="d-flex justify-content-center mt-3">
            {{ $services->links() }}
        </div>
    </div>
</div>
@endif

<!-- Modal para nuevo servicio -->
<div class="modal fade" id="newServiceModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Contratar Nuevo Servicio</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <h6 class="mb-3">Planes de Correo Corporativo</h6>
                <div class="row">
                    <!-- Plan Básico -->
                    <div class="col-md-4 mb-3">
                        <div class="card border-primary h-100">
                            <div class="card-header bg-primary text-white text-center">
                                <h5 class="mb-0">Básico</h5>
                            </div>
                            <div class="card-body text-center">
                                <h3 class="card-title">S/. 29.90<span class="text-muted small">/mes</span></h3>
                                <ul class="list-unstyled mt-3 mb-4">
                                    <li><i class="fas fa-check text-success me-2"></i>10 cuentas de correo</li>
                                    <li><i class="fas fa-check text-success me-2"></i>10 GB de almacenamiento</li>
                                    <li><i class="fas fa-check text-success me-2"></i>Soporte 24/7</li>
                                    <li><i class="fas fa-check text-success me-2"></i>Antivirus y antispam</li>
                                </ul>
                            </div>
                            <div class="card-footer text-center">
                                <button class="btn btn-outline-primary w-100" onclick="selectPlan('Básico', 29.90)">
                                    Seleccionar
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Plan Profesional -->
                    <div class="col-md-4 mb-3">
                        <div class="card border-success h-100">
                            <div class="card-header bg-success text-white text-center">
                                <h5 class="mb-0">Profesional</h5>
                                <span class="badge bg-warning">Más Popular</span>
                            </div>
                            <div class="card-body text-center">
                                <h3 class="card-title">S/. 49.90<span class="text-muted small">/mes</span></h3>
                                <ul class="list-unstyled mt-3 mb-4">
                                    <li><i class="fas fa-check text-success me-2"></i>20 cuentas de correo</li>
                                    <li><i class="fas fa-check text-success me-2"></i>20 GB de almacenamiento</li>
                                    <li><i class="fas fa-check text-success me-2"></i>Soporte prioritario</li>
                                    <li><i class="fas fa-check text-success me-2"></i>Webmail móvil</li>
                                    <li><i class="fas fa-check text-success me-2"></i>Backup diario</li>
                                </ul>
                            </div>
                            <div class="card-footer text-center">
                                <button class="btn btn-success w-100" onclick="selectPlan('Profesional', 49.90)">
                                    Seleccionar
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Plan Empresarial -->
                    <div class="col-md-4 mb-3">
                        <div class="card border-warning h-100">
                            <div class="card-header bg-warning text-white text-center">
                                <h5 class="mb-0">Empresarial</h5>
                            </div>
                            <div class="card-body text-center">
                                <h3 class="card-title">S/. 89.90<span class="text-muted small">/mes</span></h3>
                                <ul class="list-unstyled mt-3 mb-4">
                                    <li><i class="fas fa-check text-success me-2"></i>50 cuentas de correo</li>
                                    <li><i class="fas fa-check text-success me-2"></i>50 GB de almacenamiento</li>
                                    <li><i class="fas fa-check text-success me-2"></i>Soporte dedicado</li>
                                    <li><i class="fas fa-check text-success me-2"></i>Migración incluida</li>
                                    <li><i class="fas fa-check text-success me-2"></i>Panel administrativo</li>
                                </ul>
                            </div>
                            <div class="card-footer text-center">
                                <button class="btn btn-outline-warning w-100" onclick="selectPlan('Empresarial', 89.90)">
                                    Seleccionar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Formulario de contratación (oculto inicialmente) -->
                <div id="contractForm" style="display: none;">
                    <hr>
                    <form id="serviceForm">
                        @csrf
                        <input type="hidden" id="selectedPlan" name="plan">
                        <input type="hidden" id="selectedPrice" name="price">
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="domain" class="form-label">Dominio *</label>
                                <input type="text" class="form-control" id="domain" name="domain" 
                                       placeholder="ejemplo.com" required>
                                <small class="text-muted">Debes ser el propietario del dominio</small>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="serviceName" class="form-label">Nombre del Servicio *</label>
                                <input type="text" class="form-control" id="serviceName" name="service_name" 
                                       placeholder="Correos de Mi Empresa" required>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="billingCycle" class="form-label">Ciclo de Facturación *</label>
                                <select class="form-control" id="billingCycle" name="billing_cycle" required>
                                    <option value="monthly">Mensual</option>
                                    <option value="quarterly">Trimestral (-5%)</option>
                                    <option value="semiannual">Semestral (-10%)</option>
                                    <option value="annual">Anual (-15%)</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="autoRenew" class="form-label">Renovación Automática</label>
                                <select class="form-control" id="autoRenew" name="auto_renew">
                                    <option value="1">Sí, renovar automáticamente</option>
                                    <option value="0">No, notificarme antes</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="alert alert-info">
                            <h6><i class="fas fa-info-circle me-2"></i>Proceso de Activación</h6>
                            <p class="mb-0 small">
                                1. Completa este formulario<br>
                                2. Generaremos la factura<br>
                                3. Realiza el pago<br>
                                4. Configuraremos tu servicio en 24 horas<br>
                                5. Te enviaremos las credenciales por email
                            </p>
                        </div>
                        
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-secondary" onclick="backToPlans()">
                                <i class="fas fa-arrow-left me-2"></i>Volver a Planes
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-file-invoice me-2"></i>Generar Factura
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function selectPlan(plan, price) {
        document.getElementById('selectedPlan').value = plan;
        document.getElementById('selectedPrice').value = price;
        
        // Mostrar formulario
        document.getElementById('contractForm').style.display = 'block';
        
        // Auto-completar nombre del servicio
        document.getElementById('serviceName').value = 'Correos Corporativos ' + plan;
        
        // Hacer scroll al formulario
        document.getElementById('contractForm').scrollIntoView({ behavior: 'smooth' });
    }
    
    function backToPlans() {
        document.getElementById('contractForm').style.display = 'none';
        document.getElementById('serviceForm').reset();
    }
    
    // Enviar formulario
    document.getElementById('serviceForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Aquí iría la lógica para enviar al backend
        // Por ahora mostramos un mensaje
        alert('Función de contratación en desarrollo. Pronto podrás contratar servicios automáticamente.');
        
        // Cerrar modal
        var modal = bootstrap.Modal.getInstance(document.getElementById('newServiceModal'));
        modal.hide();
    });
</script>
@endsection