@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-center">
                        <h3>{{ __('LISTADO DE RESULTADOS BOURNOUT') }} - {{ \Carbon\Carbon::now()->format('d-m-Y') }}</h3>
                    </div>

                    <div class="card-body">
                        @include('components.result-filters')
                        <table class="table table-hover text-center">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">NOMBRES Y APELLIDOS</th>
                                <th scope="col">EDAD</th>
                                <th scope="col">OCUPACION</th>
                                <th scope="col">PUNTAJE</th>
                                <th scope="col">MAXIMO PORCENTAJE</th>
                                <th scope="col">PORCENTAJE</th>
                                <th scope="col">DIAGNOSTICO</th>
                                <th scope="col">Fecha</th>
                                <th scope="col">Opciones</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($bournouts as $bournout)
                                <tr>
                                    <td>{{ $bournout->id }}</td>
                                    <td>{{ $bournout->name }}</td>
                                    <td>{{ $bournout->age }}</td>
                                    <td>{{ $bournout->ocupacion }}</td>
                                    <td>{{ $bournout->score }}</td>
                                    <td>100 %</td>
                                    <td>{{ $bournout->percent }} %</td>
                                    <td>{{ $bournout->category }}</td>
                                    <td>{{ $bournout->created_at->format('Y-m-d') }}</td>
                                    <td>
                                        <a href="{{ url('bournout', $bournout) }}" class="btn btn-outline-info">Ver resultados</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $bournouts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
