@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-center">
                        <h3>{{ __('LISTADO DE RESULTADOS EYSENCK') }} - {{ \Carbon\Carbon::now()->format('d-m-Y') }}</h3>
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
                                <th scope="col">TOTAL E</th>
                                <th scope="col">TOTAL N</th>
                                <th scope="col">TOTAL L</th>
                                <th scope="col">DIAGNOSTICO</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($eysencks as $eysenck)
                                <tr>
                                    <td>{{ $eysenck->id }}</td>
                                    <td>{{ $eysenck->name }}</td>
                                    <td>{{ $eysenck->age }}</td>
                                    <td>{{ $eysenck->ocupation }}</td>
                                    <td>{{ $eysenck->suma_e }}</td>
                                    <td>{{ $eysenck->suma_n }}</td>
                                    <td>{{ $eysenck->suma_l }}</td>
                                    <td>{{ $eysenck->dx }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $eysencks->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
