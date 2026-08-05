@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header text-center">
                        <h3>TEST DE ESTRÉS Y BOURNOUT</h3>
                    </div>
                    <form class="exam-form" action="{{ route('bournout.store') }}" method="POST">
                        @csrf
                        <div class="card-body">

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
                                        <label for="ocupacion" class="form-label">Profesión</label>
                                        <input type="text" name="ocupacion" class="form-control @error('ocupacion') border border-danger @enderror" value="{{ old('ocupacion') }}">
                                        @error('ocupacion')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                <h5 class="bg-secondary text-center text-white p-1">Escala de Frecuencia de Sentimientos</h5>

                                <div class="col-1 text-center bg-info border border-1">0 <br> Nunca</div>

                                <div class="col-2 text-center bg-info border border-1">1 <br> Pocas veces al año</div>

                                <div class="col-2 text-center bg-info border border-1">2 <br> Una vez al mes o menos</div>

                                <div class="col-2 text-center bg-info border border-1">3 <br> Unas pocas veces al mes</div>

                                <div class="col-2 text-center bg-info border border-1">4 <br> Una vez a la semana</div>

                                <div class="col-2 text-center bg-info border border-1">5 <br> Pocas veces a la semana</div>

                                <div class="col-1 text-center bg-info border border-1">6 <br> Todos los dias</div>

                                <h5 class="bg-secondary text-center text-white p-1 mt-1">Conteste las frases indicando la frecuencia con que Ud. ha experimentado ese sentimiento.</h5>

                            </div>

                            <hr>

                            <div class="row">
                                    <label for="answer1" class="col-sm-10 col-form-label">1. Me siento emocionalmente agotado por mi trabajo.</label>
                                    <div class="col-sm-2 mb-1">
                                        <select class="form-select respuesta" aria-label="Default select example" name="answer1" value="{{ old('answer1') }}" required>
                                            <option value="">Elija</option>
                                            <option value="0" {{ old('answer1') == '0' ? 'selected' : '' }}>0</option>
                                            <option value="1" {{ old('answer1') == '1' ? 'selected' : '' }}>1</option>
                                            <option value="2" {{ old('answer1') == '2' ? 'selected' : '' }}>2</option>
                                            <option value="3" {{ old('answer1') == '3' ? 'selected' : '' }}>3</option>
                                            <option value="4" {{ old('answer1') == '4' ? 'selected' : '' }}>4</option>
                                            <option value="5" {{ old('answer1') == '5' ? 'selected' : '' }}>5</option>
                                            <option value="6" {{ old('answer1') == '6' ? 'selected' : '' }}>6</option>
                                        </select>
                                    </div>

                                    <label for="answer2" class="col-sm-10 col-form-label">2. Me siento cansado al final de la jornada de trabajo.</label>
                                    <div class="col-sm-2 mb-1">
                                        <select class="form-select respuesta" aria-label="Default select example" name="answer2" value="{{ old('answer2') }}" required>
                                            <option value="">Elija</option>
                                            <option value="0" {{ old('answer2') == '0' ? 'selected' : '' }}>0</option>
                                            <option value="1" {{ old('answer2') == '1' ? 'selected' : '' }}>1</option>
                                            <option value="2" {{ old('answer2') == '2' ? 'selected' : '' }}>2</option>
                                            <option value="3" {{ old('answer2') == '3' ? 'selected' : '' }}>3</option>
                                            <option value="4" {{ old('answer2') == '4' ? 'selected' : '' }}>4</option>
                                            <option value="5" {{ old('answer2') == '5' ? 'selected' : '' }}>5</option>
                                            <option value="6" {{ old('answer2') == '6' ? 'selected' : '' }}>6</option>
                                        </select>
                                    </div>

                                    <label for="answer3" class="col-sm-10 col-form-label">3. Me siento fatigado cuando me levanto por la mañana y tengo que enfrentarme con otro día de trabajo.</label>
                                    <div class="col-sm-2 mb-1">
                                        <select class="form-select respuesta" aria-label="Default select example" name="answer3" value="{{ old('answer3') }}" required>
                                            <option value="">Elija</option>
                                            <option value="0" {{ old('answer3') == '0' ? 'selected' : '' }}>0</option>
                                            <option value="1" {{ old('answer3') == '1' ? 'selected' : '' }}>1</option>
                                            <option value="2" {{ old('answer3') == '2' ? 'selected' : '' }}>2</option>
                                            <option value="3" {{ old('answer3') == '3' ? 'selected' : '' }}>3</option>
                                            <option value="4" {{ old('answer3') == '4' ? 'selected' : '' }}>4</option>
                                            <option value="5" {{ old('answer3') == '5' ? 'selected' : '' }}>5</option>
                                            <option value="6" {{ old('answer3') == '6' ? 'selected' : '' }}>6</option>
                                        </select>
                                    </div>

                                    <label for="answer4" class="col-sm-10 col-form-label">4. Fácilmente comprendo cómo se sienten las personas.</label>
                                    <div class="col-sm-2 mb-1">
                                        <select class="form-select respuesta" aria-label="Default select example" name="answer4" value="{{ old('answer4') }}" required>
                                            <option value="">Elija</option>
                                            <option value="6" {{ old('answer4') == '6' ? 'selected' : '' }}>0</option>
                                            <option value="5" {{ old('answer4') == '5' ? 'selected' : '' }}>1</option>
                                            <option value="4" {{ old('answer4') == '4' ? 'selected' : '' }}>2</option>
                                            <option value="3" {{ old('answer4') == '3' ? 'selected' : '' }}>3</option>
                                            <option value="2" {{ old('answer4') == '2' ? 'selected' : '' }}>4</option>
                                            <option value="1" {{ old('answer4') == '1' ? 'selected' : '' }}>5</option>
                                            <option value="0" {{ old('answer4') == '0' ? 'selected' : '' }}>6</option>
                                        </select>
                                    </div>

                                    <label for="answer5" class="col-sm-10 col-form-label">5. Creo que trato a algunas personas como si fueran objetos no personales.</label>
                                    <div class="col-sm-2 mb-1">
                                        <select class="form-select respuesta" aria-label="Default select example" name="answer5" value="{{ old('answer5') }}" required>
                                            <option value="">Elija</option>
                                            <option value="6" {{ old('answer5') == '6' ? 'selected' : '' }}>0</option>
                                            <option value="5" {{ old('answer5') == '5' ? 'selected' : '' }}>1</option>
                                            <option value="4" {{ old('answer5') == '4' ? 'selected' : '' }}>2</option>
                                            <option value="3" {{ old('answer5') == '3' ? 'selected' : '' }}>3</option>
                                            <option value="2" {{ old('answer5') == '2' ? 'selected' : '' }}>4</option>
                                            <option value="1" {{ old('answer5') == '1' ? 'selected' : '' }}>5</option>
                                            <option value="0" {{ old('answer5') == '0' ? 'selected' : '' }}>6</option>
                                        </select>
                                    </div>

                                    <label for="answer6" class="col-sm-10 col-form-label">6. Trabajar todo el día con personas es un esfuerzo.</label>
                                    <div class="col-sm-2 mb-1">
                                        <select class="form-select respuesta" aria-label="Default select example" name="answer6" value="{{ old('answer6') }}" required>
                                            <option value="">Elija</option>
                                            <option value="0" {{ old('answer6') == '0' ? 'selected' : '' }}>0</option>
                                            <option value="1" {{ old('answer6') == '1' ? 'selected' : '' }}>1</option>
                                            <option value="2" {{ old('answer6') == '2' ? 'selected' : '' }}>2</option>
                                            <option value="3" {{ old('answer6') == '3' ? 'selected' : '' }}>3</option>
                                            <option value="4" {{ old('answer6') == '4' ? 'selected' : '' }}>4</option>
                                            <option value="5" {{ old('answer6') == '5' ? 'selected' : '' }}>5</option>
                                            <option value="6" {{ old('answer6') == '6' ? 'selected' : '' }}>6</option>
                                        </select>
                                    </div>

                                    <label for="answer7" class="col-sm-10 col-form-label">7. Trato muy eficazmente los problemas de las personas.</label>
                                    <div class="col-sm-2 mb-1">
                                        <select class="form-select respuesta" aria-label="Default select example" name="answer7" value="{{ old('answer7') }}" required>
                                            <option value="">Elija</option>
                                            <option value="6" {{ old('answer7') == '6' ? 'selected' : '' }}>0</option>
                                            <option value="5" {{ old('answer7') == '5' ? 'selected' : '' }}>1</option>
                                            <option value="4" {{ old('answer7') == '4' ? 'selected' : '' }}>2</option>
                                            <option value="3" {{ old('answer7') == '3' ? 'selected' : '' }}>3</option>
                                            <option value="2" {{ old('answer7') == '2' ? 'selected' : '' }}>4</option>
                                            <option value="1" {{ old('answer7') == '1' ? 'selected' : '' }}>5</option>
                                            <option value="0" {{ old('answer7') == '0' ? 'selected' : '' }}>6</option>
                                        </select>
                                    </div>

                                    <label for="answer8" class="col-sm-10 col-form-label">8. Me siento “quemado” por mi trabajo.</label>
                                    <div class="col-sm-2 mb-1">
                                        <select class="form-select respuesta" aria-label="Default select example" name="answer8" value="{{ old('answer8') }}" required>
                                            <option value="">Elija</option>
                                            <option value="0" {{ old('answer8') == '0' ? 'selected' : '' }}>0</option>
                                            <option value="1" {{ old('answer8') == '1' ? 'selected' : '' }}>1</option>
                                            <option value="2" {{ old('answer8') == '2' ? 'selected' : '' }}>2</option>
                                            <option value="3" {{ old('answer8') == '3' ? 'selected' : '' }}>3</option>
                                            <option value="4" {{ old('answer8') == '4' ? 'selected' : '' }}>4</option>
                                            <option value="5" {{ old('answer8') == '5' ? 'selected' : '' }}>5</option>
                                            <option value="6" {{ old('answer8') == '6' ? 'selected' : '' }}>6</option>
                                        </select>
                                    </div>

                                    <label for="answer9" class="col-sm-10 col-form-label">9. Creo que estoy influyendo positivamente con mi trabajo en las vidas de los demás.</label>
                                    <div class="col-sm-2 mb-1">
                                        <select class="form-select respuesta" aria-label="Default select example" name="answer9" value="{{ old('answer9') }}" required>
                                            <option value="">Elija</option>
                                            <option value="6" {{ old('answer9') == '6' ? 'selected' : '' }}>0</option>
                                            <option value="5" {{ old('answer9') == '5' ? 'selected' : '' }}>1</option>
                                            <option value="4" {{ old('answer9') == '4' ? 'selected' : '' }}>2</option>
                                            <option value="3" {{ old('answer9') == '3' ? 'selected' : '' }}>3</option>
                                            <option value="2" {{ old('answer9') == '2' ? 'selected' : '' }}>4</option>
                                            <option value="1" {{ old('answer9') == '1' ? 'selected' : '' }}>5</option>
                                            <option value="0" {{ old('answer9') == '0' ? 'selected' : '' }}>6</option>
                                        </select>
                                    </div>

                                    <label for="answer10" class="col-sm-10 col-form-label">10. Me he vuelto más insensible con la gente desde que ejerzo esta profesión.</label>
                                    <div class="col-sm-2 mb-1">
                                        <select class="form-select respuesta" aria-label="Default select example" name="answer10" value="{{ old('answer10') }}" required>
                                            <option value="">Elija</option>
                                            <option value="0" {{ old('answer10') == '0' ? 'selected' : '' }}>0</option>
                                            <option value="1" {{ old('answer10') == '1' ? 'selected' : '' }}>1</option>
                                            <option value="2" {{ old('answer10') == '2' ? 'selected' : '' }}>2</option>
                                            <option value="3" {{ old('answer10') == '3' ? 'selected' : '' }}>3</option>
                                            <option value="4" {{ old('answer10') == '4' ? 'selected' : '' }}>4</option>
                                            <option value="5" {{ old('answer10') == '5' ? 'selected' : '' }}>5</option>
                                            <option value="6" {{ old('answer10') == '6' ? 'selected' : '' }}>6</option>
                                        </select>
                                    </div>

                                    <label for="answer11" class="col-sm-10 col-form-label">11. Me preocupa el hecho de que este trabajo me este endureciendo emocionalmente.</label>
                                    <div class="col-sm-2 mb-1">
                                        <select class="form-select respuesta" aria-label="Default select example" name="answer11" value="{{ old('answer11') }}" required>
                                            <option value="">Elija</option>
                                            <option value="0" {{ old('answer11') == '0' ? 'selected' : '' }}>0</option>
                                            <option value="1" {{ old('answer11') == '1' ? 'selected' : '' }}>1</option>
                                            <option value="2" {{ old('answer11') == '2' ? 'selected' : '' }}>2</option>
                                            <option value="3" {{ old('answer11') == '3' ? 'selected' : '' }}>3</option>
                                            <option value="4" {{ old('answer11') == '4' ? 'selected' : '' }}>4</option>
                                            <option value="5" {{ old('answer11') == '5' ? 'selected' : '' }}>5</option>
                                            <option value="6" {{ old('answer11') == '6' ? 'selected' : '' }}>6</option>
                                        </select>
                                    </div>

                                    <label for="answer12" class="col-sm-10 col-form-label">12. Me siento muy activo.</label>
                                    <div class="col-sm-2 mb-1">
                                        <select class="form-select respuesta" aria-label="Default select example" name="answer12" value="{{ old('answer12') }}" required>
                                            <option value="">Elija</option>
                                            <option value="6" {{ old('answer12') == '6' ? 'selected' : '' }}>0</option>
                                            <option value="5" {{ old('answer12') == '5' ? 'selected' : '' }}>1</option>
                                            <option value="4" {{ old('answer12') == '4' ? 'selected' : '' }}>2</option>
                                            <option value="3" {{ old('answer12') == '3' ? 'selected' : '' }}>3</option>
                                            <option value="2" {{ old('answer12') == '2' ? 'selected' : '' }}>4</option>
                                            <option value="1" {{ old('answer12') == '1' ? 'selected' : '' }}>5</option>
                                            <option value="0" {{ old('answer12') == '0' ? 'selected' : '' }}>6</option>
                                        </select>
                                    </div>

                                    <label for="answer13" class="col-sm-10 col-form-label">13. Me siento frustrado en mi trabajo.</label>
                                    <div class="col-sm-2 mb-1">
                                        <select class="form-select respuesta" aria-label="Default select example" name="answer13" value="{{ old('answer13') }}" required>
                                            <option value="">Elija</option>
                                            <option value="0" {{ old('answer13') == '0' ? 'selected' : '' }}>0</option>
                                            <option value="1" {{ old('answer13') == '1' ? 'selected' : '' }}>1</option>
                                            <option value="2" {{ old('answer13') == '2' ? 'selected' : '' }}>2</option>
                                            <option value="3" {{ old('answer13') == '3' ? 'selected' : '' }}>3</option>
                                            <option value="4" {{ old('answer13') == '4' ? 'selected' : '' }}>4</option>
                                            <option value="5" {{ old('answer13') == '5' ? 'selected' : '' }}>5</option>
                                            <option value="6" {{ old('answer13') == '6' ? 'selected' : '' }}>6</option>
                                        </select>
                                    </div>

                                    <label for="answer14" class="col-sm-10 col-form-label">14. Creo que estoy trabajando demasiado.</label>
                                    <div class="col-sm-2 mb-1">
                                        <select class="form-select respuesta" aria-label="Default select example" name="answer14" value="{{ old('answer14') }}" required>
                                            <option value="">Elija</option>
                                            <option value="0" {{ old('answer14') == '0' ? 'selected' : '' }}>0</option>
                                            <option value="1" {{ old('answer14') == '1' ? 'selected' : '' }}>1</option>
                                            <option value="2" {{ old('answer14') == '2' ? 'selected' : '' }}>2</option>
                                            <option value="3" {{ old('answer14') == '3' ? 'selected' : '' }}>3</option>
                                            <option value="4" {{ old('answer14') == '4' ? 'selected' : '' }}>4</option>
                                            <option value="5" {{ old('answer14') == '5' ? 'selected' : '' }}>5</option>
                                            <option value="6" {{ old('answer14') == '6' ? 'selected' : '' }}>6</option>
                                        </select>
                                    </div>

                                    <label for="answer15" class="col-sm-10 col-form-label">15. No me  preocupa realmente lo que le ocurre realmente a algunas personas a las que doy servicio.</label>
                                    <div class="col-sm-2 mb-1">
                                        <select class="form-select respuesta" aria-label="Default select example" name="answer15" value="{{ old('answer15') }}" required>
                                            <option value="">Elija</option>
                                            <option value="0" {{ old('answer15') == '0' ? 'selected' : '' }}>0</option>
                                            <option value="1" {{ old('answer15') == '1' ? 'selected' : '' }}>1</option>
                                            <option value="2" {{ old('answer15') == '2' ? 'selected' : '' }}>2</option>
                                            <option value="3" {{ old('answer15') == '3' ? 'selected' : '' }}>3</option>
                                            <option value="4" {{ old('answer15') == '4' ? 'selected' : '' }}>4</option>
                                            <option value="5" {{ old('answer15') == '5' ? 'selected' : '' }}>5</option>
                                            <option value="6" {{ old('answer15') == '6' ? 'selected' : '' }}>6</option>
                                        </select>
                                    </div>

                                    <label for="answer16" class="col-sm-10 col-form-label">16. Trabajar directamente con personas me produce estrés</label>
                                    <div class="col-sm-2 mb-1">
                                        <select class="form-select respuesta" aria-label="Default select example" name="answer16" value="{{ old('answer16') }}" requiredu>
                                            <option value="">Elija</option>
                                            <option value="0" {{ old('answer16') == '0' ? 'selected' : '' }}>0</option>
                                            <option value="1" {{ old('answer16') == '1' ? 'selected' : '' }}>1</option>
                                            <option value="2" {{ old('answer16') == '2' ? 'selected' : '' }}>2</option>
                                            <option value="3" {{ old('answer16') == '3' ? 'selected' : '' }}>3</option>
                                            <option value="4" {{ old('answer16') == '4' ? 'selected' : '' }}>4</option>
                                            <option value="5" {{ old('answer16') == '5' ? 'selected' : '' }}>5</option>
                                            <option value="6" {{ old('answer16') == '6' ? 'selected' : '' }}>6</option>
                                        </select>
                                    </div>

                                    <label for="answer17" class="col-sm-10 col-form-label">17. Fácilmente puedo crear una atmósfera relajada con las personas a las que doy servicio.</label>
                                    <div class="col-sm-2 mb-1">
                                        <select class="form-select respuesta" aria-label="Default select example" name="answer17" value="{{ old('answer17') }}" required>
                                            <option value="">Elija</option>
                                            <option value="6" {{ old('answer17') == '6' ? 'selected' : '' }}>0</option>
                                            <option value="5" {{ old('answer17') == '5' ? 'selected' : '' }}>1</option>
                                            <option value="4" {{ old('answer17') == '4' ? 'selected' : '' }}>2</option>
                                            <option value="3" {{ old('answer17') == '3' ? 'selected' : '' }}>3</option>
                                            <option value="2" {{ old('answer17') == '2' ? 'selected' : '' }}>4</option>
                                            <option value="1" {{ old('answer17') == '1' ? 'selected' : '' }}>5</option>
                                            <option value="0" {{ old('answer17') == '0' ? 'selected' : '' }}>6</option>
                                        </select>
                                    </div>

                                    <label for="answer18" class="col-sm-10 col-form-label">18. Me siento estimulado después de trabajar en contacto con personas.</label>
                                    <div class="col-sm-2 mb-1">
                                        <select class="form-select respuesta" aria-label="Default select example" name="answer18" value="{{ old('answer18') }}" required>
                                            <option value="">Elija</option>
                                            <option value="6" {{ old('answer18') == '6' ? 'selected' : '' }}>0</option>
                                            <option value="5" {{ old('answer18') == '5' ? 'selected' : '' }}>1</option>
                                            <option value="4" {{ old('answer18') == '4' ? 'selected' : '' }}>2</option>
                                            <option value="3" {{ old('answer18') == '3' ? 'selected' : '' }}>3</option>
                                            <option value="2" {{ old('answer18') == '2' ? 'selected' : '' }}>4</option>
                                            <option value="1" {{ old('answer18') == '1' ? 'selected' : '' }}>5</option>
                                            <option value="0" {{ old('answer18') == '0' ? 'selected' : '' }}>6</option>
                                        </select>
                                    </div>

                                    <label for="answer19" class="col-sm-10 col-form-label">19. He conseguido muchas cosas útiles en mi profesión.</label>
                                    <div class="col-sm-2 mb-1">
                                        <select class="form-select respuesta" aria-label="Default select example" name="answer19" value="{{ old('answer19') }}" required>
                                            <option value="">Elija</option>
                                            <option value="6" {{ old('answer19') == '6' ? 'selected' : '' }}>0</option>
                                            <option value="5" {{ old('answer19') == '5' ? 'selected' : '' }}>1</option>
                                            <option value="4" {{ old('answer19') == '4' ? 'selected' : '' }}>2</option>
                                            <option value="3" {{ old('answer19') == '3' ? 'selected' : '' }}>3</option>
                                            <option value="2" {{ old('answer19') == '2' ? 'selected' : '' }}>4</option>
                                            <option value="1" {{ old('answer19') == '1' ? 'selected' : '' }}>5</option>
                                            <option value="0" {{ old('answer19') == '0' ? 'selected' : '' }}>6</option>
                                        </select>
                                    </div>

                                    <label for="answer20" class="col-sm-10 col-form-label">20. Me siento acabado.</label>
                                    <div class="col-sm-2 mb-1">
                                        <select class="form-select respuesta" aria-label="Default select example" name="answer20" value="{{ old('answer20') }}" required>
                                            <option value="">Elija</option>
                                            <option value="0" {{ old('answer20') == '0' ? 'selected' : '' }}>0</option>
                                            <option value="1" {{ old('answer20') == '1' ? 'selected' : '' }}>1</option>
                                            <option value="2" {{ old('answer20') == '2' ? 'selected' : '' }}>2</option>
                                            <option value="3" {{ old('answer20') == '3' ? 'selected' : '' }}>3</option>
                                            <option value="4" {{ old('answer20') == '4' ? 'selected' : '' }}>4</option>
                                            <option value="5" {{ old('answer20') == '5' ? 'selected' : '' }}>5</option>
                                            <option value="6" {{ old('answer20') == '6' ? 'selected' : '' }}>6</option>
                                        </select>
                                    </div>

                                    <label for="answer21" class="col-sm-10 col-form-label">21. En mi trabajo trato los problemas emocionales con mucha calma.</label>
                                    <div class="col-sm-2 mb-1">
                                        <select class="form-select respuesta" aria-label="Default select example" name="answer21" value="{{ old('answer21') }}" required>
                                            <option value="">Elija</option>
                                            <option value="6" {{ old('answer21') == '6' ? 'selected' : '' }}>0</option>
                                            <option value="5" {{ old('answer21') == '5' ? 'selected' : '' }}>1</option>
                                            <option value="4" {{ old('answer21') == '4' ? 'selected' : '' }}>2</option>
                                            <option value="3" {{ old('answer21') == '3' ? 'selected' : '' }}>3</option>
                                            <option value="2" {{ old('answer21') == '2' ? 'selected' : '' }}>4</option>
                                            <option value="1" {{ old('answer21') == '1' ? 'selected' : '' }}>5</option>
                                            <option value="0" {{ old('answer21') == '0' ? 'selected' : '' }}>6</option>
                                        </select>
                                    </div>

                                    <label for="answer22" class="col-sm-10 col-form-label">22. Creo que las personas que trato me culpan de algunos de sus problemas.</label>
                                    <div class="col-sm-2 mb-1">
                                        <select class="form-select respuesta" aria-label="Default select example" name="answer22" value="{{ old('answer22') }}" required>
                                            <option value="">Elija</option>
                                            <option value="0" {{ old('answer22') == '0' ? 'selected' : '' }}>0</option>
                                            <option value="1" {{ old('answer22') == '1' ? 'selected' : '' }}>1</option>
                                            <option value="2" {{ old('answer22') == '2' ? 'selected' : '' }}>2</option>
                                            <option value="3" {{ old('answer22') == '3' ? 'selected' : '' }}>3</option>
                                            <option value="4" {{ old('answer22') == '4' ? 'selected' : '' }}>4</option>
                                            <option value="5" {{ old('answer22') == '5' ? 'selected' : '' }}>5</option>
                                            <option value="6" {{ old('answer22') == '6' ? 'selected' : '' }}>6</option>
                                        </select>
                                    </div>


                                <div class="col-12 col-lg-2 col-sm-12 col-md-12">
                                    <div class="mb-1">
                                        <input type="hidden" id="total" name="score" class="form-control"  autofocus>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-2 col-sm-12 col-md-12">
                                    <div class="mb-1">
                                        <input type="hidden" id="percent" name="percent" class="form-control"  autofocus>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-8 col-sm-12 col-md-12">
                                    <div class="mb-1">
                                        <input type="hidden" id="category" name="category" class="form-control"  autofocus>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-outline-primary">Guardar</button>

                                </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function () {
            // Escuchar el cambio en los selects con la clase 'respuesta'
            $('.respuesta').on('change', function () {
                // Inicializar la suma
                var suma = 0;

                // Iterar sobre todos los selects y sumar sus valores
                $('.respuesta').each(function () {
                    suma += parseInt($(this).val()) || 0; // Convertir a entero y manejar posibles NaN
                });

                // Mostrar la suma en la vista
                $('#total').val(suma);

                var divisionResultado = (suma / 132) * 100;
                $('#percent').val(divisionResultado.toFixed(2));

                var category = obtenerDiagnostico(divisionResultado);
                $('#category').val(category);
            });

            function obtenerDiagnostico(resultado) {
                // Lógica de condición basada en rangos (ajústala según tus necesidades)
                if (resultado >= 0 && resultado <= 22) {
                    return 'Ausencia de dificultades y estrés';
                } else if (resultado > 23 && resultado <= 59) {
                    return 'Baja presencia de dificultades y estrés';
                } else if (resultado > 60 && resultado <= 90) {
                    return 'Moderada presencia de dificultades y estrés';
                } else {
                    return 'Moderada presencia de dificultades y estrés';
                }
            }
        });
    </script>
@endsection
