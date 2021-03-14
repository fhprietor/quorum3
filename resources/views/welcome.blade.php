<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Quorum</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 23px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }
        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
<div class="flex-center position-ref full-height">
    @if (Route::has('login'))
        <div class="top-right links">
            @auth
                <a href="{{ url('/home') }}">Inicio</a>
            @else
                <a href="{{ route('login') }}">{{ __('Login') }}</a>

{{--                @if (Route::has('register') && config('larapoll_config.register_enabled'))--}}
                    <a href="{{ route('register') }}">{{ __('Register') }}</a>
{{--                @endif--}}

            @endauth
        </div>
    @endif

    <div class="content">
        <div>
            <img src="logowcuttransparent.png" alt="" style="width:126px;height:130px;">
        </div>
        <div class="title m-b-md">
            Quorum
        </div>
        <div>
            <h1>{{ config('app.sitename', 'default value here') }}</h1>
        </div>
    </div>
</div>
</body>
</html>
