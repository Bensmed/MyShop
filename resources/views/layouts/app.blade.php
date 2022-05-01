<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Se Connecter') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @yield('styles')
</head>

<body>
    <div id="app">
        <main class="py-5">
            @yield('content')
        </main>
    </div>


    <!--====== jquery js ======-->
    <script src="{{ URL::asset('assets/js/vendor/modernizr-3.6.0.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/vendor/jquery-1.12.4.min.js') }}"></script>

    @yield('scripts')
</body>

</html>
