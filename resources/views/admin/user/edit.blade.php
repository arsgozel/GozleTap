@extends('admin.layouts.app')
@section('title')
    @lang('app.users')
@endsection
@section('content')
    <div class="h4 mb-3">
        <a href="{{ route('admin.users.index') }}" class="text-decoration-none">
            @lang('app.users')
        </a>
        <i class="bi-chevron-right small"></i>
        @lang('app.edit')
    </div>

    <div class="row mb-3">
        <div class="col-10 col-sm-8 col-md-6 col-lg-4">
            <form action="{{ route('admin.users.update', $obj->id) }}" method="post">
                @method('PUT')
                @csrf
                @honeypot

                <div class="mb-3">
                    <label for="name" class="form-label fw-semibold">
                        @lang('app.name')
                        <span class="text-danger">*</span>
                    </label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ $obj->name }}" required autofocus>
                    @error('name')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="username" class="form-label fw-semibold">
                        @lang('app.username')
                        <span class="text-danger">*</span>
                    </label>
                    <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" id="username" value="{{ $obj->username }}" required>
                    @error('username')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label fw-semibold">
                        @lang('app.password')
                    </label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" value="{{ old('password') }}">
                    @error('password')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    @foreach($permissions as $permission)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="{{ $permission['id'] }}" id="permission{{ $permission['id'] }}" name="permissions[]" {{ in_array($permission['id'], $obj->permissions) ? 'checked':'' }}>
                            <label class="form-check-label" for="permission{{ $permission['id'] }}">
                                {{ $permission['name'] }}
                            </label>
                        </div>
                    @endforeach
                </div>

                <button type="submit" class="btn btn-primary">
                    @lang('app.update')
                </button>
            </form>
        </div>
    </div>
@endsection