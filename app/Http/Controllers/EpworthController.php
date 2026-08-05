<?php

namespace App\Http\Controllers;

use App\Models\Epworth;
use Illuminate\Http\Request;

class EpworthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $epworths = Epworth::orderBy('id', 'desc')
            ->when(auth()->user()->place, fn ($query, $placeId) => $query->where('place_id', $placeId))
            ->whereDate('created_at', now()->toDateString())
            ->paginate(100);

        return view('epworth.index', compact('epworths'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(auth()->user()->profile === 'patient' && ! in_array('epworth', auth()->user()->assigned_exams ?? []), 403);

        return view('epworth.create');
    }

    public function ValidacionEpworth(Request $request)
    {
        $rules = [
            'name' => 'required|min:10',
            'ocupation' => 'required|min:5'
        ];

        $messages = [
            'name.required' => 'Sus Nombres y Apellidos son obligatorios.',
            'name.min' => ' Ingrese sus nombres y apellidos completos.',
            'ocupation.required' => 'Coloca tu profesión.',
            'ocupation.min' => 'Ingrese una profesión válida.',
        ];

        $this->validate($request, $rules, $messages);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->ValidacionEpworth($request);

        $epworth = Epworth::create(request()->all() + ['place_id' => auth()->user()->place, 'patient_id' => auth()->id()]);

        $sumaepworth = $epworth->p1 + $epworth->p2 + $epworth->p3 + $epworth->p4 + $epworth->p5 + $epworth->p6 + $epworth->p7 + $epworth->p8;

        if ($sumaepworth > 15)
        {
            $dxepworth = "NO APTO";
        } else {
            $dxepworth = "APTO";
        }

        $epworth->update([
            'score' => $sumaepworth,
            'dx' => $dxepworth
        ]);

        return redirect('home');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
