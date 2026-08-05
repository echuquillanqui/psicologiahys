@extends('layouts.app')

@section('content')
@php
    $exams = [
        'bournout' => ['title' => 'TEST DE ESTRÉS Y BOURNOUT', 'route' => 'bournout.create', 'class' => 'btn-primary'],
        'eysenck' => ['title' => 'EYSENCK A-B', 'route' => 'eysenck.create', 'class' => 'btn-success'],
        'baron' => ['title' => 'INVENTARIO EMOCIONAL BARON', 'route' => 'baron.create', 'class' => 'btn-info'],
        'clq' => ['title' => 'CUESTIONARIO DE CLAUSTROFOBIA', 'route' => 'clq.create', 'class' => 'btn-danger'],
        'audit' => ['title' => 'CUESTIONARIO AUDIT', 'route' => 'audit.create', 'class' => 'btn-warning'],
        'cohen' => ['title' => 'CUESTIONARIO DE ACROFOBIA (COHEN)', 'route' => 'cohen.create', 'class' => 'btn-secondary'],
        'epworth' => ['title' => 'ESCALA DE SOMNOLENCIA DE EPWORTH', 'route' => 'epworth.create', 'class' => 'btn-outline-danger'],
    ];

    $user = auth()->user();
    $visibleExams = $user->profile === 'patient'
        ? array_intersect_key($exams, array_flip($user->assigned_exams ?? []))
        : $exams;
@endphp

<div class="container-fluid">
    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    @if ($user->profile !== 'patient')
        <div class="mb-3 text-end">
            <a href="{{ route('patients.index') }}" class="btn btn-dark">Registrar paciente y asignar exámenes</a>
        </div>
    @endif

    <div class="row justify-content-center text-center">
        @forelse($visibleExams as $exam)
            <div class="col-md-3 col-lg-3 col-sm-12 col-12 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">{{ $exam['title'] }}</h5>
                        <a href="{{ route($exam['route']) }}" class="btn {{ $exam['class'] }}">ACCEDER AL EXAMEN</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-md-8">
                <div class="alert alert-info">No tienes exámenes asignados. Comunícate con la sede para recibir una asignación.</div>
            </div>
        @endforelse
    </div>
</div>
@endsection
