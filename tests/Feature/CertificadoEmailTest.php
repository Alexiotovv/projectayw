<?php

namespace Tests\Feature;

use App\Models\Certificado;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class CertificadoEmailTest extends TestCase
{
    public function test_can_send_certificate_email_when_email_exists(): void
    {
        Mail::fake();

        $user = User::factory()->create();
        $certificado = Certificado::create([
            'nombre_completo' => 'Ana Pérez',
            'nombre_curso' => 'Curso de Laravel',
            'fecha_expedicion' => now()->toDateString(),
            'email' => 'ana@example.com',
            'modalidad' => 'Virtual',
            'horas_duracion' => 6,
            'publico' => true,
            'instructor' => 'Alex Vásquez',
        ]);

        $response = $this->actingAs($user)
            ->post(route('certificados.send-email', $certificado));

        $response->assertRedirect();
        $response->assertSessionHas('success', 'Correo enviado correctamente a ana@example.com');

        Mail::assertSent(\App\Mail\CertificadoEnviadoMail::class, function ($mail) use ($certificado) {
            return $mail->hasTo($certificado->email);
        });
    }
}
