@extends('admin.layouts.app')
@section('title')
    @lang('app.dashboard')
@endsection
@section('content')
    <div class="row g-3 mb-4">
        @foreach($modals as $modal)
            <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                <a href="{{ route('admin.' . $modal['name'] . '.index') }}" class="text-decoration-none text-dark">
                    <div class="border bg-light rounded p-3">
                        <div class="fs-5">
                            @lang('app.' . $modal['name'])
                        </div>
                        <div class="fs-3 fw-semibold text-end">
                            <i class="bi bi-box-arrow-in-up-right text-warning fs-5"></i> {{ $modal['total'] }}
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>

    <div class="h5 text-danger border-bottom pb-2 mb-3">
        <i class="bi bi-award-fill text-success"></i> Top Viewed Jobs
    </div>
    <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-xl-5 g-3 mb-4">
        @foreach($topViewed as $job)
            <div class="col">
                @include('admin.app.job')
            </div>
        @endforeach
    </div>

    <div class="h5 text-danger border-bottom pb-2 mb-3">
        <i class="bi bi-award-fill text-success"></i> Most Favoured Jobs
    </div>
    <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-xl-5 g-3 mb-4">
        @foreach($mostFavorites as $job)
            <div class="col">
                @include('admin.app.job')
            </div>
        @endforeach
    </div>

    <div class="h5 text-danger border-bottom pb-2 mb-3">
        <i class="bi bi-award-fill text-success"></i> New Jobs
    </div>
    <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-xl-5 g-3 mb-4">
        @foreach($newJobs as $job)
            <div class="col">
                @include('admin.app.job')
            </div>
        @endforeach
    </div>
@endsection