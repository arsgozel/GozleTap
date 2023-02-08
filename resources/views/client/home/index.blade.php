@extends('client.layouts.app')
@section('title')
    @lang('app.app-name')
@endsection
@section('content')
    <div class="container-xl p-0">
        <div class="row gx-5">
            <div class="col-6"><img src="{{ asset('img/main.png') }}" class="mx-0 px-0 text-start"></div>
            <div class="col-6">
                <div class="mt-5 pt-5 display-2 d-flex justify-content-center align-items-center text-center text-danger fw-semibold">@lang('app.app-name')</div>
                <div class="fs-3 d-flex justify-content-center align-items-center text-center">Find Your Dream Job</div>
            </div>
        </div>


    </div>

@endsection