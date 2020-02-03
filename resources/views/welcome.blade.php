<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="google" content="notranslate">
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
        <link href="{{ mix('css/app.css') }}" rel="stylesheet">
        <style>
            .loading {
                display: inline-block;
                width: 30px;
                height: 30px;
                border: 2px solid rgba(0,0,0,.2 );
                border-radius: 50%;
                border-top-color: rgba(0,0,0,.4 );
                animation: spin 1s ease-in-out infinite;
                -webkit-animation: spin 1s ease-in-out infinite;
                left: calc(50%);
                top: calc(50%);
                position: fixed;
                z-index: 1;
            }

            @keyframes spin {
                to { -webkit-transform: rotate(360deg); }
            }
            @-webkit-keyframes spin {
                to { -webkit-transform: rotate(360deg); }
            }
        </style>
    </head>
    <body>
        <noscript>
            You need to enable JavaScript to run this app.
        </noscript>
        <div id="app" class="notranslate">
            <div class="loading"></div>
        </div>
    </body>

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}"></script>
</html>
