<nav class="navbar navbar-expand-md navbar-dark bg-success" aria-label="navbar">
    <div class="container-xl fs-6" style="font-family: sans-serif;">
        <a class="navbar-brand fs-4" href="{{ route('home') }}"><i class="bi bi-search text-warning"></i> @lang('app.app-name')</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbars" aria-controls="navbars" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbars">
            <form action="{{ route('jobs.index') }}" class="px-2" role="search">
                <input class="form-control" type="search" name="q" value="{{ isset($q) ? $q : old('q') }}" placeholder="@lang('app.search')" aria-label="Search">
            </form>
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link link-light fs-6" href="{{ route('contacts.create') }}">
                        <i class="bi-envelope-plus"></i> @lang('app.contact')
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto">
                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logoutForm').submit();">
                            <i class="bi-box-arrow-right"></i> {{ auth()->user()->name }}
                        </a>
                    </li>
                    <form id="logoutForm" action="{{ route('logout') }}" method="post" class="d-none">
                        @csrf
                    </form>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">
                            <i class="bi-person-plus"></i> @lang('app.register')
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">
                            <i class="bi-box-arrow-in-right"></i> @lang('app.login')
                        </a>
                    </li>
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