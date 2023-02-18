@extends('client.layouts.app')
@section('title')
    @lang('app.app-name')
@endsection
@section('content')
    <div class="container-xl p-0">
        <div class="row align-items-center">
            <div class="col-sm">
                <div class="display-1 text-center text-danger fw-bold">@lang('app.app-name')</div>
                <div class="fs-3 text-center mb-3">Find Your <span class="text-success">Dream Job</span></div>
                <div class="d-flex align-items-center justify-content-center mb-3">
                    <form action="{{ route('jobs.index') }}" class="px-2 w-50" role="search">
                        <input class="form-control rounded-5 border-success" type="search" name="q" value="{{ isset($q) ? $q : old('q') }}" placeholder="@lang('app.search')..." aria-label="Search">
                    </form>
                </div>
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
                    @include('client.app.job')
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