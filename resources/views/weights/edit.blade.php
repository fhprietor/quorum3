@extends('larapoll::layouts.list')
@section('title')
    PreRegistro-Editar
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
            <li><a href="{{ route('home') }}">Inicio</a></li>
            <li><a href="{{ route('weights.index') }}">Pre-Registro</a></li>
            <li class="active">Editar Pre-Registro</li>
        </ol>
        <div class="well col-md-8 col-md-offset-2">
            <form method="POST" action=" {{ route('weights.update', $weight) }}">
                @csrf
                @method('put')
                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $weight->name }}" required autocomplete="name" autofocus placeholder="Nombre completo">

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $weight->email }}" required autocomplete="email">

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="weight" class="col-md-4 col-form-label text-md-right">{{ __('Coefficient') }}</label>

                    <div class="col-md-6">
                        <input id="weight" type="text" class="form-control @error('weight') is-invalid @enderror" name="weight" value="{{ $weight->weight }}" required autocomplete="weight">

                        @error('weight')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Actualizar') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
