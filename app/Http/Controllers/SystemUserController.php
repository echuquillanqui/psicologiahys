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

    public function index()
    {
        $this->authorizeSystemUsers();

        $users = User::where('profile', '!=', 'patient')
            ->orderBy('name')
            ->paginate(25);
        $places = Place::orderBy('name')->get();
        $roles = self::ROLES;

        return view('system-users.index', compact('users', 'places', 'roles'));
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
