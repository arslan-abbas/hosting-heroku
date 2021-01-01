<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <toolbar fixed color="white">
            <toolbar-side-icon></toolbar-side-icon>
            <toolbar-title> LChat</toolbar-title>
            <spacer></spacer>
            <toolbar-items class="hidden-sm-and-down">
                    @guest
                        <button href="{{ route('login') }}">Login </button>
                        <button href="{{ route('register') }}">Register </button>
                    @else
                        <button href="{{route('home')}}">Group </button>
                        <button href="{{route('private')}}">Private </button>
                        <button >{{ Auth::user()->name }} </button>
                        <button href="{{route('private')}}">Private </button>
                        <btn flat> </btn>
                        <btn flat
                        @click=" $refs.logoutForm.submit(); ">
                        Logout</btn>
                    @endguest
                    <form ref="logoutForm" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
            </toolbar-items>
        </toolbar>

        <main class="mt-5">
            <container fluid>
                @yield('content')
            </container>
        </main>
    </div>
</body>
</html>
