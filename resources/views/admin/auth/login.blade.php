<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@lang('app.login') - @lang('app.app-name')</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-icons.css') }}">
</head>
<body style="background-color: #007863">
@include('admin.layouts.alert')
<div class="container-fluid">
    <div class="row justify-content-center align-items-center vh-100 py-3">
        <div class="col-10 col-sm-6 col-md-4 col-lg-3 col-xxl-2">
            <i class="bi bi-box-arrow-in-right display-6 text-warning d-flex justify-content-center py-2"></i>
            <div class="bg-light rounded p-4">
                <form action="{{ route('admin.login') }}" method="post">
                    @csrf
                    @honeypot

                    <div class="mb-3">
                        <label for="username" class="form-label fw-semibold">
                            @lang('app.username')
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" id="username" value="{{ old('username') }}" required autofocus>
                        @error('username')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label fw-semibold">
                            @lang('app.password')
                            <span class="text-danger">*</span>
                        </label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" value="{{ old('password') }}" required>
                        @error('password')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" value="1" name="remember" id="remember">
                        <label class="form-check-label" for="remember">
                            @lang('app.rememberMe')
                        </label>
                    </div>

                    <button type="submit" class="btn btn-dark w-100">
                        @lang('app.login')
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>