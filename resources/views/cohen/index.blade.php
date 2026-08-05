@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-center">
                        <h3>{{ __('CUESTIONARIO DE ACROFOBIA (COHEN)') }} - {{ \Carbon\Carbon::now()->format('d-m-Y') }}</h3>
                    </div>

                    <div class="card-body">
                        @include('components.result-filters')
                        <table class="table table-hover text-center">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">NOMBRES Y APELLIDOS</th>
                                <th scope="col">OCUPACION</th>
                                <th scope="col">PUNTAJE</th>
                                <th scope="col">DIAGNOSTICO</th>
                                <th scope="col">Fecha</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($cohens as $cohen)
                                <tr>
                                    <td>{{ $cohen->id }}</td>
                                    <td>{{ $cohen->name }}</td>
                                    <td>{{ $cohen->ocupation }}</td>
                                    <td>{{ $cohen->score }}</td>
                                    <td>{{ $cohen->dx }}</td>
                                    <td>{{ $cohen->created_at->format('Y-m-d') }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $cohens->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
