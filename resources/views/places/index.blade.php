@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif

            <div class="card mb-4">
                <div class="card-header">Registrar sede</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('places.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Nombre de la sede</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <button class="btn btn-primary">Guardar sede</button>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-header">Sedes registradas</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped align-middle">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Fecha de registro</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($places as $place)
                                    <tr>
                                        <td>{{ $place->name }}</td>
                                        <td>{{ optional($place->created_at)->format('d/m/Y') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2" class="text-muted">No hay sedes registradas.</td>
                                    </tr>
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
@endsection
