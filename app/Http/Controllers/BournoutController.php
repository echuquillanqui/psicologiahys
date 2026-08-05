<?php

namespace App\Http\Controllers;

use App\Models\Bournout;
use Illuminate\Http\Request;

class BournoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bournouts = Bournout::orderBy('id', 'desc')
            ->when(auth()->user()->place, fn ($query, $placeId) => $query->where('place_id', $placeId))
            ->whereDate('created_at', now()->toDateString())
            ->paginate(100);

        return view('bournout.index', compact('bournouts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(auth()->user()->profile === 'patient' && ! in_array('bournout', auth()->user()->assigned_exams ?? []), 403);

        return view('bournout.create');
    }

    /**
     * Store a newly created resource in storage.
     */

    public function DataValidation(Request $request)
    {
        $rules = [
            'name' => 'required|min:10',
            'age' => 'required|digits:2',
            'ocupacion' => 'required|min:5'
        ];

        $messages = [
            'name.required' => 'Sus Nombres y Apellidos son obligatorios.',
            'name.min' => ' Ingrese sus nombres y apellidos completos.',
            'age.required' => 'Coloca tu edad.',
            'age.digits' => 'Ingrese su edad correcta.',
            'ocupacion.required' => 'Coloca tu profesión.',
            'ocupacion.min' => 'Ingrese una profesión válida.'
        ];

        $this->validate($request, $rules, $messages);
    }

    public function store(Request $request)
    {
        $this->DataValidation($request);
        Bournout::create($request->all() + ['place_id' => auth()->user()->place, 'patient_id' => auth()->id()]);

        return redirect('home');
    }

    /**
     * Display the specified resource.
     */
    public function show(Bournout $bournout)
    {
        return view('bournout.show', compact('bournout'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
