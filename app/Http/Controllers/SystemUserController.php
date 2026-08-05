<?php

namespace App\Http\Controllers;

use App\Models\Place;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class SystemUserController extends Controller
{
    public const ROLES = [
        'administrador' => 'Administrador',
        'psicologo' => 'Psicólogo',
        'supervisor' => 'Supervisor',
    ];

    public function index(Request $request)
    {
        $this->authorizeSystemUsers();

        $filters = $request->validate([
            'search' => ['nullable', 'string', 'max:255'],
            'place_id' => ['nullable', 'exists:places,id'],
            'profile' => ['nullable', Rule::in(array_keys(self::ROLES))],
            'status' => ['nullable', Rule::in(['active', 'inactive'])],
            'date' => ['nullable', 'date'],
        ]);

        $users = User::where('profile', '!=', 'patient')
            ->when($filters['search'] ?? null, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('username', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->when($filters['place_id'] ?? null, fn ($query, $placeId) => $query->where('place', $placeId))
            ->when($filters['profile'] ?? null, fn ($query, $profile) => $query->where('profile', $profile))
            ->when($filters['status'] ?? null, fn ($query, $status) => $query->where('active', $status === 'active'))
            ->when($filters['date'] ?? null, fn ($query, $date) => $query->whereDate('created_at', $date))
            ->orderBy('name')
            ->paginate(25)
            ->withQueryString();
        $places = Place::orderBy('name')->get();
        $roles = self::ROLES;

        return view('system-users.index', compact('users', 'places', 'roles', 'filters'));
    }

    public function store(Request $request)
    {
        $this->authorizeSystemUsers();

        $data = $request->validate([
            'name' => ['required', 'string', 'min:5', 'max:255'],
            'dni' => ['required', 'string', 'max:20', Rule::unique('users', 'username')],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')],
            'profile' => ['required', Rule::in(array_keys(self::ROLES))],
            'place_id' => ['nullable', 'exists:places,id'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        User::create([
            'name' => $data['name'],
            'username' => $data['dni'],
            'profile' => $data['profile'],
            'place' => $data['place_id'] ?? null,
            'active' => $request->has('active') ? $request->boolean('active') : true,
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        return redirect()->route('system-users.index')->with('status', 'Usuario del sistema registrado correctamente.');
    }

    public function update(Request $request, User $systemUser)
    {
        $this->authorizeSystemUsers();

        $data = $request->validate([
            'name' => ['required', 'string', 'min:5', 'max:255'],
            'dni' => ['required', 'string', 'max:20', Rule::unique('users', 'username')->ignore($systemUser->id)],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($systemUser->id)],
            'profile' => ['required', Rule::in(array_keys(self::ROLES))],
            'place_id' => ['nullable', 'exists:places,id'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        $systemUser->fill([
            'name' => $data['name'],
            'username' => $data['dni'],
            'profile' => $data['profile'],
            'place' => $data['place_id'] ?? null,
            'active' => $request->boolean('active'),
            'email' => $data['email'],
        ]);

        if (! empty($data['password'])) {
            $systemUser->password = Hash::make($data['password']);
        }

        $systemUser->save();

        return redirect()->route('system-users.index')->with('status', 'Usuario del sistema actualizado correctamente.');
    }

    public function destroy(User $systemUser)
    {
        $this->authorizeSystemUsers();

        abort_if($systemUser->is(auth()->user()), 422, 'No puedes eliminar tu propio usuario.');

        $systemUser->delete();

        return redirect()->route('system-users.index')->with('status', 'Usuario del sistema eliminado correctamente.');
    }

    private function authorizeSystemUsers(): void
    {
        abort_unless(in_array(auth()->user()->profile, ['admin', 'administrator', 'administrador', 'supervisor']), 403);
    }
}
