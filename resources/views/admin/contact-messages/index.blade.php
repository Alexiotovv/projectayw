@extends('bases.admin_base')

@section('title', 'Consultas de Contacto')
@section('page-title', 'Consultas de Contacto')
@section('breadcrumb', 'Contactos Web')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h4 mb-0">Solicitudes del Formulario de Contacto</h2>
    <form method="GET" action="{{ route('admin.contact-messages.index') }}" class="d-flex gap-2">
        <select name="status" class="form-select">
            <option value="">Todos</option>
            <option value="pending" @selected($status === 'pending')>Pendientes</option>
            <option value="contacted" @selected($status === 'contacted')>Contactados</option>
        </select>
        <button class="btn btn-primary" type="submit">Filtrar</button>
    </form>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th>Cliente</th>
                        <th>Asunto</th>
                        <th>Mensaje</th>
                        <th>Idioma</th>
                        <th>Estado</th>
                        <th>Fecha</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($messages as $message)
                    <tr>
                        <td>
                            <strong>{{ $message->name }}</strong>
                            <div class="small text-muted">{{ $message->email }}</div>
                            <div class="small text-muted">{{ $message->phone }}</div>
                        </td>
                        <td>{{ $message->subject }}</td>
                        <td style="max-width: 280px; white-space: normal;">
                            {{ \Illuminate\Support\Str::limit($message->message, 150) }}
                        </td>
                        <td>{{ strtoupper($message->locale ?? 'en') }}</td>
                        <td>
                            <span class="badge bg-{{ $message->status === 'contacted' ? 'success' : 'warning' }}">
                                {{ $message->status }}
                            </span>
                        </td>
                        <td>{{ optional($message->created_at)->format('d/m/Y H:i') }}</td>
                        <td class="text-end">
                            <button type="button"
                                    class="btn btn-sm btn-outline-primary"
                                    data-bs-toggle="modal"
                                    data-bs-target="#updateModal{{ $message->id }}">
                                Gestionar
                            </button>
                            <form method="POST"
                                  action="{{ route('admin.contact-messages.destroy', $message) }}"
                                  class="d-inline"
                                  onsubmit="return confirm('¿Eliminar esta consulta?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>

                    <div class="modal fade" id="updateModal{{ $message->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content">
                                <form method="POST" action="{{ route('admin.contact-messages.update', $message) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h5 class="modal-title">Gestionar consulta de {{ $message->name }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label">Mensaje completo</label>
                                            <div class="form-control" style="height:auto; min-height:120px; white-space: pre-wrap;">{{ $message->message }}</div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="status{{ $message->id }}" class="form-label">Estado</label>
                                            <select id="status{{ $message->id }}" name="status" class="form-select" required>
                                                <option value="pending" @selected($message->status === 'pending')>Pendiente</option>
                                                <option value="contacted" @selected($message->status === 'contacted')>Contactado</option>
                                            </select>
                                        </div>
                                        <div class="mb-0">
                                            <label for="admin_notes{{ $message->id }}" class="form-label">Notas internas</label>
                                            <textarea id="admin_notes{{ $message->id }}" name="admin_notes" class="form-control" rows="4" placeholder="Notas de seguimiento internas">{{ $message->admin_notes }}</textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-4 text-muted">No hay consultas para mostrar.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $messages->links() }}
        </div>
    </div>
</div>
@endsection
