@extends('larapoll::layouts.list')
@section('title')
    Preguntas-Votar
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Inicio</div>

                    <div class="card-body">
                        {{ PollWriter::draw($poll->id) }}
                    </div>
                </div>
                <div>
                    <br><a class="btn btn-info btn-sm" href="{{ url('/admin_polls/polls/lists') }}">Volver a votaciones</a>
                </div>
            </div>
        </div>
    </div>
@endsection
