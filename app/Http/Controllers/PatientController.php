<?php

namespace App\Http\Controllers;

use App\Models\Place;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class PatientController extends Controller
{
    public const EXAMS = [
        'bournout' => 'Test de Estrés y Bournout',
        'eysenck' => 'Eysenck A-B',
        'baron' => 'Inventario Emocional Baron',
        'clq' => 'Cuestionario de Claustrofobia',
        'audit' => 'Cuestionario Audit',
        'cohen' => 'Cuestionario de Acrofobia (Cohen)',
        'epworth' => 'Escala de Somnolencia de Epworth',
    ];

    public function create()
    {
        $places = Place::orderBy('name')->get();
        $exams = self::EXAMS;

        return view('patients.create', compact('places', 'exams'));
    }

    public function store(Request $request)
    {
        $request->merge([
            'dni' => preg_replace('/\s+/', '', trim($request->input('dni', ''))),
        ]);

        $data = $request->validate([
            'name' => ['required', 'string', 'min:5', 'max:255'],
            'dni' => ['required', 'string', 'max:20', Rule::unique('users', 'username')],
            'place_id' => ['nullable', 'exists:places,id'],
            'assigned_exams' => ['nullable', 'array'],
            'assigned_exams.*' => ['string', Rule::in(array_keys(self::EXAMS))],
        ]);

        $placeId = $data['place_id'] ?? auth()->user()->place;

        User::create([
            'name' => $data['name'],
            'username' => $data['dni'],
            'profile' => 'patient',
            'place' => $placeId,
            'email' => $data['dni'].'@paciente.local',
            'password' => Hash::make($data['dni']),
            'assigned_exams' => $data['assigned_exams'] ?? [],
        ]);

        return redirect()->route('home')->with('status', 'Paciente registrado y exámenes asignados correctamente.');
    }
}
