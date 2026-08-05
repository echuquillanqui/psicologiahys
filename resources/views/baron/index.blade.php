@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-center">
                        <h3>{{ __('LISTADO DE RESULTADOS BARON') }} - {{ \Carbon\Carbon::now()->format('d-m-Y') }}</h3>
                    </div>

                    <div class="card-body">
                        @include('components.result-filters')
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">NOMBRES Y APELLIDOS</th>
                                    <th scope="col">EDAD</th>
                                    <th scope="col">OCUPACION</th>
                                    <th scope="col">FECHA</th>
                                    <th scope="col">Opciones</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($barons as $baron)
                                    <tr>
                                        <td>{{ $baron->id }}</td>
                                        <td>{{ $baron->name }}</td>
                                        <td>{{ $baron->age }}</td>
                                        <td>{{ $baron->ocupation }}</td>
                                        <td>{{ $baron->created_at->format('d-m-Y') }}</td>
                                        <td>
                                            <a href="{{ url('baron', $baron) }}" class="btn btn-outline-info">Ver resultados</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $barons->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
