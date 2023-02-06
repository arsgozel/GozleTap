<div class="d-flex flex-column bg-white border rounded p-3 h-100">
    <div class="fs-6 fw-semibold mb-auto">
        <a href="{{ route('admin.jobs.index', $job->id) }}" class="text-dark text-decoration-none">
            {{ $job->getFullName() }}
        </a>
    </div>
    <div class="d-flex justify-content-between align-items-end mt-2">
        <div>
            <div class="small"> {{$job->created_at}} </div>
            <div class="text-primary fw-semibold">
                {{ number_format($job->salary) }}
                <small>TMT</small>
            </div>
        </div>
        <div class="small text-end">
            <div>
                <i class="bi bi-emoji-heart-eyes-fill text-warning"></i></i> {{ $job->viewed }}
            </div>
            <div>
                <i class="bi-heart-fill text-danger"></i> {{ $job->favorites }}
            </div>
        </div>
    </div>
</div>