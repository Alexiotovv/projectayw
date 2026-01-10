<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ContaboDomainService;

class DomainController extends Controller
{
    protected $domainService;
    
    public function __construct()
    {
        $this->domainService = new ContaboDomainService();
    }
    
    public function checkAvailability(Request $request)
    {
        $request->validate([
            'domain' => 'required|string|min:3'
        ]);
        
        // Limpiar el dominio
        $domain = strtolower(trim($request->domain));
        
        // Asegurar que tenga extensión
        if (strpos($domain, '.') === false) {
            $domain .= '.com';
        }
        
        try {
            $result = $this->domainService->checkAvailability($domain);
            
            return response()->json([
                'success' => $result['success'] ?? true,
                'available' => $result['available'] ?? false,
                'domain' => $result['domain'],
                'price' => $result['price'],
                'price_soles' => $result['price_soles'] ?? null,
                'currency' => $result['currency'],
                'premium' => $result['premium'] ?? false,
                'premium_price' => $result['premium_price'] ?? null,
                'mock' => $result['mock'] ?? false,
                'message' => $result['message'] ?? ($result['available'] 
                    ? '¡Dominio disponible!' 
                    : 'Dominio no disponible'),
                'tld' => $result['tld']
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al verificar dominio: ' . $e->getMessage(),
                'domain' => $domain
            ], 500);
        }
    }
    
    public function getSuggestions(Request $request)
    {
        $request->validate([
            'keyword' => 'required|string|min:2'
        ]);
        
        try {
            $suggestions = $this->domainService->getSuggestions($request->keyword);
            
            return response()->json([
                'success' => true,
                'suggestions' => $suggestions
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener sugerencias'
            ], 500);
        }
    }
}