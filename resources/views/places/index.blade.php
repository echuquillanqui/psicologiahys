@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            @if (session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif

            <div class="card mb-4">
                <div class="card-header">Registrar sede</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('places.store') }}">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6"><label class="form-label">Nombre de la sede</label><input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>@error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
                            <div class="col-md-6"><label class="form-label">Dirección</label><input type="text" name="address" class="form-control" value="{{ old('address') }}"></div>
                            <div class="col-12"><div class="form-check"><input type="checkbox" name="active" value="1" class="form-check-input" id="place-active" @checked(old('active', true))><label class="form-check-label" for="place-active">Sede habilitada</label></div></div>
                        </div>
                        <button class="btn btn-primary mt-3">Guardar sede</button>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-header">Sedes registradas</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped align-middle">
                            <thead><tr><th>Nombre</th><th>Dirección</th><th>Estado</th><th>Fecha de registro</th><th class="text-end">Acciones</th></tr></thead>
                            <tbody>
                                @forelse($places as $place)
                                    <tr>
                                        <td>{{ $place->name }}</td>
                                        <td>{{ $place->address ?: 'Sin dirección' }}</td>
                                        <td><span class="badge {{ $place->active ? 'bg-success' : 'bg-secondary' }}">{{ $place->active ? 'Habilitada' : 'Deshabilitada' }}</span></td>
                                        <td>{{ optional($place->created_at)->format('d/m/Y') }}</td>
                                        <td class="text-end">
                                            <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editPlaceModal{{ $place->id }}">Editar</button>
                                            <form method="POST" action="{{ route('places.destroy', $place) }}" class="d-inline" onsubmit="return confirm('¿Eliminar esta sede?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger">Eliminar</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="5" class="text-muted">No hay sedes registradas.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    {{ $places->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

@foreach($places as $place)
<div class="modal fade" id="editPlaceModal{{ $place->id }}" tabindex="-1" aria-labelledby="editPlaceModalLabel{{ $place->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <form class="modal-content" method="POST" action="{{ route('places.update', $place) }}">
            @csrf
            @method('PUT')
            <div class="modal-header"><h5 class="modal-title" id="editPlaceModalLabel{{ $place->id }}">Editar sede</h5><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button></div>
            <div class="modal-body">
                <div class="mb-3"><label class="form-label">Nombre de la sede</label><input type="text" name="name" class="form-control" value="{{ $place->name }}" required></div>
                <div class="mb-3"><label class="form-label">Dirección</label><input type="text" name="address" class="form-control" value="{{ $place->address }}"></div>
                <div class="form-check"><input type="checkbox" name="active" value="1" class="form-check-input" id="place-active-{{ $place->id }}" @checked($place->active)><label class="form-check-label" for="place-active-{{ $place->id }}">Sede habilitada</label></div>
            </div>
            <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button><button type="submit" class="btn btn-primary">Actualizar</button></div>
        </form>
    </div>
</div>
@endforeach
@endsection
