<nav class="navbar navbar-expand-md navbar-dark bg-success" aria-label="navbar">
    <div class="container-xl fs-6" style="font-family: sans-serif;">
        <a class="navbar-brand fs-4" href="{{ route('home') }}"><i class="bi bi-search text-warning"></i> @lang('app.app-name')</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbars" aria-controls="navbars" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbars">
            <ul class="navbar-nav me-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                        @lang('app.categories')
                    </a>
                    <ul class="dropdown-menu">
                        @foreach($categories as $category)
                            <li>
                                <a class="dropdown-item" href="{{ route('jobs.index', ['c' => [$category->id]]) }}">
                                    {{ $category->getName() }}
                                    <span class="badge text-bg-info bg-opacity-10">{{ $category->jobs_count }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                        @lang('app.locations')
                    </a>
                    <ul class="dropdown-menu">
                        @foreach($locations as $location)
                            <li>
                                <a class="dropdown-item" href="{{ route('jobs.index', ['l' => [$location->id]]) }}">
                                    {{ $location->getName() }}
                                    <span class="badge text-bg-info bg-opacity-10">{{ $location->jobs_count }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>

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
                    <li>
                        <a class="nav-link px-3" href="{{ route('admin.dashboard') }}" target="_blank">
                            <i class="bi-box-arrow-up-right"></i>
                        </a>
                    </li>
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
                            <img src="{{ asset('img/flag/tkm.png') }}" alt="T??rkmen" style="height:1rem;">
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