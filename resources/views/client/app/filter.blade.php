<form action="{{ url()->current() }}">
    <input type="hidden" name="q" value="{{ isset($q) ? $q : old('q') }}">
    <div class="accordion" id="accordion">
        <div class="accordion-item">
            <button class="accordion-button collapsed" type="button" id="panels-h2" data-bs-toggle="collapse" data-bs-target="#panels-c2" aria-expanded="false" aria-controls="panels-c2">
                @lang('app.categories')
            </button>
            <div id="panels-c2" class="accordion-collapse collapse" aria-labelledby="panels-h2">
                <div class="accordion-body p-1">
                    @foreach($categories as $category)
                        <div class="form-check m-2">
                            <input class="form-check-input" type="checkbox" id="c{{ $category->id }}" name="c[]"
                                   value="{{ $category->id }}" {{ $f_categories->contains($category->id) ? 'checked' : '' }}>
                            <label class="form-check-label" for="c{{ $category->id }}">
                                {{ $category->getName() }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <button class="accordion-button collapsed" type="button" id="panels-l2" data-bs-toggle="collapse" data-bs-target="#panels-l2" aria-expanded="false" aria-controls="panels-l2">
                @lang('app.locations')
            </button>
            <div id="panels-l2" class="accordion-collapse collapse" aria-labelledby="panels-l2">
                <div class="accordion-body p-2">
                    @foreach($locations as $location)
                        <div class="form-check m-2">
                            <input class="form-check-input" type="checkbox" id="c{{ $location->id }}" name="l[]"
                                value="{{ $location->id }}" {{ $f_locations->contains($location->id) ? 'checked' : '' }}>
                            <label class="form-check-label" for="l{{ $location->id }}">
                                {{ $location->getName() }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        @foreach($attributes as $attribute)
            <div class="accordion-item">
                <button class="accordion-button collapsed" type="button" id="panels-ha{{ $attribute->id }}" data-bs-toggle="collapse" data-bs-target="#panels-ca{{ $attribute->id }}" aria-expanded="false" aria-controls="panels-ca{{ $attribute->id }}">
                    {{ $attribute->getName() }}
                    <span class="d-none">{{ $i = $loop->index }}</span>
                </button>
                <div id="panels-ca{{ $attribute->id }}" class="accordion-collapse collapse" aria-labelledby="panels-ha{{ $attribute->id }}">
                    <div class="accordion-body p-1">
                        @foreach($attribute->values as $attributeValues)
                            <div class="form-check m-2">
                                <input class="form-check-input" type="checkbox" id="a{{ $attributeValues->id }}" name="v[{{ $i }}][]"
                                       value="{{ $attributeValues->id }}" {{ $f_values->contains($attributeValues->id) ? 'checked' : '' }}>
                                <label class="form-check-label" for="a{{ $attributeValues->id }}">
                                    {{ $attributeValues->getName() }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
        <div class="accordion-item">
            <button class="accordion-button collapsed" type="button" id="panels-h4" data-bs-toggle="collapse" data-bs-target="#panels-c4" aria-expanded="false" aria-controls="panels-c4">
                @lang('app.search')
            </button>
        </div>
    </div>

    <button type="submit" class="btn btn-success btn-sm w-100 my-2">Filter</button>
    <a href="{{ url()->current() }}" class="btn btn-light btn-sm w-100">Clear</a>
</form>