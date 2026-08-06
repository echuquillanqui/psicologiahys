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
                            <label class="form-label">DNI</label>
                            <input id="patient-dni" name="dni" class="form-control @error('dni') is-invalid @enderror" value="{{ old('dni') }}" autocomplete="off" required>
                            <small class="text-muted">El DNI será el usuario y contraseña inicial del paciente.</small>
                            <div id="patient-dni-status" class="form-text"></div>
                            @error('dni')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nombres y apellidos</label>
                            <input id="patient-name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
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

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const dniInput = document.getElementById('patient-dni');
    const nameInput = document.getElementById('patient-name');
    const status = document.getElementById('patient-dni-status');
    const lookupUrl = @json(route('patients.lookup', ['dni' => '__DNI__']));
    let controller;
    let lookupTimer;

    const setStatus = (message, className = 'form-text') => {
        status.textContent = message;
        status.className = className;
    };

    const findPatient = async () => {
        const dni = dniInput.value.replace(/\s+/g, '').trim();

        if (controller) {
            controller.abort();
        }

        if (!dni) {
            setStatus('');
            return;
        }

        controller = new AbortController();

        try {
            const response = await fetch(lookupUrl.replace('__DNI__', encodeURIComponent(dni)), {
                headers: {
                    Accept: 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                },
                signal: controller.signal,
            });

            if (response.ok) {
                const patient = await response.json();
                nameInput.value = patient.name;
                setStatus('Paciente encontrado. Se completaron nombres y apellidos automáticamente.', 'form-text text-success');
                return;
            }

            if (response.status === 404) {
                setStatus('Paciente no registrado. Complete sus nombres y apellidos.', 'form-text text-muted');
                return;
            }

            setStatus('No se pudo verificar el DNI. Intente nuevamente.', 'form-text text-danger');
        } catch (error) {
            if (error.name !== 'AbortError') {
                setStatus('No se pudo verificar el DNI. Intente nuevamente.', 'form-text text-danger');
            }
        }
    };

    dniInput.addEventListener('input', () => {
        clearTimeout(lookupTimer);
        lookupTimer = setTimeout(findPatient, 500);
    });
    dniInput.addEventListener('blur', findPatient);
});
</script>
@endsection
