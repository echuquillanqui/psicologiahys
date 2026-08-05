<form method="GET" class="row g-2 align-items-end mb-3">
    @php($places = \App\Models\Place::orderBy('name')->get())
    @php($selectedPlaceId = request('place_id', auth()->user()->place))
    <div class="col-md-3">
        <label class="form-label">Fecha</label>
        <input type="date" name="date" class="form-control" value="{{ request('date', now()->toDateString()) }}">
    </div>
    <div class="col-md-4">
        <label class="form-label">Buscar por nombres, apellidos, DNI, empresa u ocupación</label>
        <input type="text" name="search" class="form-control" value="{{ request('search') }}" placeholder="Ingrese texto de búsqueda">
    </div>
    <div class="col-md-3">
        <label class="form-label">Lugar / sede</label>
        <select name="place_id" class="form-select">
            <option value="">Todas las sedes</option>
            @foreach($places as $place)
                <option value="{{ $place->id }}" @selected($selectedPlaceId == $place->id)>{{ $place->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-2 d-flex gap-2">
        <button class="btn btn-primary" type="submit">Filtrar</button>
        <a class="btn btn-outline-secondary" href="{{ url()->current() }}">Hoy</a>
    </div>
</form>
