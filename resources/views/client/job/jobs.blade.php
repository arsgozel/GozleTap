<div class="fs-4 d-flex justify-content-between align-items-center">
    <div class="fw-semibold">
        {{ $category->getName() }}
    </div>
</div>
<div class="splide py-4" role="group" id="splide-category-{{ $category->id }}">
    <div class="splide__track">
        <ul class="splide__list">
            @foreach($jobs as $job)
                <li class="splide__slide">
                    @include('client.app.job')
                </li>
            @endforeach
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
                perPage: 4,
                breakpoints: {
                    1399: {
                        perPage: 3,
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