@extends('client.layouts.app')
@section('title')
    @lang('app.jobs')
@endsection
@section('content')
    <div class="container-xl py-4">
        <div class="row g-4 mb-4">
            <div class="col-10 col-sm-8 col-md-6 col-lg-4">
                <div class="d-flex mb-2">
                    <img src="{{  $job->image ? Storage::url('jobs/' . $job->image) : asset('img/job.jpg') }}"
                         alt="{{ $job->getFullName() }}" class="img-fluid border rounded">
                </div>
                <div>
                    <i class="bi bi-eye-fill text-dark"></i>{{ $job->viewed }}
                </div>
                <div>
                    <i class="bi bi-calendar-event-fill text-success"></i> {{ $job->created_at }}
                </div>
                <div>
                    <i class="bi bi-calendar-event-fill text-danger"></i> {{ $job->updated_at }}
                </div>
            </div>
            <div class="col">
                <div class="mb-2">
                    <span class="fs-4 fw-semibold">{{ $job->getFullName() }}</span>
                    <a href="{{route('jobs.job.favorite', $job->slug)}}" class="btn btn-danger btn-sm text-decoration-none rounded-5">
                        <i class="bi bi-bookmark-heart"></i> {{ $job->favorites }}
                    </a>
                </div>
                <div class="mb-2">
                    <a href="{{ $job->category->slug }}" class="link-secondary text-decoration-none fw-semibold">
                        {{ $job->category->getName() }}
                    </a>
                </div>
                <div>
                    <a href="{{ $job->location->slug }}" class="link-dark text-decoration-none fw-semibold">
                        <span class="fw-semibold">@lang('app.location'): </span>{{ $job->location->getName() }}
                    </a>
                </div>
                <div class="fs-6">
                    <span class="fw-semibold">@lang('app.phone'):</span> +993{{ $job->phone }}
                </div>

                <div class="fs-6">
                    <span class="fw-semibold">@lang('app.email'): </span>{{ $job->email }}
                </div>
                <div class="fs-6">
                    <span class="fw-semibold">@lang('app.salary'): </span> {{ number_format($job->salary) }}
                    <small>TMT</small>
                </div>
                <div class="fs-6">
                    <span class="fw-semibold">@lang('app.gender'): </span>{{ $job->gender->getName() }}
                </div>
                <div class="fs-6">
                    <span class="fw-semibold">@lang('app.experience'): </span>{{ $job->experience->getName() }}
                </div>
                <div class="fs-6">
                    <span class="fw-semibold">@lang('app.education'): </span>{{ $job->education->getName() }}
                </div>
                <div class="fs-6">
                    <span class="fw-semibold">@lang('app.work_time'): </span>{{ $job->work_time->getName() }}
                </div>
            </div>
            <div>
                <div class="col-8">
                    <div class="fw-semibold fs-5">@lang('app.description')</div>
                    <div class="mb-2 pt-3">
                        {{ $job->description }}
                    </div>
                </div>
            </div>
        </div>
        @if($jobs->count() > 0)
            @include('client.job.jobs')
        @endif
    </div>
@endsection