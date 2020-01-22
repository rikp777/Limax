<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" sizes="180x180" href="https://www.limax.nl/icon/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="https://www.limax.nl/icon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="https://www.limax.nl/icon/favicon-16x16.png">
        <title>FlowControl</title>
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Aanvoer') }}</title>



        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
        <link href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons' rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">


    </head>
    <body>
        <div id="app">
            <main-app></main-app>
        </div>
    </body>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</html>
