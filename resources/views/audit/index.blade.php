@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-center">
                        <h3>{{ __('CUESTIONARIO AUDIT') }} - {{ \Carbon\Carbon::now()->format('d-m-Y') }}</h3>
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
                            @foreach($audits as $audit)
                                <tr>
                                    <td>{{ $audit->id }}</td>
                                    <td>{{ $audit->name }}</td>
                                    <td>{{ $audit->ocupation }}</td>
                                    <td>{{ $audit->score }}</td>
                                    <td>{{ $audit->dx }}</td>
                                    <td>{{ $audit->created_at->format('Y-m-d') }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $audits->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
