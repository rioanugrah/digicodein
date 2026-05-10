<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link href="{{ asset('/') }}assets/css/vendor.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/') }}assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-style" />
    <link href="{{ asset('/') }}assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <script src="{{ asset('/') }}assets/js/config.js"></script>
    @yield('css')
</head>
<body>
    @yield('content')

    <script src="{{ asset('/') }}assets/js/vendor.min.js"></script>
    <script src="{{ asset('/') }}assets/js/app.js"></script>
    @yield('js')

</body>
</html>
