@extends('layouts.app')

@section('content')

    <form class="container-fluid exam-form" action="{{ route('cohen.store') }}" method="POST">
        @csrf

        <div class="row justify-content-center mb-1">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">
                        <h3>{{ __('CUESTIONARIO DE ACROFOBIA (COHEN)') }} - {{ \Carbon\Carbon::now()->format('d-m-Y') }}</h3>
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
                                A continuación se muestra una lista de situaciones, de las cuales estamos interesados en saber que le producen las mismas.
                                Por favor indique como se sentiría en cada una de ellas, seleccionando del 0 al 6 en el casilleros correspondiente.
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
                                            <th scope="col">TRANQUILO Y RELAJADO</th>
                                            <th scope="col">UN POCO DE MIEDO</th>
                                            <th scope="col">MIEDO</th>
                                            <th scope="col">MUCHO MIEDO</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>0-1</td>
                                            <td>2-3</td>
                                            <td>4-5</td>
                                            <td>6</td>
                                        </tr>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="row">
                                    <label for="p1" class="col-sm-10 col-form-label">1. Salto de un trampolín a pocos metro de la piscina.</label>
                                    <div class="col-sm-2 mb-1">
                                        <select class="form-select" aria-label="Default select example" name="p1">
                                            @for($i = 0; $i <= 6; $i++ )
                                                <option value="{{ $i }}" {{ old('p1') == $i ? 'selected' : '' }}>
                                                    {{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>

                                    <label for="p2" class="col-sm-10 col-form-label">2. Cruzando un rio caminando sobre las rocas.</label>
                                    <div class="col-sm-2 mb-1">
                                        <select class="form-select" aria-label="Default select example" name="p2">
                                            @for($i = 0; $i <= 6; $i++ )
                                                <option value="{{ $i }}" {{ old('p2') == $i ? 'selected' : '' }}>
                                                    {{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>

                                    <label for="p3" class="col-sm-10 col-form-label">3. Mirando hacia abajo desde lo alto de una escalera de caracol.</label>
                                    <div class="col-sm-2 mb-1">
                                        <select class="form-select" aria-label="Default select example" name="p3">
                                            @for($i = 0; $i <= 6; $i++ )
                                                <option value="{{ $i }}" {{ old('p3') == $i ? 'selected' : '' }}>
                                                    {{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>

                                    <label for="p4" class="col-sm-10 col-form-label">4. Mantenerse al tanto de una escalera apoyada contra una casa de dos pisos.</label>
                                    <div class="col-sm-2 mb-1">
                                        <select class="form-select" aria-label="Default select example" name="p4">
                                            @for($i = 0; $i <= 6; $i++ )
                                                <option value="{{ $i }}" {{ old('p4') == $i ? 'selected' : '' }}>
                                                    {{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>

                                    <label for="p5" class="col-sm-10 col-form-label">5. Sentado frente a una tribuna alta.</label>
                                    <div class="col-sm-2 mb-1">
                                        <select class="form-select" aria-label="Default select example" name="p5">
                                            @for($i = 0; $i <= 6; $i++ )
                                                <option value="{{ $i }}" {{ old('p5') == $i ? 'selected' : '' }}>
                                                    {{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>

                                    <label for="p6" class="col-sm-10 col-form-label">6. Paseo en la rueda de Juegos Mecánicos.</label>
                                    <div class="col-sm-2 mb-1">
                                        <select class="form-select" aria-label="Default select example" name="p6">
                                            @for($i = 0; $i <= 6; $i++ )
                                                <option value="{{ $i }}" {{ old('p6') == $i ? 'selected' : '' }}>
                                                    {{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>

                                    <label for="p7" class="col-sm-10 col-form-label">7. En una colina empinada.</label>
                                    <div class="col-sm-2 mb-1">
                                        <select class="form-select" aria-label="Default select example" name="p7">
                                            @for($i = 0; $i <= 6; $i++ )
                                                <option value="{{ $i }}" {{ old('p7') == $i ? 'selected' : '' }}>
                                                    {{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>

                                    <label for="p8" class="col-sm-10 col-form-label">8. Viajar en avión.</label>
                                    <div class="col-sm-2 mb-1">
                                        <select class="form-select" aria-label="Default select example" name="p8">
                                            @for($i = 0; $i <= 6; $i++ )
                                                <option value="{{ $i }}" {{ old('p8') == $i ? 'selected' : '' }}>
                                                    {{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>

                                    <label for="p9" class="col-sm-10 col-form-label">9. Estar cerca de una ventana abierta en el tercer piso.</label>
                                    <div class="col-sm-2 mb-1">
                                        <select class="form-select" aria-label="Default select example" name="p9">
                                            @for($i = 0; $i <= 6; $i++ )
                                                <option value="{{ $i }}" {{ old('p9') == $i ? 'selected' : '' }}>
                                                    {{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>

                                    <label for="p10" class="col-sm-10 col-form-label">10. Cruzar un puente peatonal sobre la autopista.</label>
                                    <div class="col-sm-2 mb-1">
                                        <select class="form-select" aria-label="Default select example" name="p10">
                                            @for($i = 0; $i <= 6; $i++ )
                                                <option value="{{ $i }}" {{ old('p10') == $i ? 'selected' : '' }}>
                                                    {{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>

                                    <label for="p11" class="col-sm-10 col-form-label">11. Conducir por un enorme puente.</label>
                                    <div class="col-sm-2 mb-1">
                                        <select class="form-select" aria-label="Default select example" name="p11">
                                            @for($i = 0; $i <= 6; $i++ )
                                                <option value="{{ $i }}" {{ old('p11') == $i ? 'selected' : '' }}>
                                                    {{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>

                                    <label for="p12" class="col-sm-10 col-form-label">12. Mirar de una ventana en una oficina ubicada en el 15 piso de un edificio.</label>
                                    <div class="col-sm-2 mb-1">
                                        <select class="form-select" aria-label="Default select example" name="p12">
                                            @for($i = 0; $i <= 6; $i++ )
                                                <option value="{{ $i }}" {{ old('p12') == $i ? 'selected' : '' }}>
                                                    {{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>

                                    <label for="p13" class="col-sm-10 col-form-label">13. Ver los limpiadores de ventanas de 10 pisos sobre el suelo en el andamio.</label>
                                    <div class="col-sm-2 mb-1">
                                        <select class="form-select" aria-label="Default select example" name="p13">
                                            @for($i = 0; $i <= 6; $i++ )
                                                <option value="{{ $i }}" {{ old('p13') == $i ? 'selected' : '' }}>
                                                    {{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>

                                    <label for="p14" class="col-sm-10 col-form-label">14. Caminar sobre una rejilla de una vereda por la que se puede ver el fondo.</label>
                                    <div class="col-sm-2 mb-1">
                                        <select class="form-select" aria-label="Default select example" name="p14">
                                            @for($i = 0; $i <= 6; $i++ )
                                                <option value="{{ $i }}" {{ old('p14') == $i ? 'selected' : '' }}>
                                                    {{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>

                                    <label for="p15" class="col-sm-10 col-form-label">15. Permanecer en el borde de la plataforma del metropolitano.</label>
                                    <div class="col-sm-2 mb-1">
                                        <select class="form-select" aria-label="Default select example" name="p15">
                                            @for($i = 0; $i <= 6; $i++ )
                                                <option value="{{ $i }}" {{ old('p15') == $i ? 'selected' : '' }}>
                                                    {{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>

                                    <label for="p16" class="col-sm-10 col-form-label">16. Subiendo por una escalera exterior con una protección equivalente a una altura de 3 pisos.</label>
                                    <div class="col-sm-2 mb-1">
                                        <select class="form-select" aria-label="Default select example" name="p16">
                                            @for($i = 0; $i <= 6; $i++ )
                                                <option value="{{ $i }}" {{ old('p16') == $i ? 'selected' : '' }}>
                                                    {{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>

                                    <label for="p17" class="col-sm-10 col-form-label">17. Permanecer en el techo de un edificio de apartamentos de diez pisos.</label>
                                    <div class="col-sm-2 mb-1">
                                        <select class="form-select" aria-label="Default select example" name="p17">
                                            @for($i = 0; $i <= 6; $i++ )
                                                <option value="{{ $i }}" {{ old('p17') == $i ? 'selected' : '' }}>
                                                    {{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>

                                    <label for="p18" class="col-sm-10 col-form-label">18. Subir en el ascensor hasta el piso 20.</label>
                                    <div class="col-sm-2 mb-1">
                                        <select class="form-select" aria-label="Default select example" name="p18">
                                            @for($i = 0; $i <= 6; $i++ )
                                                <option value="{{ $i }}" {{ old('p18') == $i ? 'selected' : '' }}>
                                                    {{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>

                                    <label for="p19" class="col-sm-10 col-form-label">19. De pie sobre una silla para coger un objeto fuera de la plataforma.</label>
                                    <div class="col-sm-2 mb-1">
                                        <select class="form-select" aria-label="Default select example" name="p19">
                                            @for($i = 0; $i <= 6; $i++ )
                                                <option value="{{ $i }}" {{ old('p19') == $i ? 'selected' : '' }}>
                                                    {{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>

                                    <label for="p20" class="col-sm-10 col-form-label">20. Estar parado al borde de la plataforma de un barco.</label>
                                    <div class="col-sm-2 mb-1">
                                        <select class="form-select" aria-label="Default select example" name="p20">
                                            @for($i = 0; $i <= 6; $i++ )
                                                <option value="{{ $i }}" {{ old('p20') == $i ? 'selected' : '' }}>
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
