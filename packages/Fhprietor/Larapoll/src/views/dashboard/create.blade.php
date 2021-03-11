@extends('larapoll::layouts.app')
@section('title')
Preguntas-Crear
@endsection
@section('style')
<style>
    .errors-list {
        list-style-type: none;
    }

    .clearfix {
        clear: both;
    }

    .create-btn {
        display: block;
        width: 16%;
        float: right;
    }

    .old_options,
    #options,
    .button-add {
        list-style-type: none;
    }

    .add-input {
        width: 80%;
        display: inline-block;
        margin-right: 10px;
        margin-bottom: 10px;
    }
</style>
@endsection
@section('content')
<div class="container">
    <ol class="breadcrumb">
        <li><a href="{{ route('poll.home') }}">Inicio</a></li>
        <li><a href="{{ route('poll.index') }}">Preguntas</a></li>
        <li class="active">Crear Pregunta</li>
    </ol>
    <div class="well col-md-8 col-md-offset-2">
        @if($errors->any())
        <ul class="alert alert-danger errors-list">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        @endif
        @if(Session::has('danger'))
        <div class="alert alert-danger">
            {{ session('danger') }}
        </div>
        @endif
        <form method="POST" action=" {{ route('poll.store') }}">
            {{ csrf_field() }}
            <!-- Question Input -->
            <div class="form-group">
                <label for="question">Pregunta:</label>
                <textarea id="question" name="question" cols="30" rows="2" class="form-control" placeholder="Ej: Quien ha sido el mejor futbolista de Colombia?">{{ old('question') }}</textarea>
            </div>
                <div class="form-group">
                    <label>Número de escaños a repartir (Solo para votaciones de cociente. Dejar en CERO para votaciones normales</label><br>
                    <input type="number" id="seats" name="seats" size="6" value="0" >
                </div>
                <div class="form-group">
                    <label>Quorum presente en el momento de la encuesta</label><br>
                    <input type="number" id="quorum" name="quorum" size="6" value="0" >
                </div>
            <div class="form-group">
                <label>Opciones</label>
                <ul id="options">
                    <li>
                        <input id="option_1" type="text" name="options[0]" class="form-control add-input" value="{{ old('options.0') }}" placeholder="Ej: Pibe Valderrama" />
                    </li>
                    <li>
                        <input id="option_2" type="text" name="options[1]" class="form-control add-input" value="{{ old('options.1') }}" placeholder="Ej: James Rodriguez" />
                    </li>
                </ul>

                <ul>
                    <li class="button-add">
                        <div class="form-group">
                            <a class="btn btn-primary" id="add">
                                <i class="fa fa-plus-circle" aria-hidden="true"></i>
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="form-group clearfix">
                <label>Opciones</label>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="starts_at">Inicia a las: </label>
                        <input type="datetime-local" id="starts_at" name="starts_at" class="form-control" value="{{ old('starts_at') }}" />
                    </div>

                    <div class="form-group col-md-6">
                        <label for="starts_at">Termina a las: </label>
                        <input type="datetime-local" id="ends_at" name="ends_at" class="form-control" value="{{ old('ends_at') }}" />
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>
                    <input type="checkbox" name="canVisitorsVote" value="1" {{ old('canVisitorsVote')  == 1 ? 'checked' : ''  }}> Permitido a los invitados
                </label>
            </div>
            <!-- Create Form Submit -->
            <div class="form-group">
                <input name="create" type="submit" value="Crear" class="btn btn-primary create-btn" />
            </div>
        </form>
    </div>
</div>

@endsection

@section('js')
<script type="text/javascript">
    // re render requested options
    @if(old('options'))
    @foreach(array_slice(old('options'), 2) as $option)
    var e = document.createElement('li');
    e.innerHTML = "<input type='text' name='options[]' value='{{ $option }}' class='form-control add-input' placeholder='Insert your option' /> <a class='btn btn-danger' href='#' onclick='remove(this)'><i class='fa fa-minus-circle' aria-hidden='true'></i></a>";
    document.getElementById("options").appendChild(e);
    @endforeach
    @endif

    function remove(current) {
        current.parentNode.remove()
    }
    document.getElementById("add").onclick = function() {
        var e = document.createElement('li');
        e.innerHTML = "<input type='text' name='options[]' class='form-control add-input' placeholder='Insert your option' /> <a class='btn btn-danger' href='#' onclick='remove(this)'><i class='fa fa-minus-circle' aria-hidden='true'></i></a>";
        document.getElementById("options").appendChild(e);
    }
</script>
@endsection
