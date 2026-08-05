@extends('layouts.app')

@section('content')

    <form class="container-fluid exam-form" action="{{ route('clq.store') }}" method="POST">
        @csrf


        <div class="row justify-content-center mb-1">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">
                        <h3>{{ __('CUESTIONARIO DE CLAUSTROFOBIA CLQ') }} - {{ \Carbon\Carbon::now()->format('d-m-Y') }}</h3>
                        <div class="row">
                            <div class="col-12 col-lg-5 col-sm-12 col-md-12">
                                <div class="mb-0">
                                    <label for="name" class="form-label">Nombres y Apellidos</label>
                                    <input type="text" name="name" class="form-control @error('name') border border-danger @enderror" value="{{ old('name') }}" placeholder="Por favor rellena tus datos" autofocus>
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 col-lg-4 col-sm-12 col-md-12">
                                <div class="mb-0">
                                    <label for="company" class="form-label">Empresa</label>
                                    <input type="text" name="company" class="form-control" value="{{ old('company') }}">
                                </div>
                            </div>

                            <div class="col-12 col-lg-3 col-sm-12 col-md-12">
                                <div class="mb-2">
                                    <label for="ocupation" class="form-label">Puesto de trabajo</label>
                                    <input type="text" name="ocupation" class="form-control @error('ocupation') border border-danger @enderror" value="{{ old('ocupation') }}">
                                    @error('ocupation')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <p class="bg-warning">
                              A continuación se muestra una lista de situaciones, de las cuales estamos interesados en saber que le producen las mismas.
                            Por favor indique como se sentiría en cada una de ellas, seleccionando en el casillero correspondiente.
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
                                                <th scope="col">Nunca</th>
                                                <th scope="col">Ligeramente</th>
                                                <th scope="col">Moderadamente</th>
                                                <th scope="col">Muy ansioso</th>
                                                <th scope="col">Extremadamente ansioso</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>0-1</td>
                                                    <td>2-3</td>
                                                    <td>4-5-6</td>
                                                    <td>7-8</td>
                                                    <td>9-10</td>
                                                </tr>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                        </div>

                        <div class="row">

                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="row">
                                    <label for="p1" class="col-sm-10 col-form-label">1. Estar encerrado en una habitacion pequeña y sin ventanas durante 15 minutos.</label>
                                    <div class="col-sm-2 mb-1">
                                        <select class="form-select" aria-label="Default select example" name="p1">
                                            @for($i = 0; $i <= 10; $i++ )
                                                <option value="{{ $i }}" {{ old('p1') == $i ? 'selected' : '' }}>
                                                    {{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>

                                    <label for="p2" class="col-sm-10 col-form-label">2. Sentir que la ropa me oprime y no puedo quitármela.</label>
                                    <div class="col-sm-2 mb-1">
                                        <select class="form-select" aria-label="Default select example" name="p2">
                                            @for($i = 0; $i <= 10; $i++ )
                                                <option value="{{ $i }}" {{ old('p2') == $i ? 'selected' : '' }}>
                                                    {{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>

                                    <label for="p3" class="col-sm-10 col-form-label">3. Estar tumbado en un saco de dormir estrecho, con los brazos y piernas dentro, abrochado hasta el cuello, sin spoder salir durante 15 minutos.</label>
                                    <div class="col-sm-2 mb-1">
                                        <select class="form-select" aria-label="Default select example" name="p3">
                                            @for($i = 0; $i <= 10; $i++ )
                                                <option value="{{ $i }}" {{ old('p3') == $i ? 'selected' : '' }}>
                                                    {{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>

                                    <label for="p4" class="col-sm-10 col-form-label">4. Estar en la parte trasera de un auto de sólo tres puertas.</label>
                                    <div class="col-sm-2 mb-1">
                                        <select class="form-select" aria-label="Default select example" name="p4">
                                            @for($i = 0; $i <= 10; $i++ )
                                                <option value="{{ $i }}" {{ old('p4') == $i ? 'selected' : '' }}>
                                                    {{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>

                                    <label for="p5" class="col-sm-10 col-form-label">5. Estar en un baño público y se atasca la cerradura.</label>
                                    <div class="col-sm-2 mb-1">
                                        <select class="form-select" aria-label="Default select example" name="p5">
                                            @for($i = 0; $i <= 10; $i++ )
                                                <option value="{{ $i }}" {{ old('p5') == $i ? 'selected' : '' }}>
                                                    {{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>

                                    <label for="p6" class="col-sm-10 col-form-label">6. Estar en un tren lleno de gente que para en cada estación.</label>
                                    <div class="col-sm-2 mb-1">
                                        <select class="form-select" aria-label="Default select example" name="p6">
                                            @for($i = 0; $i <= 10; $i++ )
                                                <option value="{{ $i }}" {{ old('p6') == $i ? 'selected' : '' }}>
                                                    {{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>

                                    <label for="p7" class="col-sm-10 col-form-label">7. Estar en un ascensor en el piso más bajo con la puerta cerrada.</label>
                                    <div class="col-sm-2 mb-1">
                                        <select class="form-select" aria-label="Default select example" name="p7">
                                            @for($i = 0; $i <= 10; $i++ )
                                                <option value="{{ $i }}" {{ old('p7') == $i ? 'selected' : '' }}>
                                                    {{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>

                                    <label for="p8" class="col-sm-10 col-form-label">8. Darse una ducha o un baño con la mampara completamente cerrada.</label>
                                    <div class="col-sm-2 mb-1">
                                        <select class="form-select" aria-label="Default select example" name="p8">
                                            @for($i = 0; $i <= 10; $i++ )
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
