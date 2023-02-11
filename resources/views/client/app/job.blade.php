<div class="position-relative bg-white border rounded">
    <div class="row g-0">
        <div class="col-3">
            <div class="d-flex">
                <img src="{{  $job->image ? Storage::url('jobs/sm/' . $job->image) : asset('img/sm/job.jpg') }}"
                     alt="{{ $job->getFullName() }}" class="img-fluid rounded-start">
            </div>
        </div>
        <div class="col p-2">
            <div class="d-flex flex-column h-100">
                <div class="fs-5 fw-semibold mb-auto">
                        {{ $job->getFullName() }}
                    <span class="fs-6">
                            <a href="{{ route('jobs.show', $job->slug) }}" class="link-secondary">
                                <i class="bi-arrow-right-circle"></i>
                            </a>
                    </span>
                </div>
                <div class="d-flex justify-content-between align-items-end mt-2">
                    <div>
                        <div class="small"> {{ $job->created_at }}</div>
                        <div class="small fw-semibold"><i class="bi bi-wallet-fill text-danger"></i> @lang('app.salary'): <span class="fw-normal">{{ $job->salary }} TMT</span></div>
                        <div class="small fw-semibold"><i class="bi bi-telephone-fill text-success"></i> @lang('app.phone'): <span class="fw-normal">+993{{ $job->phone }}</span></div>
                        <div class="small fw-semibold"><i class="bi bi-envelope-fill text-primary"></i> @lang('app.email'): <span class="fw-normal">{{ $job->email }}</span></div>
                    </div>

                    <div class="small text-end">
                        <div>
                            <i class="bi bi-eye-fill text-dark"></i>{{ $job->viewed }}
                        </div>
                        <div>
                            <i class="bi-heart-fill text-danger"></i> {{ $job->favorites }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>