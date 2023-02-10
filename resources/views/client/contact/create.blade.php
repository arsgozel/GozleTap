@extends('client.layouts.app')
@section('title')
    @lang('app.contact') - @lang('app.app-name')
@endsection
@section('content')
    <div class="container-xl py-4">
        <div class="row justify-content-center">
            <div class="col-10 col-sm-8 col-md-6 col-lg-4">
                <div class="fs-4 fw-semibold text-center mb-3">
                    @lang('app.contact')
                </div>

                <form action="{{ route('contacts.store') }}" method="post">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold">
                            @lang('app.name')
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" required autofocus>
                        @error('name')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label fw-semibold">
                            @lang('app.phone')
                            <span class="text-danger">*</span>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text fw-semibold">+993</span>
                            <input type="number" min="60000000" max="65999999" class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone" required>
                        </div>
                        @error('phone')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">
                            @lang('app.email')
                        </label>
                        <div class="input-group">
                            <span class="input-group-text fw-semibold">@</span>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email">
                        </div>
                        @error('email')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="message" class="form-label fw-semibold">
                            @lang('app.message')
                            <span class="text-danger">*</span>
                        </label>
                        <textarea class="form-control @error('message') is-invalid @enderror" name="message" id="message" rows="3" maxlength="255" required></textarea>
                        @error('message')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-success w-100">
                        <i class="bi-send"></i> @lang('app.send')
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection