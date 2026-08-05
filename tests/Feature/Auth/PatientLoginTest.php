<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class PatientLoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_patient_can_login_with_dni_and_initial_dni_password(): void
    {
        $patient = User::factory()->create([
            'username' => '12345678',
            'profile' => 'patient',
            'email' => '12345678@paciente.local',
            'password' => Hash::make('12345678'),
            'active' => true,
        ]);

        $response = $this->post(route('login'), [
            'login_type' => 'patient',
            'login' => '12345678',
            'password' => '12345678',
        ]);

        $response->assertRedirect(route('home'));
        $this->assertAuthenticatedAs($patient);
    }

    public function test_patient_login_ignores_accidental_spaces_in_dni(): void
    {
        $patient = User::factory()->create([
            'username' => '12345678',
            'profile' => 'patient',
            'email' => '12345678@paciente.local',
            'password' => Hash::make('12345678'),
            'active' => true,
        ]);

        $response = $this->post(route('login'), [
            'login_type' => 'patient',
            'login' => ' 1234 5678 ',
            'password' => '12345678',
        ]);

        $response->assertRedirect(route('home'));
        $this->assertAuthenticatedAs($patient);
    }
}
