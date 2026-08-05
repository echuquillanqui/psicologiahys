<?php

namespace App\Http\Controllers;

use App\Models\Acrofoby;
use Illuminate\Http\Request;

class AcrofobyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cohens = Acrofoby::orderBy('id', 'desc')
            ->when(auth()->user()->place, fn ($query, $placeId) => $query->where('place_id', $placeId))
            ->whereDate('created_at', now()->toDateString())
            ->paginate(100);

        return view('cohen.index', compact('cohens'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(auth()->user()->profile === 'patient' && ! in_array('cohen', auth()->user()->assigned_exams ?? []), 403);

        return view('cohen.create');
    }

    public function ValidacionCohen(Request $request)
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
        $this->ValidacionCohen($request);
        $cohen = Acrofoby::create(request()->all() + ['place_id' => auth()->user()->place, 'patient_id' => auth()->id()]);

        $sumacohen = $cohen->p1 + $cohen->p2 + $cohen->p3 + $cohen->p4 + $cohen->p5 + $cohen->p6 + $cohen->p7 + $cohen->p8 + $cohen->p9 + $cohen->p10 +
            $cohen->p11 + $cohen->p12 + $cohen->p13 + $cohen->p14 + $cohen->p15 + $cohen->p16 + $cohen->p17 + $cohen->p18 + $cohen->p19 + $cohen->p20;

        if ($sumacohen >=0 && $sumacohen <=30)
        {
            $dxcohen = "ASUSENTE";
        }
        elseif ($sumacohen >= 31 && $sumacohen <= 50)
        {
            $dxcohen = "DISCRETO";
        }elseif ($sumacohen >= 51 && $sumacohen <= 70)
        {
            $dxcohen = "MODERADO";
        }elseif ($sumacohen >= 71 && $sumacohen <= 90)
        {
            $dxcohen = "SEVERO";
        } else {
            $dxcohen = "ALTO";
        }

        $cohen->update([
            'score' => $sumacohen,
            'dx' => $dxcohen
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
