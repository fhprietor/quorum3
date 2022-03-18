@extends('larapoll::layouts.list')
@section('title')
    PreRegistro-Crear
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
            <li class="active">Crear Pre-Registro</li>
        </ol>
        <div class="well col-md-8 col-md-offset-2">
            <form method="POST" action=" {{ route('weights.store') }}">
                @csrf
                @include('weights.partials.form')

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Crear') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
