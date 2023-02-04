@extends('admin.layouts.app')
@section('title')
    @lang('app.attributeValues')
@endsection
@section('content')
    <div class="h4 mb-3">
        <a href="{{ route('admin.attributes.index') }}" class="text-decoration-none">
            @lang('app.attributes')
        </a>
        <i class="bi-chevron-right small"></i>
        @lang('app.add')
    </div>
    <div class="row mb-3">
        <div class="col-10 col-sm-8 col-md-6 col-lg-4">
            <form action="{{ route('admin.attributeValues.store') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="attribute" class="form-label fw-semibold">
                        @lang('app.attribute')
                        <span class="text-danger">*</span>
                    </label>
                    <select class="form-select @error('attribute') is-invalid @enderror" name="attribute" id="attribute"
                            autofocus required>
                        @foreach($attributes as $attribute)
                            <option value="{{ $attribute->id }}">{{ $attribute->getName() }}</option>
                        @endforeach
                    </select>
                    @error('attribute')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="name_tm" class="form-label fw-bold">
                        <img src="{{ asset('img/flag/tkm.png') }}" alt="Türkmen" height="15">
                        @lang('app.name')
                        <span class="text-danger">*</span>
                    </label>
                    <input type="text" class="form-control @error('name_tm') is-invalid @enderror" name="name_tm"
                           id="name_tm" value="{{ old('name_tm') }}" required>
                    @error('name_tm')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="name_en" class="form-label fw-bold">
                        <img src="{{ asset('img/flag/eng.png') }}" alt="English" height="15">
                        @lang('app.name')
                    </label>
                    <input type="text" class="form-control @error('name_en') is-invalid @enderror" name="name_en"
                           id="name_en" value="{{ old('name_en') }}">
                    @error('name_en')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="sort_order" class="form-label fw-bold">
                        @lang('app.sortOrder')
                        <span class="text-danger">*</span>
                    </label>
                    <input type="number" min="1" class="form-control @error('sort_order') is-invalid @enderror"
                           name="sort_order" id="sort_order" value="1" required>
                    @error('sort_order')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">
                    @lang('app.add')
                </button>
            </form>
        </div>
    </div>
@endsection
