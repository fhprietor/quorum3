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
            <p>Registrados: {{ $count }}</p>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Usuario</th>
                    <th>Correo</th>
                    <th>Coeficiente</th>
                    <th>Creado</th>
                    <th>Confirmado</th>
                    <th>Eliminar</th>
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
                            <td>
                                <form class="delete" action="{{ route('users.destroy', $user) }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fa fa-times" aria-hidden="true"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $users->render() }}
        @endif
    </div>
@endsection
