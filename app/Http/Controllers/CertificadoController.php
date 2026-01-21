<?php

namespace App\Http\Controllers;

use App\Models\Certificado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class CertificadoController extends Controller
{
    // Mostrar lista de certificados (admin)
    public function index()
    {
        $certificados = Certificado::latest()->paginate(10);
        return view('certificados.index', compact('certificados'));
    }

    // Mostrar formulario para crear certificado
    public function create()
    {
        return view('certificados.create');
    }

    // Almacenar nuevo certificado
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre_completo' => 'required|string|max:255',
            'nombre_curso' => 'required|string|max:255',
            'fecha_expedicion' => 'required|date',
            'email' => 'nullable|email',
            'modalidad' => 'nullable|string|max:50',
            'horas_duracion' => 'nullable|integer|min:1',
            'habilidades' => 'nullable|string',
            'publico' => 'boolean',
            'enviar_email' => 'boolean'
        ]);

        $habilidadesDefault = 'Apache, Fail2Ban, UFW, Git, Laravel, Dominio, DNS, SSH, PHP, MySQL';
        
        $certificado = Certificado::create([
            'nombre_completo' => $validated['nombre_completo'],
            'nombre_curso' => $validated['nombre_curso'],
            'fecha_expedicion' => $validated['fecha_expedicion'],
            'email' => $validated['email'],
            'modalidad' => $validated['modalidad'] ?? 'Virtual',
            'horas_duracion' => $validated['horas_duracion'] ?? 6,
            'habilidades' => $validated['habilidades'] ?? $habilidadesDefault,
            'publico' => $validated['publico'] ?? true,
            'instructor' => 'Alex Vásquez'
        ]);

        // Opcional: Enviar email
        if ($request->has('enviar_email') && $certificado->email) {
            $this->enviarCertificadoEmail($certificado);
        }

        return redirect()->route('certificados.index')
            ->with('success', "Certificado creado exitosamente para {$certificado->nombre_completo}");
    }

    // Mostrar certificado público
    public function show($hash)
    {
        $certificado = Certificado::where('url_hash', $hash)
            ->where('publico', true)
            ->firstOrFail();

        return view('certificados.show', compact('certificado'));
    }

    // Mostrar formulario de edición
    public function edit($id)
    {
        $certificado = Certificado::findOrFail($id);
        return view('certificados.edit', compact('certificado'));
    }

    // Actualizar certificado
    public function update(Request $request, $id)
    {
        $certificado = Certificado::findOrFail($id);

        $validated = $request->validate([
            'nombre_completo' => 'required|string|max:255',
            'nombre_curso' => 'required|string|max:255',
            'fecha_expedicion' => 'required|date',
            'email' => 'nullable|email',
            'modalidad' => 'nullable|string|max:50',
            'horas_duracion' => 'nullable|integer|min:1',
            'habilidades' => 'nullable|string',
            'publico' => 'boolean'
        ]);

        $certificado->update($validated);

        return redirect()->route('certificados.index')
            ->with('success', "Certificado actualizado exitosamente");
    }

    // Eliminar certificado
    public function destroy($id)
    {
        $certificado = Certificado::findOrFail($id);
        $nombre = $certificado->nombre_completo;
        $certificado->delete();

        return redirect()->route('certificados.index')
            ->with('success', "Certificado de {$nombre} eliminado exitosamente");
    }

    // Generar PDF del certificado
    public function pdf($hash)
    {
        $certificado = Certificado::where('url_hash', $hash)
            ->where('publico', true)
            ->firstOrFail();

        $pdf = Pdf::loadView('certificados.pdf', compact('certificado'));
        return $pdf->download("certificado-{$certificado->codigo_unico}.pdf");
    }

    // Vista previa del certificado (para admin)
    public function preview()
    {
        $data = json_decode(session()->get('preview_data'), true);
        
        if (!$data) {
            abort(404);
        }

        // Crear objeto temporal para la vista previa
        $certificado = new \stdClass();
        $certificado->nombre_completo = $data['nombre_completo'] ?? 'Nombre del Estudiante';
        $certificado->nombre_curso = $data['nombre_curso'] ?? 'Curso Taller: Implementación de un VPS + Laravel, desde cero';
        $certificado->fecha_expedicion = $data['fecha_expedicion'] ?? date('Y-m-d');
        $certificado->horas_duracion = $data['horas_duracion'] ?? 6;
        $certificado->modalidad = $data['modalidad'] ?? 'Virtual';
        $certificado->instructor = 'Alex Vásquez';
        $certificado->codigo_unico = 'PREVIEW-' . strtoupper(\Illuminate\Support\Str::random(8));
        $certificado->habilidades_array = $data['habilidades'] 
            ? explode(',', $data['habilidades']) 
            : ['Apache', 'Laravel', 'Git', 'MySQL'];

        return view('certificados.show', compact('certificado'));
    }

    // Buscar certificado por código (público)
    public function buscar(Request $request)
    {
        $request->validate([
            'codigo' => 'required|string|max:50'
        ]);

        $certificado = Certificado::where('codigo_unico', strtoupper($request->codigo))
            ->orWhere('url_hash', $request->codigo)
            ->where('publico', true)
            ->first();

        if (!$certificado) {
            return redirect()->route('certificados.verificar')
                ->with('error', 'Certificado no encontrado. Verifica el código e intenta nuevamente.');
        }

        return redirect()->route('certificados.show', $certificado->url_hash);
    }

    // Página de verificación pública
    public function verificar()
    {
        return view('certificados.verificar');
    }

    // Método privado para enviar email
    private function enviarCertificadoEmail($certificado)
    {
        try {
            Mail::send('emails.certificado', ['certificado' => $certificado], function($message) use ($certificado) {
                $message->to($certificado->email)
                        ->subject("Tu Certificado de Finalización - {$certificado->nombre_curso}")
                        ->from(config('mail.from.address'), config('mail.from.name'));
            });
        } catch (\Exception $e) {
            \Log::error('Error enviando certificado por email: ' . $e->getMessage());
        }
    }
}