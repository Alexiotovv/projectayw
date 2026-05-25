@extends('bases.admin_base')

@section('title', 'Nuevo Medio de Pago')
@section('page-title', 'Nuevo Medio de Pago')
@section('breadcrumb', 'Pagos')

@section('content')
<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('admin.payment-methods.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Nombre</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Código</label>
                    <select name="code" class="form-select" required>
                        <option value="card">card (Tarjeta)</option>
                        <option value="yape">yape</option>
                        <option value="plin">plin</option>
                        <option value="transfer">transfer</option>
                        <option value="cash">cash</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Tipo</label>
                    <select name="type" class="form-select" required>
                        <option value="card">Tarjeta</option>
                        <option value="qr">QR</option>
                        <option value="transfer">Transferencia</option>
                        <option value="cash">Efectivo</option>
                    </select>
                </div>
                <div class="col-12">
                    <label class="form-label">Instrucciones</label>
                    <textarea name="instructions" rows="4" class="form-control">{{ old('instructions') }}</textarea>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Imagen QR (opcional)</label>
                    <input type="file" name="qr_image" class="form-control" accept="image/*">
                    <small class="text-muted">Úsalo cuando el método sea QR.</small>
                </div>
                <div class="col-md-6">
                    <label class="form-label">URL de Pasarela (Tarjeta)</label>
                    <input type="url" name="gateway_url" class="form-control" value="{{ old('gateway_url') }}" placeholder="https://pasarela.ejemplo.com/pago">
                    <small class="text-muted">Se usa cuando el tipo es tarjeta.</small>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Banco</label>
                    <input type="text" name="bank_name" class="form-control" value="{{ old('bank_name') }}" placeholder="BCP">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Titular de la Cuenta</label>
                    <input type="text" name="bank_account_holder" class="form-control" value="{{ old('bank_account_holder') }}" placeholder="AYW Solution SAC">
                </div>
                <div class="col-md-6">
                    <label class="form-label">N° de Cuenta</label>
                    <input type="text" name="bank_account_number" class="form-control" value="{{ old('bank_account_number') }}" placeholder="191-XXXXXX-0-XX">
                </div>
                <div class="col-md-6">
                    <label class="form-label">CCI</label>
                    <input type="text" name="bank_account_cci" class="form-control" value="{{ old('bank_account_cci') }}" placeholder="002-191-XXXXXXXXXXXXXX">
                    <small class="text-muted">Se usa cuando el tipo es transferencia.</small>
                </div>
                <div class="col-12">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active" checked>
                        <label class="form-check-label" for="is_active">Método activo</label>
                    </div>
                </div>
            </div>

            <div class="mt-3 d-flex gap-2">
                <button type="submit" class="btn btn-primary">Guardar Método</button>
                <a href="{{ route('admin.payment-methods.index') }}" class="btn btn-outline-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection
