@extends('admin.layouts.app')
@section('title')
    @lang('app.categories')
@endsection
@section('content')
    <div class="h4 mb-3">
        <a href="{{ route('admin.categories.index') }}" class="text-decoration-none">
            @lang('app.categories')
        </a>
        <i class="bi-chevron-right small"></i>
        @lang('app.edit')
    </div>

    <div class="row mb-3">
        <div class="col-10 col-sm-8 col-md-6 col-lg-4">
            <form action="{{ route('admin.categories.update', $obj->id) }}" method="post">
                @method('PUT')
                @csrf
                @honeypot

                <div class="mb-3">
                    <label for="parent" class="form-label fw-semibold">
                        @lang('app.parentCategory')
                    </label>
                    <select class="form-select @error('parent') is-invalid @enderror" name="parent" id="parent" autofocus>
                        <option value>-</option>
                        @foreach($parents as $parent)
                            <option value="{{ $parent->id }}" {{ $obj->parent_id == $parent->id ? 'selected':'' }}>{{ $parent->getName() }}</option>
                        @endforeach
                    </select>
                    @error('parent')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="name_tm" class="form-label fw-semibold">
                        <img src="{{ asset('img/flag/tkm.png') }}" alt="Türkmen" height="15">
                        @lang('app.name')
                        <span class="text-danger">*</span>
                    </label>
                    <input type="text" class="form-control @error('name_tm') is-invalid @enderror" name="name_tm" id="name_tm" value="{{ $obj->name_tm }}" required>
                    @error('name_tm')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="name_en" class="form-label fw-semibold">
                        <img src="{{ asset('img/flag/eng.png') }}" alt="English" height="15">
                        @lang('app.name')
                    </label>
                    <input type="text" class="form-control @error('name_en') is-invalid @enderror" name="name_en" id="name_en" value="{{ $obj->name_en }}">
                    @error('name_en')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="sort_order" class="form-label fw-semibold">
                        @lang('app.sortOrder')
                        <span class="text-danger">*</span>
                    </label>
                    <input type="number" min="1" class="form-control @error('sort_order') is-invalid @enderror" name="sort_order" id="sort_order" value="{{ $obj->sort_order }}" required>
                    @error('sort_order')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>


                <button type="submit" class="btn btn-primary">
                    @lang('app.update')
                </button>
            </form>
        </div>
    </div>
@endsection