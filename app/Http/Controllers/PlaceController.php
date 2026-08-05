<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Http\Request;

class PlaceController extends Controller
{
    public function index()
    {
        $this->authorizePlaces();

        $places = Place::orderBy('name')->paginate(25);

        return view('places.index', compact('places'));
    }

    public function store(Request $request)
    {
        $this->authorizePlaces();

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
        ]);

        Place::create($data);

        return redirect()->route('places.index')->with('status', 'Sede registrada correctamente.');
    }

    private function authorizePlaces(): void
    {
        abort_unless(in_array(auth()->user()->profile, ['admin', 'administrator', 'administrador', 'supervisor']), 403);
    }
}
