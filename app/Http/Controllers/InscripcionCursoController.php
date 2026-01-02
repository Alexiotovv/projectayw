<?php

namespace App\Http\Controllers;

use App\Models\InscripcionCurso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
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
        // Validación
        $validator = Validator::make($request->all(), [
            'dni' => 'required|digits:8',
            'nombres' => 'required|string|max:100',
            'apellidos' => 'required|string|max:100',
            'modalidad' => 'required|in:virtual,presencial',
            'voucher' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ], [
            'dni.digits' => 'El DNI debe tener 8 dígitos.',
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

        // Guardar inscripción
        $inscripcion = InscripcionCurso::create([
            'dni' => $request->dni,
            'nombres' => $request->nombres,
            'apellidos' => $request->apellidos,
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
        $botToken = '7176635834:AAE4_aIsLrY_arta5vj3PbjHR6ghSpxHt1k'; // Tu token
        $chatId = '6543016341'; // Tu chat ID

        $modalidadText = $inscripcion->modalidad == 'virtual' ? 'Virtual (S/ 50)' : 'Presencial (S/ 80)';
        
        $mensaje = "🎓 *NUEVA INSCRIPCIÓN AL CURSO* 🎓\n";
        $mensaje .= "━━━━━━━━━━━━━━━━━━━━\n";
        $mensaje .= "👤 *DNI:* {$inscripcion->dni}\n";
        $mensaje .= "📝 *Nombres:* {$inscripcion->nombres}\n";
        $mensaje .= "📝 *Apellidos:* {$inscripcion->apellidos}\n";
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