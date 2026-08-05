@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-center">
                        <h3>{{ __('LISTADO DE RESULTADOS CLAUSTROFOBIO CLQ') }} - {{ \Carbon\Carbon::now()->format('d-m-Y') }}</h3>
                    </div>

                    <div class="card-body">
                        @include('components.result-filters')
                        <table class="table table-hover text-center">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">NOMBRES Y APELLIDOS</th>
                                <th scope="col">EMPRESA</th>
                                <th scope="col">OCUPACION</th>
                                <th scope="col">PUNTAJE</th>
                                <th scope="col">DIAGNOSTICO</th>
                                <th scope="col">Fecha</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($claustrofobies as $clq)
                                <tr>
                                    <td>{{ $clq->id }}</td>
                                    <td>{{ $clq->name }}</td>
                                    <td>{{ $clq->company }}</td>
                                    <td>{{ $clq->ocupation }}</td>
                                    <td>{{ $clq->score }}</td>
                                    <td>{{ $clq->dx }}</td>
                                    <td>{{ $clq->created_at->format('Y-m-d') }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $claustrofobies->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
