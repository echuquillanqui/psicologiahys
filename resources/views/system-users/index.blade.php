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
        <h3>Usuarios del sistema</h3>
        <div class="d-flex gap-2">
            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#placeModal">Registrar sede</button>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#systemUserModal">Registrar usuario</button>
        </div>
    </div>


    <div class="card mb-3">
        <div class="card-body">
            <form method="GET" action="{{ route('system-users.index') }}" class="row g-3 align-items-end">
                <div class="col-md-3"><label class="form-label">Buscar</label><input name="search" class="form-control" value="{{ $filters['search'] ?? '' }}" placeholder="Nombre, DNI o email"></div>
                <div class="col-md-2"><label class="form-label">Fecha de registro</label><input type="date" name="date" class="form-control" value="{{ $filters['date'] ?? '' }}"></div>
                <div class="col-md-2"><label class="form-label">Sede</label><select name="place_id" class="form-select"><option value="">Todas las sedes</option>@foreach($places as $place)<option value="{{ $place->id }}" @selected(($filters['place_id'] ?? '') == $place->id)>{{ $place->name }}</option>@endforeach</select></div>
                <div class="col-md-2"><label class="form-label">Rol</label><select name="profile" class="form-select"><option value="">Todos los roles</option>@foreach($roles as $value => $label)<option value="{{ $value }}" @selected(($filters['profile'] ?? '') === $value)>{{ $label }}</option>@endforeach</select></div>
                <div class="col-md-2"><label class="form-label">Estado</label><select name="status" class="form-select"><option value="">Todos</option><option value="active" @selected(($filters['status'] ?? '') === 'active')>Habilitado</option><option value="inactive" @selected(($filters['status'] ?? '') === 'inactive')>Deshabilitado</option></select></div>
                <div class="col-md-1 d-flex gap-2"><button class="btn btn-outline-primary">Filtrar</button></div>
                <div class="col-12"><a href="{{ route('system-users.index') }}" class="btn btn-outline-secondary">Limpiar filtros</a></div>
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
                        <th>Email</th>
                        <th>Rol</th>
                        <th>Sede</th>
                        <th>Estado</th>
                        <th>Fecha de registro</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $systemUser)
                        <tr>
                            <td>{{ $systemUser->name }}</td>
                            <td>{{ $systemUser->username }}</td>
                            <td>{{ $systemUser->email }}</td>
                            <td>{{ $roles[$systemUser->profile] ?? $systemUser->profile }}</td>
                            <td>{{ optional($places->firstWhere('id', $systemUser->place))->name ?? 'Todas' }}</td>
                            <td><span class="badge {{ $systemUser->active ? 'bg-success' : 'bg-secondary' }}">{{ $systemUser->active ? 'Habilitado' : 'Deshabilitado' }}</span></td>
                            <td>{{ optional($systemUser->created_at)->format('d/m/Y') }}</td>
                            <td class="text-end">
                                <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editSystemUserModal{{ $systemUser->id }}">Editar</button>
                                <form method="POST" action="{{ route('system-users.destroy', $systemUser) }}" class="d-inline" onsubmit="return confirm('¿Eliminar este usuario?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" @disabled($systemUser->is(auth()->user()))>Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $users->links() }}
        </div>
    </div>
</div>

<div class="modal fade" id="systemUserModal" tabindex="-1" aria-labelledby="systemUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form id="system-user-form" class="modal-content" method="POST" action="{{ route('system-users.store') }}">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="systemUserModalLabel">Registrar usuario del sistema</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body row g-3">
                <div class="col-md-6"><label class="form-label">Nombres y apellidos</label><input name="name" class="form-control" value="{{ old('name') }}" required></div>
                <div class="col-md-6"><label class="form-label">DNI</label><input name="dni" class="form-control" value="{{ old('dni') }}" required></div>
                <div class="col-md-6"><label class="form-label">Email</label><input type="email" name="email" class="form-control" value="{{ old('email') }}" required></div>
                <div class="col-md-6"><label class="form-label">Rol</label><select name="profile" class="form-select" required>@foreach($roles as $value => $label)<option value="{{ $value }}" @selected(old('profile') === $value)>{{ $label }}</option>@endforeach</select></div>
                <div class="col-md-6"><label class="form-label">Sede</label><select name="place_id" class="form-select"><option value="">Todas las sedes</option>@foreach($places as $place)<option value="{{ $place->id }}" @selected(old('place_id') == $place->id)>{{ $place->name }}</option>@endforeach</select></div>
                <div class="col-md-6 d-flex align-items-end"><div class="form-check"><input type="checkbox" name="active" value="1" class="form-check-input" id="system-user-active" @checked(old('active', true))><label class="form-check-label" for="system-user-active">Usuario habilitado</label></div></div>
                <div class="col-md-6"><label for="system-user-password" class="form-label">Contraseña</label><input id="system-user-password" type="password" name="password" form="system-user-form" class="form-control @error('password') is-invalid @enderror" required autocomplete="new-password">@error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
                <div class="col-md-6"><label for="system-user-password-confirmation" class="form-label">Confirmar contraseña</label><input id="system-user-password-confirmation" type="password" name="password_confirmation" form="system-user-form" class="form-control" required autocomplete="new-password"></div>
            </div>
            <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button><button type="submit" class="btn btn-primary">Guardar</button></div>
        </form>
    </div>
</div>

@foreach($users as $systemUser)
<div class="modal fade" id="editSystemUserModal{{ $systemUser->id }}" tabindex="-1" aria-labelledby="editSystemUserModalLabel{{ $systemUser->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form class="modal-content" method="POST" action="{{ route('system-users.update', $systemUser) }}">
            @csrf
            @method('PUT')
            <div class="modal-header"><h5 class="modal-title" id="editSystemUserModalLabel{{ $systemUser->id }}">Editar usuario</h5><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button></div>
            <div class="modal-body row g-3">
                <div class="col-md-6"><label class="form-label">Nombres y apellidos</label><input name="name" class="form-control" value="{{ $systemUser->name }}" required></div>
                <div class="col-md-6"><label class="form-label">DNI</label><input name="dni" class="form-control" value="{{ $systemUser->username }}" required></div>
                <div class="col-md-6"><label class="form-label">Email</label><input type="email" name="email" class="form-control" value="{{ $systemUser->email }}" required></div>
                <div class="col-md-6"><label class="form-label">Rol</label><select name="profile" class="form-select" required>@foreach($roles as $value => $label)<option value="{{ $value }}" @selected($systemUser->profile === $value)>{{ $label }}</option>@endforeach</select></div>
                <div class="col-md-6"><label class="form-label">Sede</label><select name="place_id" class="form-select"><option value="">Todas las sedes</option>@foreach($places as $place)<option value="{{ $place->id }}" @selected($systemUser->place == $place->id)>{{ $place->name }}</option>@endforeach</select></div>
                <div class="col-md-6 d-flex align-items-end"><div class="form-check"><input type="checkbox" name="active" value="1" class="form-check-input" id="system-user-active-{{ $systemUser->id }}" @checked($systemUser->active)><label class="form-check-label" for="system-user-active-{{ $systemUser->id }}">Usuario habilitado</label></div></div>
                <div class="col-md-6"><label class="form-label">Nueva contraseña</label><input type="password" name="password" class="form-control" autocomplete="new-password"><div class="form-text">Déjala en blanco para conservar la actual.</div></div>
                <div class="col-md-6"><label class="form-label">Confirmar nueva contraseña</label><input type="password" name="password_confirmation" class="form-control" autocomplete="new-password"></div>
            </div>
            <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button><button type="submit" class="btn btn-primary">Actualizar</button></div>
        </form>
    </div>
</div>
@endforeach

<div class="modal fade" id="placeModal" tabindex="-1" aria-labelledby="placeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form class="modal-content" method="POST" action="{{ route('places.store') }}">
            @csrf
            <div class="modal-header"><h5 class="modal-title" id="placeModalLabel">Registrar sede</h5><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button></div>
            <div class="modal-body">
                <div class="mb-3"><label class="form-label">Nombre de la sede</label><input name="name" class="form-control" required></div>
                <div class="mb-3"><label class="form-label">Dirección</label><input name="address" class="form-control"></div>
                <div class="form-check"><input type="checkbox" name="active" value="1" class="form-check-input" id="place-active" checked><label class="form-check-label" for="place-active">Sede habilitada</label></div>
            </div>
            <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button><button type="submit" class="btn btn-primary">Guardar sede</button></div>
        </form>
    </div>
</div>

@if ($errors->any())
<script>document.addEventListener('DOMContentLoaded', () => new bootstrap.Modal(document.getElementById('systemUserModal')).show());</script>
@endif
@endsection
