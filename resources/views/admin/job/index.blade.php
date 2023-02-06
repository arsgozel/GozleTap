@extends('admin.layouts.app')
@section('title')
    @lang('app.products')
@endsection
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="h4 mb-0">
            @lang('app.products')
        </div>
        <div>
            @include('admin.job.filter')
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">User</th>
                <th scope="col">Approve</th>
                <th scope="col">Image</th>
                <th scope="col" width="15%">Category</th>
                <th scope="col">Name</th>
                <th scope="col" width="20%">Full Name</th>
                <th scope="col">Salary</th>
                <th scope="col">Reactions</th>
                <th scope="col"><i class="bi-gear-fill"></i></th>
            </tr>
            </thead>
            <tbody>
            @forelse($objs as $obj)
                <tr>
                    <td>{{ $obj->id }}</td>
                    <td>
                        <div class="fs-6 mb-1">
                            {{ $obj->user->name}}
                        </div>
                    </td>
                    <td>
                        <div class="fs-6 mb-1 text-center">
                            <span class="badge text-bg-{{ $obj->statusColor() }}">{{$obj->is_approved}}</span>
                        </div>
                    </td>
                    <td>
                        <img src="{{ $obj->getImage() }}" alt="{{ $obj->image }}" class="img-fluid rounded" style="max-height:5rem;">
                    </td>
                    <td>
                        <div>
                            <i class="bi-grid-fill text-danger me-1"></i>
                            @if($obj->category->parent_id)
                                <span class="text-secondary">{{ $obj->category->parent->getName() }},</span>
                            @endif
                            {{ $obj->category->getName() }}
                        </div>
                    </td>
                    <td>
                        <div class="mb-1">
                            <img src="{{ asset('img/flag/tkm.png') }}" alt="Türkmen" width="25" height="15"
                                 class="mb-1">
                            {{ $obj->name_tm }}
                        </div>
                        <div class="small">
                            <img src="{{ asset('img/flag/eng.png') }}" alt="English" width="25" height="15"
                                 class="mb-1">
                            {{ $obj->name_tm }}
                        </div>
                    </td>
                    <td>
                        <div class="mb-1">
                            <img src="{{ asset('img/flag/tkm.png') }}" alt="Türkmen" width="25" height="15" class="mb-1">
                            {{ $obj->full_name_tm }}
                        </div>
                        <div class="small">
                            <img src="{{ asset('img/flag/eng.png') }}" alt="English" width="25" height="15" class="mb-1">
                            {{ $obj->full_name_tm }}
                        </div>
                    </td>
                    <td>
                        <div class="fs-5 mb-1">
                            {{ $obj->salary}}
                            <small>TMT</small>
                        </div>
                    </td>
                    <td>
                        <div>
                            <i class="bi-heart-fill text-danger"></i>
                            {{ $obj->favorites }}
                            <br>
                            <i class="bi bi-eye-fill text-dark"></i>
                            {{ $obj->viewed }}
                        </div>
                    </td>
                    <td>
                        @if($obj->user->id == 1)
                            <a href="{{ route('admin.jobs.edit', $obj->id) }}" class="btn btn-success btn-sm my-1">
                                <i class="bi-pencil"></i>
                            </a>
                        @endif
                            <button type="button" class="btn btn-secondary btn-sm my-1" data-bs-toggle="modal" data-bs-target="#delete{{ $obj->id }}">
                                <i class="bi-trash"></i>
                            </button>
                            <div class="modal fade" id="delete{{ $obj->id }}" tabindex="-1" aria-labelledby="delete{{ $obj->id }}Label" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <div class="modal-title fs-5 fw-semibold" id="delete{{ $obj->id }}Label">
                                                {{ $obj->getName() }}
                                            </div>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-footer">
                                            <form action="{{ route('admin.jobs.destroy', $obj->id) }}" method="post">
                                                @method('DELETE')
                                                @csrf
                                                <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">@lang('app.close')</button>
                                                <button type="submit" class="btn btn-secondary btn-sm"><i class="bi-trash"></i> @lang('app.delete')</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>

                </tr>
            @empty
                <tr>
                    <td colspan="10" class="text-center">
                        @lang('app.jobNotFound')!
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
    <div class="mb-3">
        {{ $objs->links() }}
    </div>
@endsection
