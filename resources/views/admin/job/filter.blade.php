<form action="{{ route('admin.jobs.index') }}" class="row align-items-center g-2" role="search" id="productFilter">

    <div class="col-auto">
        <a href="{{ route('admin.jobs.index') }}" class="btn btn-sm btn-outline-danger">@lang('app.clear') <i class="bi-x"></i></a>
    </div>

    <div class="col">
        <select class="form-select form-select-sm" name="category" id="category" size="1" onchange="$('form#productFilter').submit();">
            <option value>@lang('app.categories')</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ $category->id == $f_category ? 'selected' : '' }}>
                    {{ $category->getName() . ' (' . $category->jobs_count . ')' }}
                </option>
            @endforeach
        </select>
        @error('category')
        <div class="alert alert-danger mt-2">{{ $message }}</div>
        @enderror
    </div>

    <div class="col">
        <select class="form-select form-select-sm" name="location" id="location" size="1" onchange="$('form#productFilter').submit();">
            <option value>@lang('app.locations')</option>
            @foreach($locations as $location)
                <option value="{{ $location->id }}" {{ $location->id == $f_location ? 'selected' : '' }}>
                    {{ $location->getName() . ' (' . $location->jobs_count . ')' }}
                </option>
            @endforeach
        </select>
        @error('location')
        <div class="alert alert-danger mt-2">{{ $message }}</div>
        @enderror
    </div>

    <div class="col">
        <input class="form-control form-control-sm" type="search" name="q" placeholder="{{ @trans('app.search') }}">
    </div>
    <div class="col-auto">
        <button type="submit" class="btn btn-dark btn-sm"><i class="bi-search"></i></button>
    </div>
    <div class="col-auto">
        <a href="{{ route('admin.jobs.create') }}" class="btn btn-danger btn-sm">
            <i class="bi-plus-lg"></i> @lang('app.add')
        </a>
    </div>
</form>
