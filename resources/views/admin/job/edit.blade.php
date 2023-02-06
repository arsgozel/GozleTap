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
        @lang('app.edit')
    </div>

    <form action="{{ route('admin.jobs.update', $obj->id) }}" method="post" enctype="multipart/form-data">
        <div class="row mb-3 pe-4">
            @method('PUT')
            @csrf
                <div class="mb-3">
                    <label for="category" class="form-label fw-semibold">
                        Category
                        <span class="text-danger">*</span>
                    </label>
                    <select class="form-select @error('category') is-invalid @enderror" name="category" id="category"
                            required>
                        <option value>-</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $obj->category_id == $category->id ? 'selected':'' }}>{{ $category->getName() }}</option>
                        @endforeach
                    </select>
                    @error('category')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-10 col-sm-8 col-md-6 col-lg-4">
                <div class="mb-3">
                    <label for="name_tm" class="form-label fw-semibold">
                        <img src="{{ asset('img/flag/tkm.png') }}" alt="Türkmen" height="15" class="mb-1">
                        @lang('app.name')
                        <span class="text-danger">*</span>
                    </label>
                    <input type="text" class="form-control @error('name_tm') is-invalid @enderror" name="name_tm"
                           id="name_tm" value="{{ $obj->name_tm }}" required>
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
                           id="name_en" value="{{ $obj->name_tm }}">
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
                        <input type="number" min="0" class="form-control @error('price') is-invalid @enderror"
                               name="price" id="price" value="{{ $obj->salary }}" step="0.1">
                        <span class="input-group-text">TMT</span>
                    </div>
                    @error('salary')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-10 col-sm-8 col-md-6 col-lg-4">
                <div class="mb-3">
                    <label for="gender" class="form-label fw-semibold">
                        @lang('app.gender')
                    </label>
                    <select class="form-select @error('gender') is-invalid @enderror"
                            name="gender"
                            id="gender">
                        <option value>-</option>
                        @foreach($attributes[0]->values as $attributeValue)
                            <option value="{{$attributeValue->id}}" {{ $attributeValue->id == $obj->gender_id ? 'selected' : ''}}>{{ $attributeValue->getName() }}</option>
                        @endforeach
                    </select>
                    @error('gender')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="color" class="form-label fw-semibold">
                        @lang('app.education')
                    </label>
                    <select class="form-select @error('color') is-invalid @enderror"
                            name="color"
                            id="color">
                        <option value>-</option>
                        @foreach($attributes[1]->values as $attributeValue)
                            <option value="{{$attributeValue->id}}" {{ $attributeValue->id == $obj->education_id ? 'selected' : ''}}>{{ $attributeValue->getName() }}</option>
                        @endforeach
                    </select>
                    @error('education')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="size" class="form-label fw-semibold">
                        @lang('app.work_time')
                    </label>
                    <select class="form-select @error('size') is-invalid @enderror"
                            name="size"
                            id="size">
                        <option value>-</option>
                        @foreach($attributes[2]->values as $attributeValue)
                            <option value="{{$attributeValue->id}}" {{ $attributeValue->id == $obj->work_time_id ? 'selected' : ''}}>{{ $attributeValue->getName() }}</option>
                        @endforeach
                    </select>
                    @error('size')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="size" class="form-label fw-semibold">
                        @lang('app.experience')
                    </label>
                    <select class="form-select @error('size') is-invalid @enderror"
                            name="size"
                            id="size">
                        <option value>-</option>
                        @foreach($attributes[3]->values as $attributeValue)
                            <option value="{{$attributeValue->id}}" {{ $attributeValue->id == $obj->experience_id ? 'selected' : ''}}>{{ $attributeValue->getName() }}</option>
                        @endforeach
                    </select>
                    @error('size')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label fw-semibold">
                    @lang('app.image')
                </label>
                <div class="row">
                    @if(count($images) > 0)
                        <div class="col-10 col-sm-8 col-md-6 col-lg-4">
                            @foreach($images as $image)
                                <img src="{{  $image }}" alt="{{ $obj->getName() }}" class="img-fluid rounded"
                                     style="max-height:5rem;">
                            @endforeach
                        </div>
                    @endif
                    <div class="col-10 col-sm-8 col-md-6 col-lg-4">
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
                </div>
            </div>
            <button type="submit" class="btn btn-primary">
                @lang('app.add')
            </button>
        </div>
    </form>
@endsection