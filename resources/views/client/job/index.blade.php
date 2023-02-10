@extends('client.layouts.app')
@section('title')
    @lang('app.jobs') - @lang('app.app-name')
@endsection
@section('content')
    <div class="container-xl py-4">
        <div class="row g-4 mb-4">
            <div class="col-sm-4 col-lg-3 col-xxl-2">
                @include('client.app.filter')
            </div>
            <div class="col">
                <div class="row row-cols-1 row-cols-md-1 row-cols-xl-1 g-4 mb-4">
                    @foreach($jobs as $job)
                        <div class="col">
                            @include('client.app.job')
                        </div>
                    @endforeach
                </div>
                {{ $jobs->links() }}
            </div>
        </div>
    </div>
@endsection