<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class ContaboDomainService
{
    // CREDENCIALES CORRECTAS (las que funcionan en curl)
    private $clientId = 'INT-14526605';
    private $clientSecret = 'QrxTt8SHoz2xOv14squh4tC0CY73Yv3A';
    private $apiUser = 'gpsalexvasquez@gmail.com';
    private $apiPassword = 'w0UrWk3t2uwB1#';
    private $baseUrl = 'https://api.contabo.com/v1';
    
    private $accessToken;
    
    public function authenticate()
    {
        // Intentar obtener token del cache primero
        $this->accessToken = Cache::get('contabo_access_token');
        
        if (!$this->accessToken) {
            try {
                Log::info('Obteniendo nuevo token de Contabo...');
                
                // SIN scope parameter - como funciona en curl
                $response = Http::asForm()
                    ->post('https://auth.contabo.com/auth/realms/contabo/protocol/openid-connect/token', [
                        'client_id' => $this->clientId,
                        'client_secret' => $this->clientSecret,
                        'username' => $this->apiUser,
                        'password' => $this->apiPassword,
                        'grant_type' => 'password'
                    ]);
                
                Log::info('Respuesta de autenticación Contabo', [
                    'status' => $response->status(),
                    'body_length' => strlen($response->body())
                ]);
                
                if ($response->successful()) {
                    $data = $response->json();
                    $this->accessToken = $data['access_token'];
                    
                    if (empty($this->accessToken)) {
                        throw new \Exception('Token vacío recibido');
                    }
                    
                    // Cache por 4 minutos (token dura 5 minutos)
                    Cache::put('contabo_access_token', $this->accessToken, 4 * 60);
                    
                    Log::info('✅ Token Contabo obtenido exitosamente', [
                        'token_length' => strlen($this->accessToken),
                        'expires_in' => $data['expires_in'] ?? 'unknown'
                    ]);
                    
                    return $this;
                } else {
                    $errorBody = $response->body();
                    Log::error('❌ Error de autenticación Contabo', [
                        'status' => $response->status(),
                        'body' => $errorBody
                    ]);
                    
                    throw new \Exception('Error HTTP ' . $response->status() . ': ' . $errorBody);
                }
            } catch (\Exception $e) {
                Log::error('💥 Excepción en autenticación Contabo', [
                    'message' => $e->getMessage()
                ]);
                throw $e;
            }
        } else {
            Log::info('Usando token cacheado de Contabo');
        }
        
        return $this;
    }
    
    public function checkAvailability($domain)
    {
        // MODE: true = usar API real, false = modo simulación
        $USE_REAL_API = true;
        
        if (!$USE_REAL_API) {
            return $this->getMockResponse($domain);
        }
        
        try {
            $this->authenticate();
            
            // Limpiar y validar dominio
            $domain = $this->cleanDomain($domain);
            if (!$this->isValidDomain($domain)) {
                return [
                    'success' => false,
                    'available' => false,
                    'error' => 'Formato de dominio inválido. Usa: ejemplo.com',
                    'domain' => $domain
                ];
            }
            
            Log::info('🔍 Consultando disponibilidad en Contabo API:', ['domain' => $domain]);
            
            // Generar UUID v4 para x-request-id
            $requestId = $this->generateUuid4();
            
            // Endpoint CORRECTO: POST /v1/registries-domains/{domain}/check-availability
            $url = $this->baseUrl . '/registries-domains/' . urlencode($domain) . '/check-availability';
            
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->accessToken,
                'x-request-id' => $requestId,
                'Accept' => 'application/json'
            ])->post($url);
            
            Log::info('📡 Respuesta Contabo API:', [
                'domain' => $domain,
                'url' => $url,
                'status' => $response->status(),
                'headers' => $response->headers(),
                'body' => $response->body()
            ]);
            
            // Interpretar respuesta según documentación:
            // 204 = disponible, 404 = no disponible
            if ($response->status() === 204) {
                return $this->formatSuccessResponse($domain, true);
            } 
            elseif ($response->status() === 404) {
                return $this->formatSuccessResponse($domain, false);
            }
            else {
                Log::warning('Código de respuesta inesperado:', [
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);
                
                return $this->getMockResponse($domain);
            }
            
        } catch (\Exception $e) {
            Log::error('💥 Error en checkAvailability:', [
                'domain' => $domain,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return $this->getMockResponse($domain, true);
        }
    }
    
    private function cleanDomain($domain)
    {
        $domain = strtolower(trim($domain));
        $domain = preg_replace('/^https?:\/\//', '', $domain);
        $domain = preg_replace('/^www\./', '', $domain);
        return trim($domain);
    }
    
    private function isValidDomain($domain)
    {
        if (empty($domain) || strlen($domain) < 4) {
            return false;
        }
        
        $pattern = '/^([a-z0-9]+(-[a-z0-9]+)*\.)+[a-z]{2,}$/i';
        return preg_match($pattern, $domain);
    }
    
    private function formatSuccessResponse($domain, $isAvailable)
    {
        $tld = '.com';
        if (strpos($domain, '.') !== false) {
            $parts = explode('.', $domain);
            $tld = '.' . end($parts);
        }
        
        return [
            'success' => true,
            'available' => $isAvailable,
            'price' => $this->getDomainPrice($tld),
            'price_soles' => $this->convertToSoles($this->getDomainPrice($tld)),
            'currency' => 'EUR',
            'tld' => $tld,
            'domain' => $domain,
            'premium' => false,
            'premium_price' => null,
            'real_api' => true,
            'message' => $isAvailable 
                ? '¡Dominio disponible!' 
                : 'Dominio no disponible'
        ];
    }
    
    private function generateUuid4()
    {
        try {
            $data = random_bytes(16);
            $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
            $data[8] = chr(ord($data[8]) & 0x3f | 0x80);
            
            return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
        } catch (\Exception $e) {
            return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
                mt_rand(0, 0xffff), mt_rand(0, 0xffff),
                mt_rand(0, 0xffff),
                mt_rand(0, 0x0fff) | 0x4000,
                mt_rand(0, 0x3fff) | 0x8000,
                mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
            );
        }
    }
    
    private function getMockResponse($domain, $isError = false)
    {
        if ($isError) {
            return [
                'success' => false,
                'available' => false,
                'error' => 'Error de conexión con la API',
                'domain' => $domain,
                'mock' => true
            ];
        }
        
        $tld = '.com';
        if (strpos($domain, '.') !== false) {
            $parts = explode('.', $domain);
            $tld = '.' . end($parts);
        }
        
        $alwaysTaken = ['google.com', 'facebook.com', 'amazon.com', 'youtube.com', 'twitter.com'];
        $available = !in_array(strtolower($domain), $alwaysTaken);
        
        if (!in_array(strtolower($domain), $alwaysTaken)) {
            $available = rand(0, 100) > 30;
        }
        
        return [
            'success' => true,
            'available' => $available,
            'price' => $this->getDomainPrice($tld),
            'price_soles' => $this->convertToSoles($this->getDomainPrice($tld)),
            'currency' => 'EUR',
            'tld' => $tld,
            'domain' => $domain,
            'premium' => false,
            'premium_price' => null,
            'mock' => true,
            'message' => $available 
                ? '¡Dominio disponible! (modo desarrollo)' 
                : 'Dominio no disponible (modo desarrollo)'
        ];
    }
    
    private function getDomainPrice($tld)
    {
        $prices = [
            '.com' => 10.99,
            '.net' => 11.99,
            '.org' => 11.99,
            '.pe' => 35.00,
            '.com.pe' => 25.00,
            '.io' => 39.99,
            '.co' => 29.99,
            '.info' => 9.99,
            '.biz' => 9.99,
        ];
        
        return $prices[$tld] ?? 12.99;
    }
    
    private function convertToSoles($euros)
    {
        $exchangeRate = 4.10;
        return round($euros * $exchangeRate, 2);
    }
}