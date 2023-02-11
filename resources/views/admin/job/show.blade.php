@extends('admin.layouts.app')
@section('title')
    @lang('app.jobs')
@endsection
@section('content')
    <div class="h4 mb-3">
        <a href="{{ route('admin.jobs.index') }}" class="text-decoration-none">
            @lang('app.jobs')
        </a>
        <i class="bi-chevron-right small"></i>
        @lang('app.show')
    </div>
    <div class="container-xl py-4">
        <div class="row g-4 mb-4">
            <div class="col-10 col-sm-8 col-md-6 col-lg-4">
                <div class="d-flex mb-2">
                    <img src="{{  $job->image ? Storage::url('jobs/' . $job->image) : asset('img/job.jpg') }}"
                         alt="{{ $job->getFullName() }}" class="img-fluid border rounded">
                </div>
                <div class="fs-5 mb-1 fw-semibold">
                    <i class="bi-person-square text-secondary"></i> {{ $job->user->name }}
                </div>
                <div class="fs-5 mb-1 text-{{ $job->statusColor() }}">
                    <i class="bi bi-calendar-check-fill"></i> {{ $job->is_approved }}
                </div>
            </div>
            <div class="col">
                <div class="mb-2">
                    <span class="fs-4 fw-semibold">{{ $job->getFullName() }}</span>
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
                    <span class="fw-semibold">@lang('app.phone'): </span>
                    <a href="tel:+993{{ $job->phone }}" class="text-decoration-none">
                        +993 {{ $job->phone }}
                    </a>
                </div>
                <div class="fs-6">
                    <span class="fw-semibold">@lang('app.email'): </span>
                    <a href="mailto:{{ $job->email }}" class="text-decoration-none">
                        {{ $job->email }}
                    </a>
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
    </div>
@endsection