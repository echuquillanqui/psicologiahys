@extends('layouts.app')

@section('content')

    <form class="container-fluid exam-form" action="{{ route('epworth.store') }}" method="POST">
        @csrf

        <div class="row justify-content-center mb-1">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">
                        <h3>{{ __('ESCALA DE SOMNOLENCIA DE EPWORTH') }} - {{ \Carbon\Carbon::now()->format('d-m-Y') }}</h3>
                        <div class="row">
                            <div class="col-12 col-lg-6 col-sm-12 col-md-12">
                                <div class="mb-0">
                                    <label for="name" class="form-label">Nombres y Apellidos</label>
                                    <input type="text" name="name" class="form-control @error('name') border border-danger @enderror" value="{{ old('name') }}" placeholder="Por favor rellena tus datos" autofocus>
                                    @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 col-lg-6 col-sm-12 col-md-12">
                                <div class="mb-2">
                                    <label for="ocupation" class="form-label">Puesto de trabajo</label>
                                    <input type="text" name="ocupation" class="form-control @error('ocupation') border border-danger @enderror" value="{{ old('ocupation') }}">
                                    @error('ocupation')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <p class="bg-warning">
                               <strong>¿Con que frecuencia Ud. Dormido en la siguiente situacion?</strong> Incluso si no ha realizado recientemente alguna de las actividades mencionadas a continuación, trate de imaginar en que medida le afectaría.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    <div class="card-body">

                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="row">

                                    <table class="table table-bordered table-info text-center">
                                        <thead>
                                        <tr>
                                            <th scope="col">NUNCA ME DUERMO</th>
                                            <th scope="col">A VECES ME DUERMO</th>
                                            <th scope="col">FRECUENTEMENTE ME DUERMO</th>
                                            <th scope="col">SIEMPRE ME DUERMO</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>0</td>
                                            <td>1</td>
                                            <td>2</td>
                                            <td>3</td>
                                        </tr>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <H1 class="bg-info">SITUACIÓN</H1>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="row">
                                    <label for="p1" class="col-sm-10 col-form-label">1. Sentado y leyendo.</label>
                                    <div class="col-sm-2 mb-1">
                                        <select class="form-select" aria-label="Default select example" name="p1">
                                            @for($i = 0; $i <= 3; $i++ )
                                                <option value="{{ $i }}" {{ old('p1') == $i ? 'selected' : '' }}>
                                                    {{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>

                                    <label for="p2" class="col-sm-10 col-form-label">2. Viendo la televisión.</label>
                                    <div class="col-sm-2 mb-1">
                                        <select class="form-select" aria-label="Default select example" name="p2">
                                            @for($i = 0; $i <= 3; $i++ )
                                                <option value="{{ $i }}" {{ old('p2') == $i ? 'selected' : '' }}>
                                                    {{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>

                                    <label for="p3" class="col-sm-10 col-form-label">3. Sentado, Inactivo en un espectáculo (teatro, cine, etc).</label>
                                    <div class="col-sm-2 mb-1">
                                        <select class="form-select" aria-label="Default select example" name="p3">
                                            @for($i = 0; $i <= 3; $i++ )
                                                <option value="{{ $i }}" {{ old('p3') == $i ? 'selected' : '' }}>
                                                    {{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>

                                    <label for="p4" class="col-sm-10 col-form-label">4. En coche, como copiloto de un viaje de una hora.</label>
                                    <div class="col-sm-2 mb-1">
                                        <select class="form-select" aria-label="Default select example" name="p4">
                                            @for($i = 0; $i <= 3; $i++ )
                                                <option value="{{ $i }}" {{ old('p4') == $i ? 'selected' : '' }}>
                                                    {{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>

                                    <label for="p5" class="col-sm-10 col-form-label">5. Tumbado a media tarde.</label>
                                    <div class="col-sm-2 mb-1">
                                        <select class="form-select" aria-label="Default select example" name="p5">
                                            @for($i = 0; $i <= 3; $i++ )
                                                <option value="{{ $i }}" {{ old('p5') == $i ? 'selected' : '' }}>
                                                    {{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>

                                    <label for="p6" class="col-sm-10 col-form-label">6. Sentado y charlando con alguién.</label>
                                    <div class="col-sm-2 mb-1">
                                        <select class="form-select" aria-label="Default select example" name="p6">
                                            @for($i = 0; $i <= 3; $i++ )
                                                <option value="{{ $i }}" {{ old('p6') == $i ? 'selected' : '' }}>
                                                    {{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>

                                    <label for="p7" class="col-sm-10 col-form-label">7. Sentado después de la comida (sin tomar alcohol).</label>
                                    <div class="col-sm-2 mb-1">
                                        <select class="form-select" aria-label="Default select example" name="p7">
                                            @for($i = 0; $i <= 3; $i++ )
                                                <option value="{{ $i }}" {{ old('p7') == $i ? 'selected' : '' }}>
                                                    {{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>

                                    <label for="p8" class="col-sm-10 col-form-label">8. En su coche, cuando se para durante algunos minutos debido al tráfico.</label>
                                    <div class="col-sm-2 mb-1">
                                        <select class="form-select" aria-label="Default select example" name="p8">
                                            @for($i = 0; $i <= 3; $i++ )
                                                <option value="{{ $i }}" {{ old('p8') == $i ? 'selected' : '' }}>
                                                    {{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>




                    <button type="submit" class="btn btn-primary btn-lg">ENVIAR RESPUESTAS</button>

                </div>
            </div>
        </div>
        </div>
        </div>
    </form>


@endsection
