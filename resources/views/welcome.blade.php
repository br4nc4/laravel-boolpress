<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel-api</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">


        <link rel="stylesheet" href="{{asset('css/frontend.css')}}">
        
    </head>
    <body>
        <div id="app">
            {{-- il contenuto viene sostituito da vue.js --}}
        </div>

        <script src=" {{asset("js/frontend.js")}} "></script>
    </body>
</html>
