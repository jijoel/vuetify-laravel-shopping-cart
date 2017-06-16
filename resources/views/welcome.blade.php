<!doctype html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{mix('css/app.css')}}">

  </head>
  <body>
    <div id="app">
      <shop></shop>
    </div>

    <script type="text/javascript" src="{{mix('js/app.js')}}"></script>
  </body>
</html>
