@extends('layouts.app')

@section('content')
<div class="container-fluid">
    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">Revisa los datos ingresados e intenta nuevamente.</div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Pacientes y exámenes asignados</h3>
        <a href="{{ route('patients.create') }}" class="btn btn-primary">Registrar paciente</a>
    </div>

    <div class="card mb-3">
        <div class="card-body">
            <form method="GET" action="{{ route('patients.index') }}" class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label class="form-label">Buscar</label>
                    <input name="search" class="form-control" value="{{ $filters['search'] ?? '' }}" placeholder="Nombre o DNI">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Sede</label>
                    <select name="place_id" class="form-select">
                        <option value="">Todas las sedes</option>
                        @foreach($places as $place)
                            <option value="{{ $place->id }}" @selected(($filters['place_id'] ?? '') == $place->id)>{{ $place->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Examen</label>
                    <select name="exam" class="form-select">
                        <option value="">Todos los exámenes</option>
                        @foreach($exams as $key => $label)
                            <option value="{{ $key }}" @selected(($filters['exam'] ?? '') === $key)>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Estado</label>
                    <select name="status" class="form-select">
                        <option value="">Todos</option>
                        <option value="active" @selected(($filters['status'] ?? '') === 'active')>Habilitado</option>
                        <option value="inactive" @selected(($filters['status'] ?? '') === 'inactive')>Deshabilitado</option>
                    </select>
                </div>
                <div class="col-12 d-flex gap-2">
                    <button class="btn btn-outline-primary">Filtrar</button>
                    <a href="{{ route('patients.index') }}" class="btn btn-outline-secondary">Limpiar</a>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>DNI</th>
                        <th>Sede</th>
                        <th>Exámenes</th>
                        <th>Estado</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($patients as $patient)
                        <tr>
                            <td>{{ $patient->name }}</td>
                            <td>{{ $patient->username }}</td>
                            <td>{{ optional($places->firstWhere('id', $patient->place))->name ?? 'Sin sede' }}</td>
                            <td>
                                @forelse($patient->assigned_exams ?? [] as $exam)
                                    <span class="badge bg-info text-dark mb-1">{{ $exams[$exam] ?? $exam }}</span>
                                @empty
                                    <span class="text-muted">Sin exámenes</span>
                                @endforelse
                            </td>
                            <td><span class="badge {{ $patient->active ? 'bg-success' : 'bg-secondary' }}">{{ $patient->active ? 'Habilitado' : 'Deshabilitado' }}</span></td>
                            <td class="text-end">
                                <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editPatientModal{{ $patient->id }}">Editar exámenes</button>
                                <form method="POST" action="{{ route('patients.destroy', $patient) }}" class="d-inline" onsubmit="return confirm('¿Eliminar este paciente?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center text-muted">No se encontraron pacientes.</td></tr>
                    @endforelse
                </tbody>
            </table>
            {{ $patients->links() }}
        </div>
    </div>
</div>

@foreach($patients as $patient)
<div class="modal fade" id="editPatientModal{{ $patient->id }}" tabindex="-1" aria-labelledby="editPatientModalLabel{{ $patient->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form class="modal-content" method="POST" action="{{ route('patients.update', $patient) }}">
            @csrf
            @method('PUT')
            <div class="modal-header"><h5 class="modal-title" id="editPatientModalLabel{{ $patient->id }}">Editar paciente y exámenes</h5><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button></div>
            <div class="modal-body row g-3">
                <div class="col-md-6"><label class="form-label">Nombres y apellidos</label><input name="name" class="form-control" value="{{ $patient->name }}" required></div>
                <div class="col-md-6"><label class="form-label">DNI</label><input name="dni" class="form-control" value="{{ $patient->username }}" required></div>
                <div class="col-md-6"><label class="form-label">Sede</label><select name="place_id" class="form-select"><option value="">Sin sede</option>@foreach($places as $place)<option value="{{ $place->id }}" @selected($patient->place == $place->id)>{{ $place->name }}</option>@endforeach</select></div>
                <div class="col-md-6 d-flex align-items-end"><div class="form-check"><input type="checkbox" name="active" value="1" class="form-check-input" id="patient-active-{{ $patient->id }}" @checked($patient->active)><label class="form-check-label" for="patient-active-{{ $patient->id }}">Paciente habilitado</label></div></div>
                <div class="col-12">
                    <label class="form-label">Exámenes asignados</label>
                    <div class="row">
                        @foreach($exams as $key => $label)
                            <div class="col-md-6"><div class="form-check"><input class="form-check-input" type="checkbox" name="assigned_exams[]" value="{{ $key }}" id="patient_{{ $patient->id }}_exam_{{ $key }}" @checked(in_array($key, $patient->assigned_exams ?? []))><label class="form-check-label" for="patient_{{ $patient->id }}_exam_{{ $key }}">{{ $label }}</label></div></div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button><button type="submit" class="btn btn-primary">Actualizar</button></div>
        </form>
    </div>
</div>
@endforeach
@endsection
