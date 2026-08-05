<form method="GET" class="row g-2 align-items-end mb-3">
    <div class="col-md-3">
        <label class="form-label">Fecha</label>
        <input type="date" name="date" class="form-control" value="{{ request('date', now()->toDateString()) }}">
    </div>
    <div class="col-md-5">
        <label class="form-label">Buscar por nombres, apellidos, DNI, empresa u ocupación</label>
        <input type="text" name="search" class="form-control" value="{{ request('search') }}" placeholder="Ingrese texto de búsqueda">
    </div>
    <div class="col-md-4 d-flex gap-2">
        <button class="btn btn-primary" type="submit">Filtrar</button>
        <a class="btn btn-outline-secondary" href="{{ url()->current() }}">Hoy</a>
    </div>
</form>
