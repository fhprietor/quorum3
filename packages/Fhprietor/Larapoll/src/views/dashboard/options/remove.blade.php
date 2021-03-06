@extends('larapoll::layouts.app')
@section('title')
    Preguntas-Eliminar opciones
@endsection

@section('style')
    <style>
        .errors-list{
            list-style-type: none;
        }
    </style>
@endsection
@section('content')
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="{{ route('poll.home') }}">Inicio</a></li>
            <li><a href="{{ route('poll.index') }}">Preguntas</a></li>
            <li class="active">Quitar opciones</li>
        </ol>
        <div class="well col-md-8 col-md-offset-2">
            @if($errors->any())
                <ul class="alert alert-danger errors-list">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
            <form method="POST" action=" {{ route('poll.options.remove', $poll->id) }}">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <!-- Question Input -->
                <div class="form-group">
                    <label>{{ $poll->question }}</label>
                    <div class="radio">
                        @foreach($poll->options as $option)
                            <label>
                                <input type="checkbox" name="options[]" value={{ $option->id }}> {{ $option->name }}
                            </label>
                            <br/>
                        @endforeach
                    </div>
                </div>
                <!-- Create Form Submit -->
                <div class="form-group">
                    <input name="Delete" type="submit" value="Borrar" class="btn btn-danger form-control" >
                </div>
            </form>
        </div>
    </div>
@endsection
