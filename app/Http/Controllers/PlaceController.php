<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Http\Request;

class PlaceController extends Controller
{
    public function store(Request $request)
    {
        abort_unless(in_array(auth()->user()->profile, ['admin', 'administrator', 'administrador', 'supervisor']), 403);

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
        ]);

        Place::create($data);

        return redirect()->route('system-users.index')->with('status', 'Sede registrada correctamente.');
    }
}
