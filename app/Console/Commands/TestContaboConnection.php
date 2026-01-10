<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\ContaboDomainService;

class TestContaboConnection extends Command
{
    protected $signature = 'contabo:test-connection';
    protected $description = 'Test Contabo API connection with detailed output';
    
    public function handle()
    {
        $service = new ContaboDomainService();
        
        $this->info('🔄 Probando conexión con API de Contabo...');
        $this->line('');
        
        // 1. Probar autenticación
        $this->info('1. Probando autenticación...');
        try {
            $service->authenticate();
            $this->info('   ✅ Autenticación exitosa');
        } catch (\Exception $e) {
            $this->error('   ❌ Error de autenticación: ' . $e->getMessage());
            $this->line('   Credenciales usadas:');
            $this->line('   - Client ID: INT-14526605');
            $this->line('   - API User: gpsalexvasquez@gmail.com');
            return 1;
        }
        
        $this->line('');
        
        // 2. Probar endpoint de prueba
        $this->info('2. Probando endpoints de la API...');
        $testResult = $service->testApiConnection();
        
        if ($testResult['auth_success']) {
            $this->info('   ✅ Conexión API exitosa');
            $this->line('   Status /domains: ' . $testResult['domains_status']);
            $this->line('   Status /tlds: ' . $testResult['tlds_status']);
            
            if ($testResult['tlds_data']) {
                $this->line('   TLDs disponibles:');
                $tlds = array_slice($testResult['tlds_data']['data'] ?? [], 0, 10);
                foreach ($tlds as $tld) {
                    $this->line('   - ' . ($tld['tld'] ?? 'N/A'));
                }
                if (count($testResult['tlds_data']['data'] ?? []) > 10) {
                    $this->line('   ... y ' . (count($testResult['tlds_data']['data']) - 10) . ' más');
                }
            }
        } else {
            $this->error('   ❌ Error en conexión API: ' . $testResult['error']);
        }
        
        $this->line('');
        
        // 3. Probar búsqueda de dominio
        $this->info('3. Probando búsqueda de dominio...');
        $testDomains = ['google.com', 'midominio-test-' . time() . '.com'];
        
        foreach ($testDomains as $testDomain) {
            $this->line("   Probando: {$testDomain}");
            $result = $service->checkAvailability($testDomain);
            
            $this->line("   - Success: " . ($result['success'] ? '✅' : '❌'));
            $this->line("   - Available: " . ($result['available'] ? '✅ Sí' : '❌ No'));
            $this->line("   - Mock: " . ($result['mock'] ?? false ? '🔄 (simulado)' : '🌐 (real)'));
            if (isset($result['error'])) {
                $this->line("   - Error: " . $result['error']);
            }
            $this->line('');
        }
        
        $this->info('🎉 Prueba completada!');
        $this->line('Revisa storage/logs/laravel.log para más detalles.');
        
        return 0;
    }
}