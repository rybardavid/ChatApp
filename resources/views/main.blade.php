<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">


        @if((config('app.name')) !== "")
          <title>{{ config('app.name') }}</title>
        @else
            <title>Error: APP_NAME=NULL</title>
        @endif

        <!-- Fonts
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
        -->
    </head>
    <body>

      <div id="app">
        <app user-prop="{{Auth::user()}}"
             project-route-prop="{{ route('home') }}"
             route-dest-prop="home"
             app-name-prop="{{ ((config('app.name')) !== "") ? config('app.name') : 'Error: APP_NAME=NULL' }}"
             ></app>
      </div>

    </body>
    <script src="js/app.js"></script>
</html>
