<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light border-end sidebar collapse">
    <div class="position-sticky py-2 sidebar-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link link-dark" href="{{ route('admin.dashboard') }}">
                    <i class="bi-speedometer text-danger me-1"></i> @lang('app.dashboard')
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link link-dark" href="{{ route('admin.jobs.index') }}">
                    <i class="bi bi-briefcase-fill text-danger me-1"></i> @lang('app.jobs')
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link link-dark" href="{{ route('admin.categories.index') }}">
                    <i class="bi-grid-fill text-danger me-1"></i> @lang('app.categories')
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link link-dark" href="{{ route('admin.locations.index') }}">
                    <i class="bi-geo-alt-fill text-danger me-1"></i> @lang('app.locations')
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link link-dark" href="{{ route('admin.attributes.index') }}">
                    <i class="bi-palette-fill text-danger me-1"></i> @lang('app.attributes')
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link link-dark" href="{{ route('admin.users.index') }}">
                    <i class="bi-people-fill text-danger me-1"></i> @lang('app.users')
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link link-dark" href="{{ route('admin.contacts.index') }}">
                    <i class="bi-chat-right-dots-fill text-danger me-1"></i> @lang('app.contacts')
                </a>
            </li>
        </ul>
    </div>
</nav>