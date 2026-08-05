@extends('layouts.app')

@section('content')

    <form class="container-fluid exam-form" action="{{ route('eysenck.store') }}" method="POST">
            @csrf
        <div class="row justify-content-center mb-1">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">
                        <h3>{{ __('EYSENCK - H&S OCCUPATIONAL SAC') }} - {{ \Carbon\Carbon::now()->format('d-m-Y') }}</h3>
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

                            <div class="col-12 col-lg-2 col-sm-12 col-md-12">
                                <div class="mb-0">
                                    <label for="age" class="form-label">Edad</label>
                                    <input type="number" name="age" class="form-control @error('age') border border-danger @enderror" value="{{ old('age') }}">
                                    @error('age')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 col-lg-4 col-sm-12 col-md-12">
                                <div class="mb-2">
                                    <label for="ocupation" class="form-label">Profesión</label>
                                    <input type="text" name="ocupation" class="form-control @error('ocupation') border border-danger @enderror" value="{{ old('ocupation') }}">
                                    @error('ocupation')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <p class="bg-warning">
                                Aquí tienes algunas preguntas sobre el modo como Ud. se comporta, siente y actúa. Después
                                de cada pregunta, en la hoja de respuestas marque <strong style="font-size: 1.2rem">“SI"</strong> o <strong style="font-size: 1.2rem">"NO"</strong>.  Y Asegúrese de no omitir alguna pregunta.
                                Ahora, comience. Trabaje rápidamente y recuerde de contestar todas las preguntas. No hay contestaciones "correctas" o "incorrectas", y éste no es un test de inteligencia o habilidad, sino simplemente una medida de la forma como Ud. se comporta.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">

                        <div class="card-body">

                            <div class="row">

                                @include('eysenck.includes.partial1')

                                @include('eysenck.includes.partial2')

                                @include('eysenck.includes.partial3')

                                <div class="col-12 col-lg-2 col-sm-12 col-md-12 text-center">
                                    <div class="mb-1">
                                        <input type="hidden" id="totale" name="suma_e" class="form-control">
                                    </div>
                                </div>

                                <div class="col-12 col-lg-2 col-sm-12 col-md-12 text-center">
                                    <div class="mb-1">
                                        <input type="hidden" id="totaln" name="suma_n" class="form-control">
                                    </div>
                                </div>

                                <div class="col-12 col-lg-2 col-sm-12 col-md-12 text-center">
                                    <div class="mb-1">
                                        <input type="hidden" id="totall" name="suma_l" class="form-control">
                                    </div>
                                </div>

                                <div class="col-12 col-lg-8 col-sm-12 col-md-12">
                                    <div class="mb-1">
                                        <input type="hidden" id="diagnostico" name="dx" class="form-control"  autofocus>
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

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function () {
            // Función para obtener la suma de un grupo específico
            function obtenerSuma(clase, resultadoId) {
                // Inicializar la suma
                var suma = 0;

                // Iterar sobre todos los selects y sumar sus valores
                $(clase).each(function () {
                    suma += parseInt($(this).val()) || 0; // Convertir a entero y manejar posibles NaN
                });

                // Mostrar la suma en la vista
                $(resultadoId).val(suma);

                return suma;
            }

            // Evento cuando cambia el valor de los select con la clase 'e'
            $('.e').on('change', function () {
                // Obtener la suma y mostrarla en la vista
                var suma = obtenerSuma('.e', '#totale');

                // Obtener los valores de los otros dos inputs (suma2 y suma3)
                var suma2 = parseFloat($('#suma2').val()) || 0;
                var suma3 = parseFloat($('#suma3').val()) || 0;

                // Obtener el diagnóstico llamando a la función
                var diagnostico = obtenerDiagnostico(suma, suma2, suma3);

                // Mostrar el diagnóstico en la vista o donde desees
                $('#diagnostico').val(diagnostico);
            });

            // Evento cuando cambia el valor del segundo input (suma2)
            $('.n').on('change', function () {
                // Obtener la suma2 y mostrarla en la vista
                var suma2 = obtenerSuma('.n', '#totaln');

                // Obtener los valores de los otros dos inputs (suma y suma3)
                var suma = parseFloat($('#totale').val()) || 0;
                var suma3 = parseFloat($('#suma3').val()) || 0;

                // Obtener el diagnóstico llamando a la función
                var diagnostico = obtenerDiagnostico(suma, suma2, suma3);

                // Mostrar el diagnóstico en la vista o donde desees
                $('#diagnostico').val(diagnostico);
            });

            // Evento cuando cambia el valor del tercer input (suma3)
            $('.l').on('change', function () {
                // Obtener la suma3 y mostrarla en la vista
                var suma3 = obtenerSuma('.l', '#totall');

                // Obtener los valores de los otros dos inputs (suma y suma2)
                var suma = parseFloat($('#totale').val()) || 0;
                var suma2 = parseFloat($('#totaln').val()) || 0;

                // Obtener el diagnóstico llamando a la función
                var diagnostico = obtenerDiagnostico(suma, suma2, suma3);

                // Mostrar el diagnóstico en la vista o donde desees
                $('#diagnostico').val(diagnostico);
            });

            // Función para obtener el diagnóstico
            function obtenerDiagnostico(coordenadae, coordenadan, coordenada3) {
                // Lógica de condición basada en los valores de las coordenadas (ajústala según tus necesidades)
                if (coordenadae >= 10 && coordenadae < 14 && coordenadan > 11 && coordenadan < 16) {
                    return 'TENDIENTE - MELANCOLICO';
                } else if (coordenadae < 10 && coordenadan > 16) {
                    return 'ALTAMENTE - MELANCOLICO';
                } else if (coordenadae >= 10 && coordenadae < 14 && coordenadan > 6 && coordenadan < 12) {
                    return 'TENDIENTE - FLEMATICO';
                } else if (coordenadae < 11 && coordenadan < 7) {
                    return 'ALTAMENTE - FLEMATICO';
                } else if (coordenadae > 13 && coordenadae < 17 && coordenadan > 11 && coordenadan < 16) {
                    return 'TENDIENTE - COLERICO';
                } else if (coordenadae > 16 && coordenadan > 16) {
                    return 'ALTAMENTE - COLERICO';
                } else if (coordenadae > 13 && coordenadae < 17 && coordenadan > 6 && coordenadan < 12) {
                    return 'TENDIENTE - SANGUINEO';
                } else if (coordenadae > 16 && coordenadan < 7) {
                    return 'ALTAMENTE - SANGUINEO';
                } else {
                    return 'VOLVER A REALIZAR';
                }
            }
        });

    </script>
@endsection
