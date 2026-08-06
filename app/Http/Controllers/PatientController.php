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

    public function index(Request $request)
    {
        $this->authorizePatients();

        $filters = $request->validate([
            'search' => ['nullable', 'string', 'max:255'],
            'place_id' => ['nullable', 'exists:places,id'],
            'exam' => ['nullable', Rule::in(array_keys(self::EXAMS))],
            'status' => ['nullable', Rule::in(['active', 'inactive'])],
            'date' => ['nullable', 'date'],
        ]);

        $patients = User::where('profile', 'patient')
            ->when($filters['search'] ?? null, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('username', 'like', "%{$search}%");
                });
            })
            ->when($filters['place_id'] ?? null, fn ($query, $placeId) => $query->where('place', $placeId))
            ->when($filters['exam'] ?? null, fn ($query, $exam) => $query->whereJsonContains('assigned_exams', $exam))
            ->when($filters['status'] ?? null, fn ($query, $status) => $query->where('active', $status === 'active'))
            ->when($filters['date'] ?? null, fn ($query, $date) => $query->whereDate('created_at', $date))
            ->orderBy('name')
            ->paginate(25)
            ->withQueryString();

        $places = Place::orderBy('name')->get();
        $exams = self::EXAMS;

        return view('patients.index', compact('patients', 'places', 'exams', 'filters'));
    }

    public function create()
    {
        $this->authorizePatients();

        $places = Place::orderBy('name')->get();
        $exams = self::EXAMS;

        return view('patients.create', compact('places', 'exams'));
    }

    public function lookupByDni(string $dni)
    {
        $this->authorizePatients();

        $normalizedDni = preg_replace('/\s+/', '', trim($dni));
        $patient = User::where('profile', 'patient')
            ->where('username', $normalizedDni)
            ->first();

        abort_if(! $patient, 404);

        return response()->json([
            'name' => $patient->name,
        ]);
    }

    public function store(Request $request)
    {
        $this->authorizePatients();
        $data = $this->validatePatient($request, allowExistingPatient: true);
        $placeId = $data['place_id'] ?? auth()->user()->place;
        $patient = User::where('profile', 'patient')->where('username', $data['dni'])->first();

        $patient?->update([
            'name' => $data['name'],
            'place' => $placeId,
            'active' => $request->has('active') ? $request->boolean('active') : true,
            'assigned_exams' => $data['assigned_exams'] ?? [],
        ]) ?? User::create([
            'name' => $data['name'],
            'username' => $data['dni'],
            'profile' => 'patient',
            'place' => $placeId,
            'active' => $request->has('active') ? $request->boolean('active') : true,
            'email' => $data['dni'].'@paciente.local',
            'password' => Hash::make($data['dni']),
            'assigned_exams' => $data['assigned_exams'] ?? [],
        ]);

        return redirect()->route('patients.index')->with('status', 'Paciente registrado o actualizado y exámenes asignados correctamente.');
    }

    public function update(Request $request, User $patient)
    {
        $this->authorizePatients();
        abort_unless($patient->profile === 'patient', 404);

        $data = $this->validatePatient($request, $patient);

        $patient->update([
            'name' => $data['name'],
            'username' => $data['dni'],
            'place' => $data['place_id'] ?? null,
            'active' => $request->boolean('active'),
            'email' => $data['dni'].'@paciente.local',
            'assigned_exams' => $data['assigned_exams'] ?? [],
        ]);

        return redirect()->route('patients.index')->with('status', 'Paciente actualizado correctamente.');
    }

    public function destroy(User $patient)
    {
        $this->authorizePatients();
        abort_unless($patient->profile === 'patient', 404);

        $patient->delete();

        return redirect()->route('patients.index')->with('status', 'Paciente eliminado correctamente.');
    }

    private function validatePatient(Request $request, ?User $patient = null, bool $allowExistingPatient = false): array
    {
        $request->merge([
            'dni' => preg_replace('/\s+/', '', trim($request->input('dni', ''))),
        ]);

        $dniRules = ['required', 'string', 'max:20'];

        if (! $allowExistingPatient) {
            $dniRules[] = Rule::unique('users', 'username')->ignore($patient?->id);
        } else {
            $dniRules[] = Rule::unique('users', 'username')->where(fn ($query) => $query->where('profile', '!=', 'patient'));
        }

        return $request->validate([
            'name' => ['required', 'string', 'min:5', 'max:255'],
            'dni' => $dniRules,
            'place_id' => ['nullable', 'exists:places,id'],
            'active' => ['nullable', 'boolean'],
            'assigned_exams' => ['nullable', 'array'],
            'assigned_exams.*' => ['string', Rule::in(array_keys(self::EXAMS))],
        ]);
    }

    private function authorizePatients(): void
    {
        abort_if(auth()->user()->profile === 'patient', 403);
    }
}
