@extends('larapoll::layouts.list')
@section('title')
    Preguntas-Lista
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
        <ol class="breadcrumb">
            <li><a href="{{ route('home') }}">Inicio</a></li>
            <li class="active">Preguntas</li>
        </ol>

        @if(Session::has('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div>
            <a class="btn btn-info btn-sm" href="{{ url('/admin_polls/polls/lists') }}">Actualizar lista</a>
        </div>
        @if($polls->count() >= 1)
            <table class="table table-striped">
                <thead>
                <tr>
{{--                    <th>#</th>--}}
                    <th>Pregunta</th>
                    <th>Opciones</th>
                    <th>Votos</th>
                    <th>Estado</th>
                    <th>Voto</th>
                </tr>
                </thead>
                <tbody>
                @forelse($polls as $poll)
                    @if($poll->isRunning())
                        <tr class="alert alert-danger">
                    @else
                        <tr class="alert alert-light">
                            @endif
{{--                            <th scope="row">{{ $poll->id }}</th>--}}
                            <td>
                                @if($poll->isRunning())
                                    <span class="alert-link">{{ $poll->question }}</span>
                                @else
                                    <span class="text-muted">{{ $poll->question }}</span>
                                @endif
                            </td>
                            <td>{{ $poll->options_count }}</td>
                            <td>{{ $poll->votes_count }}</td>
                            <td>
                                @if($poll->isLocked())
                                    <span class="label label-danger">Cerrada</span>
                                @elseif($poll->isComingSoon())
                                    <span class="label label-info">Pronto</span>
                                @elseif($poll->isRunning())
                                    <span class="label label-success">Abierta</span>
                                @endif
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
        @endif
        {{ $polls->links() }}
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
