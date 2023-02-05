<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light border-end sidebar collapse">
    <div class="position-sticky py-2 sidebar-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link link-dark" href="{{ route('admin.dashboard') }}">
                    <i class="bi-speedometer text-danger me-1"></i> @lang('app.dashboard')
                </a>
            </li>
            @can('jobs')
            <li class="nav-item">
                <a class="nav-link link-dark" href="{{ route('admin.jobs.index') }}">
                    <i class="bi-briefcase-fill text-danger me-1"></i> @lang('app.jobs')
                </a>
            </li>
            @endcan
            @can('categories')
                <li class="nav-item">
                    <a class="nav-link link-dark" href="{{ route('admin.categories.index') }}">
                        <i class="bi-grid-fill text-danger me-1"></i> @lang('app.categories')
                    </a>
                </li>
            @endcan
            @can('attributes')
            <li class="nav-item">
                <a class="nav-link link-dark" href="{{ route('admin.attributes.index') }}">
                    <i class="bi-palette-fill text-danger me-1"></i> @lang('app.attributes')
                </a>
            </li>
            @endcan
            @can('locations')
            <li class="nav-item">
                <a class="nav-link link-dark" href="{{ route('admin.locations.index') }}">
                    <i class="bi-geo-alt-fill text-danger me-1"></i> @lang('app.locations')
                </a>
            </li>
            @endcan
            @can('contacts')
            <li class="nav-item">
                <a class="nav-link link-dark" href="{{ route('admin.contacts.index') }}">
                    <i class="bi-chat-left-dots-fill text-danger me-1"></i> @lang('app.contacts')
                </a>
            </li>
            @endcan
            @can('users')
            <li class="nav-item">
                <a class="nav-link link-dark" href="{{ route('admin.users.index') }}">
                    <i class="bi-people-fill text-danger me-1"></i> @lang('app.users')
                </a>
            </li>
            @endcan
        </ul>
    </div>
</nav>