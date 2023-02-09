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
            <div class="col-sm"><img src="{{ asset('img/job_search2.png') }}" class="img-fluid"></div>
        </div>


        <div class="h5 text-danger border-bottom pb-2 mb-3">
            <i class="bi bi-award-fill text-success"></i> New Jobs
        </div>
        <div class="row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-xl-2 g-3 mb-4">
            @foreach($newJobs as $job)
                <div class="col">
                    @include('client.app.job')
                </div>
            @endforeach
        </div>
        <div class="h5 text-danger border-bottom pb-2 mb-3">
            <i class="bi bi-award-fill text-success"></i> Top Viewed Jobs
        </div>
        <div class="row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-xl-2 g-3 mb-4">
            @foreach($topViewed as $job)
                <div class="col">
                    @include('admin.app.job')
                </div>
            @endforeach
        </div>

        <div class="h5 text-danger border-bottom pb-2 mb-3">
            <i class="bi bi-award-fill text-success"></i> Most Favoured Jobs
        </div>
        <div class="row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-xl-2 g-3 mb-4">
            @foreach($mostFavorites as $job)
                <div class="col">
                    @include('client.app.job')
                </div>
            @endforeach
        </div>
    </div>

@endsection