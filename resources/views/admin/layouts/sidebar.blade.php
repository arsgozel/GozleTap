<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light border-end sidebar collapse">
    <div class="position-sticky py-2 sidebar-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link link-dark" href="{{ route('admin.dashboard') }}">
                    <i class="bi-speedometer text-danger me-1"></i> @lang('app.dashboard')
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link link-dark" href="{{ route('admin.customers.index') }}">
                    <i class="bi-people-fill text-danger me-1"></i> @lang('app.customers')
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link link-dark" href="{{ route('admin.verifications.index') }}">
                    <i class="bi-shield-fill-check text-danger me-1"></i> @lang('app.verifications')
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link link-dark" href="{{ route('admin.jobs.index') }}">
                    <i class="bi bi-briefcase-fill text-danger me-1"></i> @lang('app.jobs')
                </a>
            </li>
            @can('categories')
                <li class="nav-item">
                    <a class="nav-link link-dark" href="{{ route('admin.categories.index') }}">
                        <i class="bi-grid-fill text-danger me-1"></i> @lang('app.categories')
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
            <li class="nav-item">
                <a class="nav-link link-dark" href="{{ route('admin.users.index') }}">
                    <i class="bi-people-fill text-danger me-1"></i> @lang('app.users')
                </a>
            </li>
        </ul>
    </div>
</nav>