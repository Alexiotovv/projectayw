<?php

namespace App\Http\Controllers;

use App\Models\SolicitudCorreo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class EmailCorporateController extends Controller
{
    public function index()
    {
        $commonFeatures = [
            __('email_corporate.feature_antivirus'),
            __('email_corporate.feature_antispam'),
            __('email_corporate.feature_autoresponders'),
            __('email_corporate.feature_protocols'),
            __('email_corporate.feature_webmail'),
        ];

        $plans = [
            [
                'id'          => 'personal',
                'name'        => __('email_corporate.plan_personal'),
                'price'       => '9.90',
                'features'    => array_merge(
                    [
                        __('email_corporate.feature_accounts_5'),
                        __('email_corporate.feature_disk_10'),
                    ],
                    $commonFeatures,
                    [__('email_corporate.feature_forwarders_2')]
                ),
                'recommended' => false,
                'popular'     => false,
            ],
            [
                'id'          => 'premium',
                'name'        => __('email_corporate.plan_premium'),
                'price'       => '14.90',
                'features'    => array_merge(
                    [
                        __('email_corporate.feature_accounts_10'),
                        __('email_corporate.feature_disk_25'),
                    ],
                    $commonFeatures,
                    [__('email_corporate.feature_forwarders_5')]
                ),
                'recommended' => true,
                'popular'     => true,
            ],
            [
                'id'          => 'avanzado',
                'name'        => __('email_corporate.plan_advanced'),
                'price'       => '24.90',
                'features'    => array_merge(
                    [
                        __('email_corporate.feature_accounts_20'),
                        __('email_corporate.feature_disk_50'),
                    ],
                    $commonFeatures,
                    [__('email_corporate.feature_forwarders_10')]
                ),
                'recommended' => false,
                'popular'     => false,
            ],
        ];

        $serviceInfo = [
            'title'    => __('email_corporate.service_title'),
            'subtitle' => __('email_corporate.service_subtitle'),
            'faq'      => [
                ['question' => __('email_corporate.faq_q1'), 'answer' => __('email_corporate.faq_a1')],
                ['question' => __('email_corporate.faq_q2'), 'answer' => __('email_corporate.faq_a2')],
                ['question' => __('email_corporate.faq_q3'), 'answer' => __('email_corporate.faq_a3')],
                ['question' => __('email_corporate.faq_q4'), 'answer' => __('email_corporate.faq_a4')],
            ],
        ];

        return view('email-corporate.index', compact('plans', 'serviceInfo'));
    }

    public function contactForm(Request $request)
    {
        // Validación mejorada
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'company' => 'required|string|max:255',
            'plan' => 'required|string|in:personal,premium,avanzado',
            'domain_type' => 'required|in:new,existing',
            'selected_domain' => 'nullable|string|max:255',
            'existing_domain' => 'nullable|string|max:255',
            'current_service' => 'nullable|string',
            'message' => 'nullable|string|max:1000',
            'request_type' => 'nullable|in:contract,trial'
        ], [
            'name.required' => 'El nombre completo es obligatorio.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Debe ingresar un correo electrónico válido.',
            'phone.required' => 'El teléfono es obligatorio.',
            'company.required' => 'El nombre de la empresa es obligatorio.',
            'plan.required' => 'Debe seleccionar un plan.',
            'selected_domain.required_if' => 'Debe seleccionar un dominio de la lista.'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
                'message' => 'Por favor corrige los errores del formulario.'
            ], 422);
        }

        // Determinar el dominio final
        $dominioFinal = null;
        $tipoDominio = $request->domain_type === 'new' ? 'nuevo' : 'existente';

        if ($request->domain_type === 'new') {
            $dominioFinal = $request->selected_domain;
        } else {
            $dominioFinal = $request->existing_domain;
        }

        // Precios del dominio (si aplica)
        $preciosDominio = $this->obtenerPrecioDominio($dominioFinal);

        // Guardar en base de datos
        try {
            $solicitud = SolicitudCorreo::create([
                'plan' => $request->plan,
                'nombre_completo' => $request->name,
                'empresa' => $request->company,
                'email' => $request->email,
                'telefono' => $request->phone,
                'tipo_dominio' => $tipoDominio,
                'dominio' => $tipoDominio === 'existente' ? $dominioFinal : null,
                'dominio_seleccionado' => $tipoDominio === 'nuevo' ? $dominioFinal : null,
                'servicio_actual' => $request->current_service,
                'mensaje' => $request->message,
                'tipo_solicitud' => $request->request_type === 'trial' ? 'prueba_gratuita' : 'contratacion',
                'estado' => 'pendiente',
                'precio_dominio_eur' => $preciosDominio['eur'] ?? null,
                'precio_dominio_soles' => $preciosDominio['soles'] ?? null,
            ]);

            // Enviar notificación a Telegram
            $this->enviarATelegram($solicitud);

            // Enviar email de confirmación al cliente (opcional)
            // $this->enviarEmailConfirmacion($solicitud);

            return response()->json([
                'success' => true,
                'message' => '¡Gracias por tu interés! Nos pondremos en contacto contigo en menos de 24 horas.',
                'solicitud_id' => $solicitud->id
            ]);

        } catch (\Exception $e) {
            \Log::error('Error guardando solicitud de correo: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Hubo un error al procesar tu solicitud. Por favor intenta nuevamente.'
            ], 500);
        }
    }

    // Función auxiliar para obtener precio del dominio
    private function obtenerPrecioDominio($dominio)
    {
        if (!$dominio) return null;

        $tld = substr($dominio, strrpos($dominio, '.'));

        $precios = [
            '.com' => ['eur' => 10.99, 'soles' => 45.10],
            '.net' => ['eur' => 11.99, 'soles' => 49.20],
            '.org' => ['eur' => 11.99, 'soles' => 49.20],
            '.pe' => ['eur' => 35.00, 'soles' => 143.50],
            '.com.pe' => ['eur' => 25.00, 'soles' => 102.50],
            '.io' => ['eur' => 39.99, 'soles' => 164.00],
            '.co' => ['eur' => 29.99, 'soles' => 123.00],
            '.info' => ['eur' => 9.99, 'soles' => 41.00],
            '.biz' => ['eur' => 9.99, 'soles' => 41.00]
        ];

        return $precios[$tld] ?? null;
    }

    // Función para enviar notificación a Telegram
    private function enviarATelegram(SolicitudCorreo $solicitud)
    {
        \Log::info('=== INICIANDO ENVÍO TELEGRAM ===');

        $botToken = config('services.telegram.bot_token_emailcorporate');
        $chatId = config('services.telegram.chat_id_emailcorporate');

        \Log::info('Bot Token: ' . ($botToken ? 'CONFIGURADO' : 'NO CONFIGURADO'));
        \Log::info('Chat ID: ' . ($chatId ? 'CONFIGURADO' : 'NO CONFIGURADO'));

        if (!$botToken || !$chatId) {
            \Log::error('Configuración de Telegram no encontrada en .env');
            return;
        }
        // Determinar tipo de solicitud
        $tipoSolicitud = $solicitud->tipo_solicitud === 'prueba_gratuita' ? 'PRUEBA GRATUITA' : 'CONTRATACIÓN';

        // Precios
        $preciosPlanes = [
            'personal' => 'S/ 9.90',
            'premium' => 'S/ 14.90',
            'avanzado' => 'S/ 24.90'
        ];

        $precioPlan = $preciosPlanes[$solicitud->plan] ?? 'N/A';

        $mensaje = "📧 *NUEVA SOLICITUD DE CORREO CORPORATIVO* 📧\n";
        $mensaje .= "━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
        $mensaje .= "🎯 *Tipo:* {$tipoSolicitud}\n";
        $mensaje .= "📋 *Plan:* {$solicitud->nombre_plan} ({$precioPlan}/mes)\n";
        $mensaje .= "🏢 *Empresa:* {$solicitud->empresa}\n";
        $mensaje .= "👤 *Contacto:* {$solicitud->nombre_completo}\n";
        $mensaje .= "📞 *Teléfono:* {$solicitud->telefono}\n";
        $mensaje .= "📧 *Email:* {$solicitud->email}\n";
        $mensaje .= "🌐 *Dominio:* {$solicitud->dominio_final}\n";
        $mensaje .= "📌 *Tipo Dominio:* " . ($solicitud->tipo_dominio === 'nuevo' ? 'Nuevo registro' : 'Dominio existente') . "\n";

        if ($solicitud->tipo_dominio === 'nuevo' && $solicitud->precio_dominio_soles) {
            $mensaje .= "💰 *Costo Dominio:* S/ " . number_format($solicitud->precio_dominio_soles, 2) . " / año\n";
        }

        if ($solicitud->servicio_actual) {
            $servicios = [
                'none' => 'Primer servicio',
                'gmail' => 'Gmail/Outlook personal',
                'other' => 'Otro proveedor'
            ];
            $mensaje .= "🔄 *Servicio Actual:* " . ($servicios[$solicitud->servicio_actual] ?? $solicitud->servicio_actual) . "\n";
        }

        if ($solicitud->mensaje) {
            $mensaje .= "💬 *Comentarios:* {$solicitud->mensaje}\n";
        }

        $mensaje .= "━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
        $mensaje .= "🆔 *ID Solicitud:* #{$solicitud->id}\n";
        $mensaje .= "📅 *Fecha:* " . $solicitud->created_at->format('d/m/Y H:i') . "\n";
        $mensaje .= "📊 *Total:* S/ " . $this->calcularTotal($solicitud) . "\n";
        $mensaje .= "━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
        // $mensaje .= "🔗 *Ver en Panel:* " . route('admin.solicitudes.show', $solicitud->id);

        try {
            $response = Http::timeout(10)->post("https://api.telegram.org/bot{$botToken}/sendMessage", [
                'chat_id' => $chatId,
                'text' => $mensaje,
                'parse_mode' => 'Markdown',
                'disable_web_page_preview' => true
            ]);

            if (!$response->successful()) {
                \Log::error('Error Telegram: ' . $response->body());
            }

        } catch (\Exception $e) {
            \Log::error('Error enviando a Telegram: ' . $e->getMessage());
        }
    }

    // Calcular total (plan + dominio si aplica)
    private function calcularTotal($solicitud)
    {
        $total = $solicitud->precio_plan;

        // Si es dominio nuevo, sumar precio del dominio (dividido entre 12 meses)
        if ($solicitud->tipo_dominio === 'nuevo' && $solicitud->precio_dominio_soles) {
            $total += ($solicitud->precio_dominio_soles / 12);
        }

        return number_format($total, 2);
    }


}