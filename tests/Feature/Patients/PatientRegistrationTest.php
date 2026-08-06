<?php

namespace Tests\Feature\Patients;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PatientRegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_patient_lookup_by_dni_returns_patient_name(): void
    {
        $admin = User::factory()->create([
            'profile' => 'administrador',
            'username' => '00000001',
        ]);
        $patient = User::factory()->create([
            'name' => 'Paciente Existente',
            'profile' => 'patient',
            'username' => '12345678',
            'email' => '12345678@paciente.local',
        ]);

        $response = $this->actingAs($admin)->getJson(route('patients.lookup', ['dni' => '12345678']));

        $response->assertOk()->assertJson([
            'name' => $patient->name,
        ]);
    }

    public function test_store_updates_existing_patient_exam_assignments_by_dni(): void
    {
        $admin = User::factory()->create([
            'profile' => 'administrador',
            'username' => '00000002',
        ]);
        $patient = User::factory()->create([
            'name' => 'Paciente Existente',
            'profile' => 'patient',
            'username' => '87654321',
            'email' => '87654321@paciente.local',
            'assigned_exams' => ['audit'],
        ]);

        $response = $this->actingAs($admin)->post(route('patients.store'), [
            'name' => 'Paciente Existente Actualizado',
            'dni' => '87654321',
            'active' => '1',
            'assigned_exams' => ['baron', 'epworth'],
        ]);

        $response->assertRedirect(route('patients.index'));
        $patient->refresh();

        $this->assertSame('Paciente Existente Actualizado', $patient->name);
        $this->assertSame(['baron', 'epworth'], $patient->assigned_exams);
        $this->assertSame(1, User::where('username', '87654321')->count());
    }
}
