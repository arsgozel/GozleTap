@extends('admin.layouts.app')
@section('title')
    @lang('app.attributes')
@endsection
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="h4 mb-0">
            @lang('app.attributes')
        </div>
        <div>
            <a href="{{ route('admin.attributes.create') }}" class="btn btn-danger btn-sm">
                <i class="bi-plus-lg"></i> @lang('app.attribute')
            </a>
            <a href="{{ route('admin.attributeValues.create') }}" class="btn btn-danger btn-sm">
                <i class="bi-plus-lg"></i> @lang('app.attributeValue')
            </a>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-hover table-striped">
            <thead>
            <tr class="text-center">
                <th scope="col">ID</th>
                <th scope="col">@lang('app.sortOrder')</th>
                <th scope="col"><img src="{{ asset('img/flag/tkm.png') }}" alt="Türkmen" height="15"> Name</th>
                <th scope="col"><img src="{{ asset('img/flag/eng.png') }}" alt="English" height="15"> Name</th>
                <th scope="col">@lang('app.jobName')</th>
                <th scope="col">@lang('app.values')</th>
                <th scope="col"><i class="bi-gear-fill"></i></th>
            </tr>
            </thead>
            <tbody class="text-center">
            @foreach($objs->sortBy('sort_order')->sortBy('parent.sort_order') as $obj)
                <tr>
                    <td>{{ $obj->id }}</td>
                    <td>{{ $obj->sort_order }}</td>
                    <td>{{ $obj->name_tm }}</td>
                    <td>{!! $obj->name_en ?: '<span class="text-warning">' . $obj->name_tm . '</span>' !!}</td>
                    <td>
                        {!! $obj->job_name == 0 ? '<i class="bi bi-x-circle-fill text-danger"></i>':'' !!}
                        {!! $obj->job_name == 1 ? '<i class="bi bi-check-circle-fill text-success"></i>':'' !!}
                    </td>
                    <td class="p-1">
                        <div class="collapse" id="collapse{{ $obj->id }}">
                            <div class="table-responsive">
                                <table class="table table-hover table-striped">
                                    <tbody>
                                    @forelse($obj->values as $value)
                                        <tr>
                                            <td>{{ $value->id }}</td>
                                            <td>{{ $value->sort_order }}</td>
                                            <td>{{ $value->name_tm }}</td>
                                            <td>{!! $value->name_en ?: '<span class="text-warning">' . $value->name_tm . '</span>' !!}</td>
                                            <td>
                                                <a href="{{ route('admin.jobs.index', ['attributeValues' => $value->id, 'stock' => 1]) }}" class="text-decoration-none">
                                                    {{ $value->jobs_count }} <i class="bi-box-arrow-up-right"></i>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.attributeValues.edit', $value->id) }}" class="btn btn-success btn-sm my-1">
                                                    <i class="bi-pencil"></i>
                                                </a>
                                                <button type="button" class="btn btn-secondary btn-sm my-1" data-bs-toggle="modal" data-bs-target="#deleteV{{ $value->id }}">
                                                    <i class="bi-trash"></i>
                                                </button>
                                                <div class="modal fade" id="deleteV{{ $value->id }}" tabindex="-1" aria-labelledby="deleteV{{ $value->id }}Label" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <div class="modal-title fs-5 fw-semibold" id="deleteV{{ $value->id }}Label">
                                                                    {{ $value->getName() }}
                                                                </div>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <form action="{{ route('admin.attributeValues.destroy', $value->id) }}" method="post">
                                                                    @method('DELETE')
                                                                    @csrf
                                                                    @honeypot
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
                                        <tr class="table-warning">
                                            <td>Not found</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </td>
                    <td>
                        <button class="btn btn-light btn-sm my-1" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $obj->id }}" aria-expanded="false" aria-controls="collapse{{ $obj->id }}">
                            @lang('app.values')
                        </button>
                        <a href="{{ route('admin.attributes.edit', $obj->id) }}" class="btn btn-success btn-sm my-1">
                            <i class="bi-pencil"></i>
                        </a>
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
                                        <form action="{{ route('admin.attributes.destroy', $obj->id) }}" method="post">
                                            @method('DELETE')
                                            @csrf
                                            @honeypot
                                            <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">@lang('app.close')</button>
                                            <button type="submit" class="btn btn-secondary btn-sm"><i class="bi-trash"></i> @lang('app.delete')</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    {{ $objs->links() }}
@endsection
