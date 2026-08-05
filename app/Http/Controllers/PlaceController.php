<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Http\Request;

class PlaceController extends Controller
{
    public function index(Request $request)
    {
        $this->authorizePlaces();

        $filters = $request->validate([
            'search' => ['nullable', 'string', 'max:255'],
            'status' => ['nullable', 'in:active,inactive'],
            'date' => ['nullable', 'date'],
        ]);

        $places = Place::query()
            ->when($filters['search'] ?? null, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('address', 'like', "%{$search}%");
            })
            ->when($filters['status'] ?? null, fn ($query, $status) => $query->where('active', $status === 'active'))
            ->when($filters['date'] ?? null, fn ($query, $date) => $query->whereDate('created_at', $date))
            ->orderBy('name')
            ->paginate(25)
            ->withQueryString();

        return view('places.index', compact('places', 'filters'));
    }

    public function store(Request $request)
    {
        $this->authorizePlaces();

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
        ]);

        $data['active'] = $request->has('active') ? $request->boolean('active') : true;

        Place::create($data);

        return redirect()->route('places.index')->with('status', 'Sede registrada correctamente.');
    }

    public function update(Request $request, Place $place)
    {
        $this->authorizePlaces();

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
        ]);
        $data['active'] = $request->boolean('active');

        $place->update($data);

        return redirect()->route('places.index')->with('status', 'Sede actualizada correctamente.');
    }

    public function destroy(Place $place)
    {
        $this->authorizePlaces();

        $place->delete();

        return redirect()->route('places.index')->with('status', 'Sede eliminada correctamente.');
    }

    private function authorizePlaces(): void
    {
        abort_unless(in_array(auth()->user()->profile, ['admin', 'administrator', 'administrador', 'supervisor']), 403);
    }
}
