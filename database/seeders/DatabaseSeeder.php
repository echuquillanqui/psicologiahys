<?php

namespace Database\Seeders;

use App\Models\Place;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $place = Place::firstOrCreate(
            ['name' => 'Sede central'],
            ['address' => 'Principal']
        );

        $users = [
            [
                'name' => 'Administrador Demo',
                'username' => '10000001',
                'profile' => 'administrador',
                'email' => 'administrador@example.com',
                'password' => 'Administrador123',
            ],
            [
                'name' => 'Psicólogo Demo',
                'username' => '10000002',
                'profile' => 'psicologo',
                'email' => 'psicologo@example.com',
                'password' => 'Psicologo123',
            ],
            [
                'name' => 'Supervisor Demo',
                'username' => '10000003',
                'profile' => 'supervisor',
                'email' => 'supervisor@example.com',
                'password' => 'Supervisor123',
            ],
            [
                'name' => 'Paciente Demo',
                'username' => '10000004',
                'profile' => 'patient',
                'email' => '10000004@paciente.local',
                'password' => '10000004',
                'assigned_exams' => ['bournout', 'eysenck', 'baron', 'clq', 'audit', 'cohen', 'epworth'],
            ],
        ];

        foreach ($users as $user) {
            User::updateOrCreate(
                ['email' => $user['email']],
                [
                    'name' => $user['name'],
                    'username' => $user['username'],
                    'profile' => $user['profile'],
                    'place' => $place->id,
                    'password' => Hash::make($user['password']),
                    'assigned_exams' => $user['assigned_exams'] ?? [],
                ]
            );
        }
    }
}
