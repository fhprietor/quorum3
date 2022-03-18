@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Home') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                    </div>

                    <div class="align-content-md-center links">
                        @if(Auth::user()->role == "MODERATOR")
                        <div>
                            <a class="btn btn-info btn-sm" href="{{ url('/admin_polls/admin/polls') }}">{{ __('Moderator') }}</a>
                        </div>
                        <br>
                            <div>
                                <a class="btn btn-info btn-sm" href="{{ url('/weights') }}">{{ __('Pre-Registered Users') }}</a>
                            </div>
                            <br>
                        <div>
                            <a class="btn btn-info btn-sm" href="{{ url('/users') }}">{{ __('Registered Users') }}</a>
                        </div>
                        <br>
                        @endif
                        <div>
                            <a class="btn btn-info btn-sm" href="{{ url('/admin_polls/polls/lists') }}">{{ __('Poll list') }}</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
