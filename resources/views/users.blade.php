@extends('larapoll::layouts.list')
@section('title')
    Usuarios registrados
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
            <p>Usuarios registrados: {{ $users->count() }}</p>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Usuario</th>
                    <th>Correo</th>
                    <th>Coeficiente</th>
                    <th>Creado</th>
                    <th>Confirmado</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->weight/1000}}</td>
                            <td>{{$user->created_at}}</td>
                            <td>{{$user->email_verified_at}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
