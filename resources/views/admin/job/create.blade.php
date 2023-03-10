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
        @lang('app.add')
    </div>

    <form action="{{ route('admin.jobs.store') }}" method="post" enctype="multipart/form-data">
        <div class="row mb-3 pe-4">
            @csrf
            <div class="col-10 col-sm-8 col-md-6 col-lg-4">

                <div class="mb-3">
                    <label for="category" class="form-label fw-semibold">
                        Category
                        <span class="text-danger">*</span>
                    </label>
                    <select class="form-select @error('category') is-invalid @enderror" name="category" id="category"
                            required>
                        <option value>-</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->getName() }}</option>
                        @endforeach
                    </select>
                    @error('category')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="category" class="form-label fw-semibold">
                        Location
                        <span class="text-danger">*</span>
                    </label>
                    <select class="form-select @error('location') is-invalid @enderror" name="location" id="location"
                            required>
                        <option value>-</option>
                        @foreach($location as $location)
                            <option value="{{ $location->id }}">{{ $location->getName() }}</option>
                        @endforeach
                    </select>
                    @error('location')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label fw-semibold">
                        @lang('app.image')
                    </label>
                    <div class="input-group mb-3">
                        <input type="file" accept="image/jpeg"
                               class="form-control @error('image') is-invalid @enderror"
                               name="images[]" id="image" multiple>
                        <label class="input-group-text" for="image">Upload</label>
                    </div>
                    @error('image')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label fw-semibold">
                        @lang('app.email')
                    </label>
                    <div class="input-group mb-3">
                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                               name="email" id="email" placeholder="name@gmail.com">
                    </div>
                    @error('email')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label fw-semibold">
                        @lang('app.description')
                    </label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control @error('phone') is-invalid @enderror"
                               name="description" id="description">
                    </div>
                </div>
            </div>

            <div class="col-10 col-sm-8 col-md-6 col-lg-4">
                <div class="mb-3">
                    <label for="name_tm" class="form-label fw-semibold">
                        <img src="{{ asset('img/flag/tkm.png') }}" alt="T??rkmen" height="15" class="mb-1">
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
                    <label for="name_en" class="form-label fw-semibold">
                        <img src="{{ asset('img/flag/eng.png') }}" alt="English" height="15" class="mb-1">
                        @lang('app.name')
                    </label>
                    <input type="text" class="form-control @error('name_en') is-invalid @enderror" name="name_en"
                           id="name_en" value="{{ old('name_en') }}">
                    @error('name_en')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label fw-semibold">
                        @lang('app.salary')
                        <span class="text-danger">*</span>
                    </label>
                    <div class="input-group mb-3">
                        <input type="number" min="0" class="form-control @error('salary') is-invalid @enderror"
                               name="salary" id="salary" value="0" required>
                        <span class="input-group-text">TMT</span>
                    </div>
                    @error('salary')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label fw-semibold">
                        @lang('app.phone')
                        <span class="text-danger">*</span>
                    </label>
                    <div class="input-group mb-3">
                        <input type="number" min='61000000' max="65999999" class="form-control @error('phone') is-invalid @enderror"
                               name="phone" id="phone" value="61000000" required>
                    </div>
                    @error('phone')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-10 col-sm-8 col-md-6 col-lg-4">
                @foreach($attributes as $attribute)
                    <div class="mb-3">
                        <label for="{{ strtolower($attribute->name_en) }}" class="form-label fw-semibold">
                            {{ $attribute->getName() }} <span class="text-danger">*</span>
                        </label>
                        <select class="form-select @error('{{ strtolower($attribute->name_en) }}') is-invalid @enderror"
                                name="{{ strtolower($attribute->name_en) }}"
                                id="{{ strtolower($attribute->name_en) }}" required>
                            @foreach($attribute->values as $attributeValue)
                                <option value="{{$attributeValue->id}}">{{ $attributeValue->getName() }}</option>
                            @endforeach
                        </select>
                        @error('{{ strtolower($attribute->name_en) }}')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                @endforeach
            </div>
            <button type="submit" class="btn btn-primary">
                @lang('app.add')
            </button>
        </div>
    </form>
@endsection