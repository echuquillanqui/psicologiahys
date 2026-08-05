<?php

namespace App\Http\Controllers;

use App\Models\Baron;
use Illuminate\Http\Request;

class BaronController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $barons = Baron::orderBy('id', 'desc')
            ->when(auth()->user()->place, fn ($query, $placeId) => $query->where('place_id', $placeId))
            //->whereDate('created_at', now()->toDateString())
            ->paginate(100);

        return view('baron.index', compact('barons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(auth()->user()->profile === 'patient' && ! in_array('baron', auth()->user()->assigned_exams ?? []), 403);

        return view('baron.create');
    }


    public function DataValidation(Request $request)
    {
        $rules = [
            'name' => 'required|min:10',
            'age' => 'required|digits:2',
            'ocupation' => 'required|min:5'
        ];

        $messages = [
            'name.required' => 'Sus Nombres y Apellidos son obligatorios.',
            'name.min' => ' Ingrese sus nombres y apellidos completos.',
            'age.required' => 'Coloca tu edad.',
            'age.digits' => 'Ingrese su edad correcta.',
            'ocupation.required' => 'Coloca tu profesión.',
            'ocupation.min' => 'Ingrese una profesión válida.'
        ];

        $this->validate($request, $rules, $messages);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->DataValidation($request);
        $data = Baron::create($request->all() + ['place_id' => auth()->user()->place, 'patient_id' => auth()->id()]);

        return redirect('home');
    }

    /**
     * Display the specified resource.
     */
    public function show(Baron $baron)
    {
        $restageneral = $baron->getAttribute('13') + $baron->getAttribute('22') + $baron->getAttribute('25') + $baron->getAttribute('33') + $baron->getAttribute('37') +
            $baron->getAttribute('64') + $baron->getAttribute('90') + $baron->getAttribute('110');

        $obt_interpersonal = $baron->totalS6S8 - ($baron->getAttribute('55') + $baron->getAttribute('61') + $baron->getAttribute('72') + $baron->getAttribute('98') + $baron->getAttribute('119'));

        $sumageneral = $baron->totalS1S5 + $obt_interpersonal + $baron->totalS9S11 + $baron->totalS12S13 + $baron->totalS14S15;

        $general = $sumageneral - $restageneral;
        /* Esto se guarda en cegeneral*/
        $cegeneral = round(((($general - 465.31)/49.99)*15)+100);

        /* Esto se guarda en ce se calcula del total de intrapersonal */
        $ce_intrapersonal = round(((($baron->totalS1S5 - 156.70)/20.47)*15)+100);

        /*Conocimiento Emocional de si mismo*/
        $c_simismo = round(((($baron->resultadoS1 - 29.79)/5.28)*15)+100);
        $seguridad = round(((($baron->resultadoS2 - 25.82)/4.66)*15)+100);
        $autoconcepto = round(((($baron->resultadoS3 - 35.78)/6.30)*15)+100);
        $autorealizacion = round(((($baron->resultadoS4 - 37.72)/5.07)*15)+100);
        $independencia = round(((($baron->resultadoS5 - 27.37)/4.48)*15)+100);

        $interpersonales = round(((($obt_interpersonal - 99.52)/10.85)*15)+100);
        $r_interpersonales = round(((($baron->resultadoS6 - 44.23)/6.02)*15)+100);
        $r_social = round(((($baron->resultadoS7 - 43.27)/4.93)*15)+100);
        $empatia = round(((($baron->resultadoS8 - 33.51)/4.19)*15)+100);

        $ce_adaptabilidad = round(((($baron->totalS9S11 - 100.32)/12.46)*15)+100);
        $s_problemas = round(((($baron->resultadoS9 - 31.79)/4.60)*15)+100);
        $p_realidad = round(((($baron->resultadoS10 - 39.53)/5.58)*15)+100);
        $flexibilidad = round(((($baron->resultadoS11 - 28.94)/4.86)*15)+100);

        $ce_tension = round(((($baron->totalS12S13 - 68.27)/9.66)*15)+100);
        $t_estres = round(((($baron->resultadoS12 - 33.66)/5.64)*15)+100);
        $c_impulsos = round(((($baron->resultadoS13 - 34.59)/5.63)*15)+100);

        $g_animo = round(((($baron->totalS14S15 - 70.50)/8.74)*15)+100);
        $felicidad = round(((($baron->resultadoS14 - 37.48)/5.13)*15)+100);
        $optimismo = round(((($baron->resultadoS15 - 32.98)/4.46)*15)+100);

        $i_positiva = round((((0-20.35)/5.30)*15)+100);
        $i_negativa = round((((0 - 10.66)/4.26)*15)+100);

        return view('baron.show',  compact('sumageneral','general', 'ce_intrapersonal', 'cegeneral',
            'c_simismo', 'seguridad', 'autoconcepto', 'autorealizacion', 'independencia', 'interpersonales', 'r_interpersonales',
            'r_social', 'empatia', 'ce_adaptabilidad', 's_problemas', 'p_realidad', 'flexibilidad', 'ce_tension', 't_estres', 'c_impulsos',
        'felicidad', 'optimismo', 'g_animo', 'i_positiva' , 'i_negativa', 'baron'));
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
