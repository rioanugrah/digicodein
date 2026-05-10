{{-- @extends('layouts.app') --}}
@extends('layouts.auth')
@section('title', 'Reset Password')

@section('css')
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
    </style>
@endsection

@section('content')
    {{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
    <div class="auth-bg d-flex min-vh-100 justify-content-center align-items-center">
        <div class="row g-0 justify-content-center w-100 m-xxl-5 px-xxl-4 m-3">
            <div class="col-xl-4 col-lg-5 col-md-6">
                <div class="card overflow-hidden text-center h-100 p-xxl-4 p-3 mb-0">
                    <a href="{{ route('login') }}" class="auth-brand mb-4">
                        <img src="{{ asset('/') }}logo/LogoDigiCodein.png" height="50" class="logo-dark">
                        <img src="{{ asset('/') }}logo/LogoDigiCodein.png" height="50" class="logo-light">
                    </a>

                    <h4 class="fw-semibold mb-2 fs-18">{{ __('Reset Password') }}</h4>

                    <form method="POST" action="{{ route('password.update') }}" class="text-start mb-3">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="mb-3">
                            <label class="form-label" for="email">Email</label>
                            <input type="email" id="email" name="email"
                                class="form-control @error('email') is-invalid @enderror" placeholder="Masukkan Email"
                                value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="password">Password</label>
                            <input type="password" id="password" name="password"
                                class="form-control @error('password') is-invalid @enderror" placeholder="Masukkan Password"
                                required autocomplete="current-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="password-confirm">Konfirmasi Password</label>
                            <input type="password" id="password-confirm" name="password_confirmation" class="form-control"
                                placeholder="Masukkan Konfirmasi Password" required autocomplete="new-password">
                        </div>

                        <div class="d-grid">
                            <button class="btn btn-primary-new fw-semibold" type="submit">Submit</button>
                        </div>
                    </form>

                    <p class="mt-auto mb-0">
                        <script>
                            document.write(new Date().getFullYear())
                        </script> © {{ env('APP_NAME') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
