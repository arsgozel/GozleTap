<nav class="navbar navbar-expand-md navbar-dark bg-success" aria-label="navbar">
    <div class="container-xl fs-5" style="font-family: sans-serif;">
        <a class="navbar-brand fs-4" href="{{ route('home') }}"><i class="bi bi-search text-warning"></i> @lang('app.app-name')</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbars" aria-controls="navbars" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbars">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link link-light fs-5" href="{{ route('contacts.create') }}">
                        <i class="bi-envelope-plus"></i> @lang('app.contact')
                    </a>
                </li>
                @auth('customer_web')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logoutForm').submit();">
                            <i class="bi-box-arrow-right"></i> {{ auth('customer_web')->user()['name'] }}
                        </a>
                    </li>
                    <form id="logoutForm" action="{{ route('logout') }}" method="post" class="d-none">
                        @csrf
                    </form>
                @endauth
                @if(app()->getLocale() == 'en')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('language', 'tm') }}">
                            <img src="{{ asset('img/flag/tkm.png') }}" alt="Türkmen" style="height:1rem;">
                        </a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('language', 'en') }}">
                            <img src="{{ asset('img/flag/eng.png') }}" alt="English" style="height:1rem;">
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>