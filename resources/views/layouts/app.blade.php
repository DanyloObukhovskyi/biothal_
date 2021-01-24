<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet"/>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
    <link href="{{ asset('css/cart.css') }}" rel="stylesheet">
    <link type="module" href="{{ asset('css/cart.css') }}" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    @yield('style')
    <link href="{{ asset('css/all.css') }}" rel="stylesheet">
</head>
<body>
{{--                    <a href="{{route('login')}}">--}}
{{--                        <button class="button_login btn btn-link">Log in</button>--}}
{{--                    </a>--}}
{{--                    <a href="{{route('register')}}">--}}
{{--                        <button class="button_register btn btn-primary">Register</button>--}}
{{--                    </a>--}}
{{--                    <div class="card-body">--}}
{{--                        @if (session('status'))--}}
{{--                            <div class="alert alert-success" role="alert">--}}
{{--                                {{ session('status') }}--}}
{{--                            </div>--}}
{{--                        @endif--}}
{{--                    </div>--}}
{{--                    @if(Auth::user())--}}
{{--                        @if(Auth::user()->type == 'admin')--}}
{{--                            <a href="{{route('admin.dashboard')}}"></a>--}}
{{--                        @endif--}}
{{--                    @endif--}}
<div id="app">
</div>
        @yield('content')

    <!-- Scripts -->
    <script src="{{ asset('js/cart.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>

@yield('script')
</body>
</html>
