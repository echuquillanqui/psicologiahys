@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Registrar paciente</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('patients.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Nombres y apellidos</label>
                            <input name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">DNI</label>
                            <input name="dni" class="form-control @error('dni') is-invalid @enderror" value="{{ old('dni') }}" required>
                            <small class="text-muted">El DNI será el usuario y contraseña inicial del paciente.</small>
                            @error('dni')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Sede</label>
                            <select name="place_id" class="form-select">
                                <option value="">Usar sede del usuario actual</option>
                                @foreach($places as $place)
                                    <option value="{{ $place->id }}" @selected(old('place_id') == $place->id)>{{ $place->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" name="active" value="1" class="form-check-input" id="patient-active" @checked(old('active', true))>
                            <label class="form-check-label" for="patient-active">Paciente habilitado</label>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Exámenes asignados</label>
                            @foreach($exams as $key => $label)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="assigned_exams[]" value="{{ $key }}" id="exam_{{ $key }}" @checked(in_array($key, old('assigned_exams', [])))>
                                    <label class="form-check-label" for="exam_{{ $key }}">{{ $label }}</label>
                                </div>
                            @endforeach
                        </div>
                        <button class="btn btn-primary">Guardar paciente</button>
                        <a href="{{ route('patients.index') }}" class="btn btn-secondary">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
