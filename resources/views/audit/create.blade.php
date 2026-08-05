@extends('layouts.app')

@section('content')

    <form class="container-fluid exam-form" action="{{ route('audit.store') }}" method="POST">
        @csrf


        <div class="row justify-content-center mb-1">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">
                        <h3>{{ __('CUESTIONARIO AUDIT') }} - {{ \Carbon\Carbon::now()->format('d-m-Y') }}</h3>
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
                                Lee cada pregunta y seleccione la opción que mejor se ajuste a su situación
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
                                    <label for="p1" class="col-sm-10 col-form-label">1. ¿Con qué frecuencia consume alguna bebida alcohólica?.</label>
                                    <div class="col-sm-2 mb-1">
                                        <select class="form-select" aria-label="Default select example" name="p1">
                                            <option value="0" {{ old('p1') == 1 ? 'selected' : '' }}>Nunca</option>
                                            <option value="1" {{ old('p1') == 2 ? 'selected' : '' }}>Una o menos veces al mes</option>
                                            <option value="2" {{ old('p1') == 3 ? 'selected' : '' }}>De 2 a 4 veces al mes</option>
                                            <option value="3" {{ old('p1') == 4 ? 'selected' : '' }}>De 2 a 3 veces a la semana</option>
                                            <option value="4" {{ old('p1') == 5 ? 'selected' : '' }}>4 o más veces a la semana</option>
                                        </select>
                                    </div>

                                    <label for="p2" class="col-sm-10 col-form-label">2. ¿Cuántas unidades de bebidas alcohólicas suele beber en un día de consumo normal?.</label>
                                    <div class="col-sm-2 mb-1">
                                        <select class="form-select" aria-label="Default select example" name="p2">
                                            <option value="0" {{ old('p2') == 1 ? 'selected' : '' }}>1 ó 2</option>
                                            <option value="1" {{ old('p2') == 2 ? 'selected' : '' }}>3 ó 4</option>
                                            <option value="2" {{ old('p2') == 3 ? 'selected' : '' }}>5 ó 6</option>
                                            <option value="3" {{ old('p2') == 4 ? 'selected' : '' }}>De 7 a 9</option>
                                            <option value="4" {{ old('p2') == 5 ? 'selected' : '' }}>10 o más</option>
                                        </select>
                                    </div>

                                    <label for="p3" class="col-sm-10 col-form-label">3. ¿Con qué frecuencia toma 6 ó mas bebidas alcohólicas en un solo día?.</label>
                                    <div class="col-sm-2 mb-1">
                                        <select class="form-select" aria-label="Default select example" name="p3">
                                            <option value="0" {{ old('p3') == 1 ? 'selected' : '' }}>Nunca</option>
                                            <option value="1" {{ old('p3') == 2 ? 'selected' : '' }}>Menos de una vez al mes</option>
                                            <option value="2" {{ old('p3') == 3 ? 'selected' : '' }}>Mensual</option>
                                            <option value="3" {{ old('p3') == 4 ? 'selected' : '' }}>Semanal</option>
                                            <option value="4" {{ old('p3') == 5 ? 'selected' : '' }}>Casi a diario</option>
                                        </select>
                                    </div>

                                    <label for="p4" class="col-sm-10 col-form-label">4. ¿Con qué freciencia en el curso del último año ha sido incapaz de parr de beber una vez había empezado?.</label>
                                    <div class="col-sm-2 mb-1">
                                        <select class="form-select" aria-label="Default select example" name="p4">
                                            <option value="0" {{ old('p4') == 1 ? 'selected' : '' }}>Nunca</option>
                                            <option value="1" {{ old('p4') == 2 ? 'selected' : '' }}>Menos de una vez al mes</option>
                                            <option value="2" {{ old('p4') == 3 ? 'selected' : '' }}>Mensual</option>
                                            <option value="3" {{ old('p4') == 4 ? 'selected' : '' }}>Semanal</option>
                                            <option value="4" {{ old('p4') == 5 ? 'selected' : '' }}>Casi a diario</option>
                                        </select>
                                    </div>

                                    <label for="p5" class="col-sm-10 col-form-label">5. ¿Con qué frecuencia en el último año no ha podido realizar la actividad que le correspondía, por haber bebido?.</label>
                                    <div class="col-sm-2 mb-1">
                                        <select class="form-select" aria-label="Default select example" name="p5">
                                            <option value="0" {{ old('p5') == 1 ? 'selected' : '' }}>Nunca</option>
                                            <option value="1" {{ old('p5') == 2 ? 'selected' : '' }}>Menos de una vez al mes</option>
                                            <option value="2" {{ old('p5') == 3 ? 'selected' : '' }}>Mensual</option>
                                            <option value="3" {{ old('p5') == 4 ? 'selected' : '' }}>Semanal</option>
                                            <option value="4" {{ old('p5') == 5 ? 'selected' : '' }}>Casi a diario</option>
                                        </select>
                                    </div>

                                    <label for="p6" class="col-sm-10 col-form-label">6. ¿Con qué frecuencia en el curso del último año ha necesitado beber en ayunas para recuperarse después de haber bebido mucho el día anterior?.</label>
                                    <div class="col-sm-2 mb-1">
                                        <select class="form-select" aria-label="Default select example" name="p6">
                                            <option value="0" {{ old('p6') == 1 ? 'selected' : '' }}>Nunca</option>
                                            <option value="1" {{ old('p6') == 2 ? 'selected' : '' }}>Menos de una vez al mes</option>
                                            <option value="2" {{ old('p6') == 3 ? 'selected' : '' }}>Mensual</option>
                                            <option value="3" {{ old('p6') == 4 ? 'selected' : '' }}>Semanal</option>
                                            <option value="4" {{ old('p6') == 5 ? 'selected' : '' }}>Casi a diario</option>
                                        </select>
                                    </div>

                                    <label for="p7" class="col-sm-10 col-form-label">7. ¿Con qué frecuencia en el curso del último año ha tenido remordimientos o sentiemiento de culpa después de haber bebido?.</label>
                                    <div class="col-sm-2 mb-1">
                                        <select class="form-select" aria-label="Default select example" name="p7">
                                            <option value="0" {{ old('p7') == 1 ? 'selected' : '' }}>Nunca</option>
                                            <option value="1" {{ old('p7') == 2 ? 'selected' : '' }}>Menos de una vez al mes</option>
                                            <option value="2" {{ old('p7') == 3 ? 'selected' : '' }}>Mensual</option>
                                            <option value="3" {{ old('p7') == 4 ? 'selected' : '' }}>Semanal</option>
                                            <option value="4" {{ old('p7') == 5 ? 'selected' : '' }}>Casi a diario</option>
                                        </select>
                                    </div>

                                    <label for="p8" class="col-sm-10 col-form-label">8. ¿Con qué frecuencia en el curso del último año no ha podido recordar lo que sucedió anteriormente por que había bebido?.</label>
                                    <div class="col-sm-2 mb-1">
                                        <select class="form-select" aria-label="Default select example" name="p8">
                                            <option value="0" {{ old('p8') == 1 ? 'selected' : '' }}>Nunca</option>
                                            <option value="1" {{ old('p8') == 2 ? 'selected' : '' }}>Menos de una vez al mes</option>
                                            <option value="2" {{ old('p8') == 3 ? 'selected' : '' }}>Mensual</option>
                                            <option value="3" {{ old('p8') == 4 ? 'selected' : '' }}>Semanal</option>
                                            <option value="4" {{ old('p8') == 5 ? 'selected' : '' }}>Casi a diario</option>
                                        </select>
                                    </div>

                                    <label for="p9" class="col-sm-10 col-form-label">9. ¿Usted o alguna otra persona ha resultado herido porque usted había bebido?.</label>
                                    <div class="col-sm-2 mb-1">
                                        <select class="form-select" aria-label="Default select example" name="p9">
                                            <option value="0" {{ old('p9') == 1 ? 'selected' : '' }}>No</option>
                                            <option value="1" {{ old('p9') == 2 ? 'selected' : '' }}></option>
                                            <option value="2" {{ old('p9') == 3 ? 'selected' : '' }}>Si, pero no en el curso del último año</option>
                                            <option value="3" {{ old('p9') == 4 ? 'selected' : '' }}></option>
                                            <option value="4" {{ old('p9') == 5 ? 'selected' : '' }}>Sí, el último año</option>
                                        </select>
                                    </div>

                                    <label for="p10" class="col-sm-10 col-form-label">10. ¿Algún familiar, amigo, médico o profesional sanitario ha mostrado preocupación por su consumo de bebidas alcohólicas o le ha sugerido que deje de beber?.</label>
                                    <div class="col-sm-2 mb-1">
                                        <select class="form-select" aria-label="Default select example" name="p10">
                                            <option value="0" {{ old('p10') == 1 ? 'selected' : '' }}>No</option>
                                            <option value="1" {{ old('p10') == 2 ? 'selected' : '' }}></option>
                                            <option value="2" {{ old('p10') == 3 ? 'selected' : '' }}>Si, pero no en el curso del último año</option>
                                            <option value="3" {{ old('p10') == 4 ? 'selected' : '' }}></option>
                                            <option value="4" {{ old('p10') == 5 ? 'selected' : '' }}>Sí, el último año</option>
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
