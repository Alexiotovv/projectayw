<?php

namespace Tests\Feature\Customer;

use App\Models\User;
use App\Notifications\VerifyPendingEmailNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\URL;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use Tests\TestCase;

class ProfileEmailChangeTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        app(PermissionRegistrar::class)->forgetCachedPermissions();
        Role::findOrCreate('customer', 'web');
    }

    public function test_profile_update_keeps_current_email_until_new_one_is_verified(): void
    {
        Notification::fake();

        $user = User::factory()->create([
            'company' => 'AYW',
            'phone' => '999999999',
        ]);
        $user->assignRole('customer');

        $response = $this->actingAs($user)->put(route('customer.profile.update'), [
            'name' => 'Cliente Demo',
            'company' => 'AYW Corp',
            'phone' => '988776655',
            'email' => 'nuevo-correo@example.com',
        ]);

        $response->assertSessionHasNoErrors();

        $user->refresh();

        $this->assertSame('Cliente Demo', $user->name);
        $this->assertSame('AYW Corp', $user->company);
        $this->assertSame('988776655', $user->phone);
        $this->assertNotSame('nuevo-correo@example.com', $user->email);
        $this->assertSame('nuevo-correo@example.com', $user->pending_email);

        Notification::assertSentOnDemand(VerifyPendingEmailNotification::class);
    }

    public function test_pending_email_is_applied_only_after_signed_link_is_opened(): void
    {
        $user = User::factory()->create([
            'company' => 'AYW',
            'phone' => '999999999',
            'pending_email' => 'nuevo-correo@example.com',
            'email_verified_at' => null,
        ]);
        $user->assignRole('customer');

        $verificationUrl = URL::temporarySignedRoute(
            'customer.profile.email.verify',
            now()->addMinutes(60),
            [
                'id' => $user->id,
                'hash' => sha1('nuevo-correo@example.com'),
                'email' => 'nuevo-correo@example.com',
            ]
        );

        $response = $this->actingAs($user)->get($verificationUrl);

        $response->assertRedirect(route('customer.profile'));

        $user->refresh();

        $this->assertSame('nuevo-correo@example.com', $user->email);
        $this->assertNull($user->pending_email);
        $this->assertNotNull($user->email_verified_at);
    }
}