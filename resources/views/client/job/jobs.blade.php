<div class="fs-4 d-flex justify-content-between align-items-center">
    <div class="fw-semibold">
        {{ $category->getName() }}
    </div>
    <a href="{{ route('jobs.index', ['c' => [$category->slug]]) }}" class="link-secondary"></a>
</div>
<div class="splide py-4" role="group" id="splide-category-{{ $category->id }}">
    <div class="splide__track">
        <ul class="splide__list">
            <div class="row row-cols-1 row-cols-md-1 row-cols-xl-2 g-4 mb-4">
                @foreach($jobs as $job)
                    <li class="splide__slide">
                        @include('client.app.job')
                    </li>
                @endforeach
            </div>
        </ul>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let splide = new Splide('#splide-category-{{ $category->id }}', {
                type: 'loop',
                autoplay: true,
                arrows: false,
                pagination: false,
                interval: 3000,
                gap: '1.5rem',
                perMove: 1,
                perPage: 2,
                breakpoints: {
                    1399: {
                        perPage: 2,
                    },
                    991: {
                        perPage: 2,
                    },
                    575: {
                        perPage: 1,
                    },
                }
            });
            splide.mount();
        });
    </script>
</div>