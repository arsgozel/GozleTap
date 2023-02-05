@extends('admin.layouts.app')
@section('title')
    @lang('app.users')
@endsection
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="h4 mb-0">
            @lang('app.users')
        </div>
        <div>
            <a href="{{ route('admin.users.create') }}" class="btn btn-danger btn-sm">
                <i class="bi-plus-lg"></i> @lang('app.add')
            </a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-hover table-striped">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Username</th>
                <th scope="col">Permissions</th>
                <th scope="col"><i class="bi-gear-fill"></i></th>
            </tr>
            </thead>
            <tbody>
            @foreach($objs as $obj)
                <tr>
                    <td>{{ $obj->id }}</td>
                    <td>{{ $obj->name }}</td>
                    <td>{{ $obj->username }}</td>
                    <td>
                        @foreach($permissions as $permission)
                            @if(in_array($permission['id'], $obj->permissions ?: []))
                                <span class="badge text-bg-primary">{{ $permission['name'] }}</span>
                            @endif
                        @endforeach
                    </td>
                    <td>
                        <a href="{{ route('admin.users.edit', $obj->id) }}" class="btn btn-success btn-sm my-1">
                            <i class="bi-pencil"></i>
                        </a>
                        @if($obj->id != 1 and $obj->id != auth()->id())
                            <button type="button" class="btn btn-secondary btn-sm my-1" data-bs-toggle="modal" data-bs-target="#delete{{ $obj->id }}">
                                <i class="bi-trash"></i>
                            </button>
                            <div class="modal fade" id="delete{{ $obj->id }}" tabindex="-1" aria-labelledby="delete{{ $obj->id }}Label" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <div class="modal-title fs-5 fw-semibold" id="delete{{ $obj->id }}Label">
                                                {{ $obj->name }}
                                            </div>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-footer">
                                            <form action="{{ route('admin.users.destroy', $obj->id) }}" method="post">
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
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection