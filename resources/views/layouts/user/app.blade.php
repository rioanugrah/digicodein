<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-layout="topnav">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta content="-" name="description" />
    <meta content="-" name="author" />
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <link rel="icon" type="image/x-icon" href="{{ asset('logo/favicon.jpg') }}">
    <title>@yield('title')</title>
    <link href="{{ asset('/') }}assets/css/vendor.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/') }}assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-style" />
    <link href="{{ asset('/') }}assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <script src="{{ asset('/') }}assets/js/config.js"></script>
    <style>
        :root {
            --white-gradient: linear-gradient(135deg, #ffffff 0%, #ffffff 100%);
            --primary-gradient: linear-gradient(135deg, #2845D6 0%, #1A2CA3 100%);
            --success-gradient: linear-gradient(135deg, #6FCF97 0%, #2FA084 100%);
            --danger-gradient: linear-gradient(135deg, #FF8383 0%, #AE2448 100%);
            --warning-gradient: linear-gradient(135deg, #f6d365 0%, #fda085 100%);
            --purple-gradient: linear-gradient(135deg, #E491C9 0%, #982598 100%);
            --glass-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
            --soft-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            --deep-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);

            --primary-new-gradient: linear-gradient(135deg, #0B5FEF 0%, #0B5FEF 100%);
        }

        .btn-white {
            background-image: var(--white-gradient);
            box-shadow: 0 10px 20px -10px #0000005d;
            color: black;
            font-weight: bold;
        }
        .btn-white:active {
            transform: translateY(2px);
            box-shadow: var(--deep-shadow);
        }
        .btn-white:hover {
            color: #0B5FEF;
        }

        .btn-primary-new {
            background-image: var(--primary-new-gradient);
            box-shadow: 0 10px 20px -10px #0B5FEF;
            color: white;
            font-weight: bold;
        }
        .btn-primary-new:active {
            transform: translateY(2px);
            box-shadow: var(--deep-shadow);
        }
        .btn-primary-new:hover {
            color: #ffffff;
        }
        .bg-primary-new {
            background-image: var(--primary-new-gradient);
            box-shadow: 0 10px 20px -10px #0B5FEF;
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
            box-shadow: 0 4px 10px #6FCF97;
            padding-left: 10%;
            padding-right: 10%;
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
            box-shadow: 0 4px 10px #fda085;
            padding-left: 10%;
            padding-right: 10%;
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
        .badge-red {
            background-image: var(--danger-gradient);
            box-shadow: 0 4px 10px #f5576c;;
        }

        .color-line_new {
            height: 5px;
            background: #f7f9fa;
            background-image: var(--primary-new-gradient);
            background-size: 100% 6px;
            background-position: 50% 100%;
            background-repeat: no-repeat;
            position: sticky;
            top: 0;
            z-index: 1100;
            left: 0;
            right: 0;
        }

        .footer-v3 {
            background: linear-gradient(135deg, #4f46e5 0%, #3A8B95 100%);
            color: rgba(255, 255, 255, 0.8);
            position: relative;
        }

        .footer-v3 h5,
        .footer-v3 .text-white {
            color: #ffffff !important;
            font-weight: 600;
        }

        .footer-v3 .footer-link {
            color: rgba(255, 255, 255, 0.8);
        }

        .footer-v3 .footer-link:hover {
            color: #ffffff;
            text-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
        }

        .footer-v3 .social-icon {
            background-color: rgba(255, 255, 255, 0.1);
            color: #ffffff;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .footer-v3 .social-icon:hover {
            background-color: #ffffff;
            color: #7c3aed;
        }

        /* Wave SVG style */
        .custom-shape-divider-top {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            overflow: hidden;
            line-height: 0;
            transform: translateY(-99%);
        }

        .custom-shape-divider-top svg {
            position: relative;
            display: block;
            width: calc(100% + 1.3px);
            height: 50px;
        }

        .custom-shape-divider-top .shape-fill {
            fill: #4f46e5;
        }

        /* --- Product Grid Styles (Based on Image) --- */
        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .section-title-blue {
            color: #0B5FEF;
            font-weight: 800;
            text-transform: uppercase;
            font-size: 1.25rem;
        }

        .view-all-link {
            text-decoration: none;
            color: #0d6efd;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .product-card {
            border: none;
            border-radius: 12px;
            overflow: hidden;
            background: #fff;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            height: 100%;
            position: relative;
        }

        .product-img-container {
            height: 180px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #fff;
            padding: 15px;
        }

        .product-img-container img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .price-badge {
            position: absolute;
            top: 15px;
            right: -5px;
            background-color: #0B5FEF;
            /* Hijau seperti di gambar */
            color: white;
            padding: 4px 12px;
            border-radius: 6px 0 0 6px;
            font-size: 0.75rem;
            font-weight: 600;
            z-index: 10;
            box-shadow: -2px 2px 5px rgba(0, 0, 0, 0.1);
        }

        .price-old {
            text-decoration: line-through;
            opacity: 0.8;
            margin-right: 5px;
            font-weight: normal;
        }

        .product-footer-blue {
            background-color: #0B5FEF;
            /* Biru seperti di gambar */
            color: white;
            padding: 12px 10px;
            text-align: center;
            font-size: 0.85rem;
            font-weight: 500;
            text-transform: uppercase;
        }
    </style>
    <style>
        /* Custom styles to mimic Tailwind's look */
        .footer-link {
            text-decoration: none;
            color: #64748b; /* Tailwind slate-500 */
            transition: color 0.2s ease-in-out;
            font-size: 0.95rem;
        }

        .footer-link:hover {
            color: #0f172a; /* Tailwind slate-900 */
        }

        .footer-title {
            font-weight: 600;
            color: #1e293b; /* Tailwind slate-800 */
            text-transform: uppercase;
            letter-spacing: 0.05em;
            font-size: 0.85rem;
            margin-bottom: 1.25rem;
        }

        .social-icon {
            width: 36px;
            height: 36px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            background-color: #f1f5f9;
            color: #475569;
            transition: all 0.2s ease;
        }

        .social-icon:hover {
            background-color: #e2e8f0;
            color: #0f172a;
            transform: translateY(-2px);
        }

        footer {
            background-color: #ffffff;
            border-top: 1px solid #e2e8f0;
        }

        .newsletter-input {
            border: 1px solid #e2e8f0;
            padding: 0.6rem 1rem;
            border-radius: 8px;
        }

        .newsletter-input:focus {
            border-color: #94a3b8;
            box-shadow: none;
        }

        .btn-subscribe {
            background-color: #0f172a;
            color: white;
            border-radius: 8px;
            padding: 0.6rem 1.25rem;
            font-weight: 500;
        }

        .btn-subscribe:hover {
            background-color: #1e293b;
            color: white;
        }
    </style>
    @yield('css')
</head>

<body>
    <div class="wrapper">
        {{-- @include('layouts.frontend.topbar')
        @include('layouts.frontend.menu') --}}
        @include('layouts.user.topbar')
        @include('layouts.user.menu')

        <div class="page-content">
            <div class="page-container">
                @yield('content')
            </div>
            {{-- @include('layouts.admin.footer') --}}
            @include('layouts.frontend.footer')
        </div>
    </div>

    <script src="{{ asset('/') }}assets/js/vendor.min.js"></script>
    <script src="{{ asset('/') }}assets/js/app.js"></script>
    @yield('js')
</body>

</html>
