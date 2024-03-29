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
            <p>Pre-registros: {{ $count }}</p>
            {{ $weights->render() }}
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Correo</th>
                    <th>Nombre</th>
                    <th>Coef</th>
                    <th>Registrado</th>
                    <th>Confirmado</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
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
                                @else
                                    <td></td>
                                @endif
                            @endif
                            <td>{{ $weight->weight }}</td>
                            @if ($weight->user)
                                <td>{{$weight->user->created_at}}</td>
                                <td>{{$weight->user->email_verified_at}}</td>
                            @else
                                <td></td>
                                <td></td>
                            @endif
                            <td>
                                <a class="btn btn-info btn-sm" href="{{ route('weights.edit', $weight) }}">
                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                </a>
                            </td>
                            <td>
                                <form class="delete" action="{{ route('weights.destroy', $weight) }}" method="POST">
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
        @endif
    </div>
@endsection
