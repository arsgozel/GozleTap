@extends('client.layouts.app')
@section('title')
    @lang('app.app-name')
@endsection
@section('content')
    <div class="container-xl p-0">
        <div class="row align-items-center">
            <div class="col-sm">
                <div class="display-1 text-center text-danger fw-semibold">@lang('app.app-name')</div>
                <div class="fs-3 text-center">Find Your Dream Job</div>
            </div>
            <div class="col-sm"><img src="{{ asset('img/job_search2.png') }}" class="img-fluid py-2"></div>
        </div>
    </div>

@endsection