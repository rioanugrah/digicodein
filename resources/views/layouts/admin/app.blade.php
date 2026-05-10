<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/x-icon" href="{{ asset('logo/favicon.jpg') }}">
    <title>@yield('title')</title>
    <link href="{{ asset('/') }}assets/css/vendor.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/') }}assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-style" />
    <link href="{{ asset('/') }}assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <script src="{{ asset('/') }}assets/js/config.js"></script>
    <link href="{{ asset('/') }}assets/vendor/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #2845D6 0%, #1A2CA3 100%);
            --success-gradient: linear-gradient(135deg, #6FCF97 0%, #2FA084 100%);
            --danger-gradient: linear-gradient(135deg, #FF8383 0%, #AE2448 100%);
            --warning-gradient: linear-gradient(135deg, #f6d365 0%, #fda085 100%);
            --purple-gradient: linear-gradient(135deg, #E491C9 0%, #982598 100%);
            --glass-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
            --soft-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            --deep-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        /* blue */
        .btn-blue {
            background-image: var(--primary-gradient);
            box-shadow: 0 10px 20px -10px #667eea;
            color: white;
        }
        .btn-blue:active {
            transform: translateY(2px);
            box-shadow: var(--deep-shadow);
        }
        .btn-blue:hover {
            color: white;
        }
        .badge-blue {
            background-image: var(--primary-gradient);
            box-shadow: 0 4px 10px #667eea;;
        }

        /* purple */
        .btn-purple {
            background-image: var(--purple-gradient);
            box-shadow: 0 10px 20px -10px #982598;
            color: white;
        }
        .btn-purple:active {
            transform: translateY(2px);
            box-shadow: var(--deep-shadow);
        }
        .btn-purple:hover {
            color: white;
        }
        .badge-purple {
            background-image: var(--purple-gradient);
            box-shadow: 0 4px 10px #667eea;;
        }

        /* green */
        .btn-green {
            background-image: var(--success-gradient);
            box-shadow: 0 10px 20px -10px #6FCF97;
            color: white;
        }
        .btn-green:active {
            transform: translateY(2px);
            box-shadow: var(--deep-shadow);
        }
        .btn-green:hover {
            color: white;
        }
        .badge-green {
            background-image: var(--success-gradient);
            box-shadow: 0 4px 10px #6FCF97;;
        }

        /* yellow */
        .btn-yellow {
            background-image: var(--warning-gradient);
            box-shadow: 0 10px 20px -10px #fda085;
            color: white;
        }
        .btn-yellow:active {
            transform: translateY(2px);
            box-shadow: var(--deep-shadow);
        }
        .btn-yellow:hover {
            color: white;
        }
        .badge-yellow {
            background-image: var(--warning-gradient);
            box-shadow: 0 4px 10px #fda085;;
        }

        /* red */
        .btn-red {
            background-image: var(--danger-gradient);
            box-shadow: 0 10px 20px -10px #f5576c;
            color: white;
        }
        .btn-red:active {
            transform: translateY(2px);
            box-shadow: 0 5px 10px -5px #f5576c;
        }
        .btn-red:hover {
            color: white;
        }
    </style>
    @yield('css')
</head>

<body>
    <div class="wrapper">
        @include('layouts.admin.topbar')
        @include('layouts.admin.sidebar')

        <div class="page-content">
            <div class="page-container">
                @yield('content')
            </div>
            @include('layouts.admin.footer')
        </div>
    </div>

    <script src="{{ asset('/') }}assets/js/vendor.min.js"></script>
    <script src="{{ asset('/') }}assets/js/app.js"></script>
    <script src="{{ asset('/') }}assets/vendor/sweetalert2/sweetalert2.min.js"></script>
    @yield('js')
</body>

</html>
