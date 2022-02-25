@extends('larapoll::layouts.list')
@section('title')
    Pre-Registro
@endsection
@section('style')
    <style>
        .table td,
        .table th {
            text-align: center;
        }
    </style>
@endsection
@section('content')
    <div class="container">
        @if(Auth::user()->role == "MODERATOR")
            <br>
            <a href="{{ route('weights/create') }}" class="btn btn-success pull-right create-btn">Crear Pre-registro</a>
            <br>
            <p>Usuarios pre-registrados: {{ $weights->count() }}</p>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Correo</th>
                    <th>Nombre</th>
                    <th>Registrado</th>
                    <th>Confirmado</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($weights as $weight)
                        <tr>
                            <td>{{$weight->email}}</td>
                            @if ($weight->name)
                                <td>{{$weight->name}}</td>
                            @else
                                @if ($weight->user)
                                    <td>{{$weight->user->name}}</td>
                                @endif
                            @endif
                            @if ($weight->user)
                            <td>{{$weight->user->created_at}}</td>
                            <td>{{$weight->user->email_verified_at}}</td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
