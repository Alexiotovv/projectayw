<?php

namespace App\Http\Controllers;

use App\Models\InscripcionCurso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class InscripcionCursoController extends Controller
{
    // Mostrar formulario
    public function create()
    {
        return view('inscripciones.create');
    }

    // Procesar inscripción
    public function store(Request $request)
    {
        // Validación (sin DNI)
        $validator = Validator::make($request->all(), [
            'nombres' => 'required|string|max:100',
            'apellidos' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'modalidad' => 'required|in:virtual,presencial',
            'voucher' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ], [
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Debe ingresar un correo electrónico válido.',
            'voucher.required' => 'Debe subir una imagen del voucher.',
            'voucher.image' => 'El voucher debe ser una imagen.',
            'voucher.max' => 'La imagen no debe superar los 2MB.'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // Subir voucher
        if ($request->hasFile('voucher')) {
            $voucherPath = $request->file('voucher')->store('vouchers', 'public');
        }

        // Guardar inscripción (sin DNI)
        $inscripcion = InscripcionCurso::create([
            'nombres' => $request->nombres,
            'apellidos' => $request->apellidos,
            'email' => $request->email,
            'modalidad' => $request->modalidad,
            'voucher_path' => $voucherPath
        ]);

        // Enviar notificación a Telegram
        $this->enviarATelegram($inscripcion);

        return response()->json([
            'success' => true,
            'message' => '¡Inscripción realizada con éxito! Te contactaremos pronto.',
            'inscripcion_id' => $inscripcion->id
        ]);
    }

    // Función para enviar a Telegram
    private function enviarATelegram($inscripcion)
    {
        $botToken = config('services.telegram.bot_token');
        $chatId = config('services.telegram.chat_id');

        if (!$botToken || !$chatId) {
            \Log::error('Configuración de Telegram no encontrada en .env');
            return;
        }

        $modalidadText = $inscripcion->modalidad == 'virtual' ? 'Virtual (S/ 50)' : 'Presencial (S/ 80)';
        
        $mensaje = "🎓 *NUEVA INSCRIPCIÓN AL CURSO* 🎓\n";
        $mensaje .= "━━━━━━━━━━━━━━━━━━━━\n";
        $mensaje .= "📝 *Nombres:* {$inscripcion->nombres}\n";
        $mensaje .= "📝 *Apellidos:* {$inscripcion->apellidos}\n";
        $mensaje .= "📧 *Correo:* {$inscripcion->email}\n";
        $mensaje .= "🎯 *Modalidad:* {$modalidadText}\n";
        $mensaje .= "━━━━━━━━━━━━━━━━━━━━\n";
        $mensaje .= "🆔 *ID Inscripción:* {$inscripcion->id}\n";
        $mensaje .= "📅 *Fecha:* " . now()->format('d/m/Y H:i') . "\n";
        $mensaje .= "━━━━━━━━━━━━━━━━━━━━\n";
        $mensaje .= "💰 *Voucher:* " . url('storage/' . $inscripcion->voucher_path);

        try {
            Http::post("https://api.telegram.org/bot{$botToken}/sendMessage", [
                'chat_id' => $chatId,
                'text' => $mensaje,
                'parse_mode' => 'Markdown'
            ]);
        } catch (\Exception $e) {
            \Log::error('Error enviando a Telegram: ' . $e->getMessage());
        }
    }
}