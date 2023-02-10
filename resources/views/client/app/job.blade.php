<div class="d-flex flex-column bg-white border rounded p-3 h-100">
    <div class="fs-5 fw-semibold mb-auto">
            {{ $job->getFullName() }}
    </div>
    <div class="d-flex justify-content-between align-items-end mt-2">
        <div>
            <div class="small"> {{$job->created_at}} </div>
            <div class="fs-6 fw-semibold">Telefon: <span class="fw-normal">+993{{$job->phone}}</span></div>
            <div class="fs-6 text-dark fw-semibold">
                Aýlyk:
                <span class="text-danger fw-normal">{{ number_format($job->salary) }} <small>TMT</small></span>
            </div>
        </div>
        <div class="small text-end">
            <div>
                <i class="bi bi-emoji-heart-eyes-fill text-warning"></i>{{ $job->viewed }}
            </div>
            <div>
                <i class="bi-heart-fill text-danger"></i> {{ $job->favorites }}
            </div>
        </div>
    </div>
</div>