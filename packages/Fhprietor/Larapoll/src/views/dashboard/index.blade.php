@extends('larapoll::layouts.app')
@section('title')
Preguntas-Listado
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
    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}">Inicio</a></li>
        <li class="active">Preguntas</li>
    </ol>

    @if(Session::has('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    @if($polls->count() >= 1)
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Pregunta</th>
                <th>Opciones</th>
                <th>Visitantes permitidos</th>
                <th>Votos</th>
                <th>Estado</th>
                <th>Visible</th>
                <th>Editar</th>
                <th>Agregar Opciones</th>
                <th>Quitar Opciones</th>
                <th>Eliminar</th>
                <th>Bloquear / Desbloquear</th>
                <th>Ver resultados</th>
                <th>Mostrar pregunta</th>
            </tr>
        </thead>
        <tbody>
            @forelse($polls as $poll)
            <tr>
                <th scope="row">{{ $poll->id }}</th>
                <td>{{ $poll->question }}</td>
                <td>{{ $poll->options_count }}</td>
                <td>{{ $poll->canVisitorsVote ? 'Yes' : 'No' }}</td>
                <td>{{ $poll->votes_count }}</td>
                <td>
                    @if($poll->isLocked())
                    <span class="label label-danger">Cerrada</span>
                    @elseif($poll->isComingSoon())
                    <span class="label label-info">Pronto</span>
                    @elseif($poll->isRunning())
                    <span class="label label-success">Iniciada</span>
                    @endif
                </td>
                <td>
                    @if($poll->visible)
                        <span class="label label-success">Si</span>
                    @else
                        <span class="label label-danger">No</span>
                    @endif
                </td>
                <td>
                    <a class="btn btn-info btn-sm" href="{{ route('poll.edit', $poll->id) }}">
                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                    </a>
                </td>
                <td>
                    <a class="btn btn-success btn-sm" href="{{ route('poll.options.push', $poll->id) }}">
                        <i class="fa fa-plus-circle" aria-hidden="true"></i>
                    </a>
                </td>
                <td>
                    <a class="btn btn-warning btn-sm" href="{{ route('poll.options.remove', $poll->id) }}">
                        <i class="fa fa-minus-circle" aria-hidden="true"></i>
                    </a>
                </td>
                <td>
                    <form class="delete" action="{{ route('poll.remove', $poll->id) }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="fa fa-times" aria-hidden="true"></i>
                        </button>
                    </form>
                </td>
                <td>
                    @php $route = $poll->isLocked()? 'poll.unlock': 'poll.lock' @endphp
                    @php $fa = $poll->isLocked()? 'fa fa-unlock': 'fa fa-lock' @endphp
                    <form class="lock" action="{{ route($route, $poll->id) }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                        <button type="submit" class="btn btn-sm">
                            <i class="{{ $fa }}" aria-hidden="true"></i>
                        </button>
                    </form>
                </td>
                <td>
                    <a class="btn btn-info btn-sm" href="{{ route('poll.view', $poll->id) }}">
                        <i class="fa fa-eye" aria-hidden="true"></i>
                    </a>
                </td>
                <td>
                    <a class="btn btn-info btn-sm" href="{{ route('poll.votar', $poll->id) }}">
                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <smal>No se han encontrado preguntas. Cree una <a href="{{ route('poll.create') }}">Ahora</a></smal>
    @endif
    {{ $polls->links() }}
    @endif
</div>
@endsection

@section('js')
<script>
    // Delete Confirmation
    $(".delete").on("submit", function() {
        return confirm("Borrar la pregunta?");
    });

    // Lock Confirmation
    $(".lock").on("submit", function() {
        return confirm("Bloquear/desbloquear la pregunta?");
    });
</script>
@endsection
