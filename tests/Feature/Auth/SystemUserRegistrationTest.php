<?php

namespace Tests\Feature\Auth;

use App\Models\Place;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class SystemUserRegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_system_user_registration_persists_submitted_password(): void
    {
        $admin = User::factory()->create([
            'profile' => 'administrador',
            'username' => '00000001',
        ]);
        $place = Place::create(['name' => 'Sede central']);

        $response = $this->actingAs($admin)->post(route('system-users.store'), [
            'name' => 'Usuario de Prueba',
            'dni' => '12345678',
            'email' => 'usuario.prueba@example.com',
            'profile' => 'psicologo',
            'place_id' => $place->id,
            'password' => 'Password123',
            'password_confirmation' => 'Password123',
        ]);

        $response->assertRedirect(route('system-users.index'));

        $user = User::where('email', 'usuario.prueba@example.com')->firstOrFail();

        $this->assertSame('12345678', $user->username);
        $this->assertNotEmpty($user->password);
        $this->assertTrue(Hash::check('Password123', $user->password));
    }

    public function test_system_user_registration_form_posts_password_fields(): void
    {
        $admin = User::factory()->create([
            'profile' => 'administrador',
            'username' => '00000002',
        ]);

        $response = $this->actingAs($admin)->get(route('system-users.index'));

        $response->assertOk();
        $response->assertSee('id="system-user-form"', false);
        $response->assertSee('name="password"', false);
        $response->assertSee('form="system-user-form"', false);
        $response->assertSee('name="password_confirmation"', false);
    }
}
