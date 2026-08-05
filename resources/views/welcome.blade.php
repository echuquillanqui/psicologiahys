@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center min-vh-75">
        <div class="col-lg-9 col-xl-8">
            <div class="card text-center">
                <div class="card-header py-4">
                    <h1 class="display-5 fw-bold">Evaluaciones psicológicas H&S</h1>
                </div>
                <div class="card-body p-4 p-md-5">
                    <p class="lead text-muted mb-4">
                        Plataforma profesional para acceder a cuestionarios, registrar respuestas y revisar resultados con una experiencia clara, moderna y confiable.
                    </p>

                    @auth
                        <a href="{{ url('/home') }}" class="btn btn-primary btn-lg">Ir al panel principal</a>
                    @else
                        <div class="d-flex flex-column flex-sm-row gap-3 justify-content-center">
                            <a href="{{ route('login') }}" class="btn btn-primary btn-lg">Ingresar</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn btn-info btn-lg">Crear cuenta</a>
                            @endif
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
