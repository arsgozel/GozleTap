@extends('admin.layouts.app')
@section('title')
    @lang('app.contacts')
@endsection
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="h4 mb-0">
            @lang('app.contacts')
        </div>
        <div>
            @include('admin.contacts.filter')
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-hover table-striped">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Phone</th>
                <th scope="col">Name</th>
                <th scope="col">Message</th>
                <th scope="col">Received at</th>
            </tr>
            </thead>
            <tbody>
            @foreach($objs as $obj)
                <tr>
                    <td>{{ $obj->id }}</td>
                    <td>
                        <i class="bi-telephone-fill text-success"></i>
                        <a href="tel:+993{{ $obj->phone }}" class="text-decoration-none">
                            +993 {{ $obj->phone }}
                        </a>
                    </td>
                    <td>{{ $obj->name }}</td>
                    <td>
                        @if($obj->message)
                            <div class='small'>
                                <i class="bi-chat-left-text-fill text-danger"></i> {{ $obj->message }}
                            </div>
                        @endif
                    </td>
                    <td>{{ $obj->received_at }}</td>
                    <td>
                        <div class="modal-footer">
                            <form action="{{ route('admin.contacts.destroy', $obj->id) }}" method="post">
                                @method('DELETE')
                                @csrf
                                @honeypot
                                <button type="submit" class="btn btn-secondary btn-sm"><i class="bi-trash"></i> @lang('app.delete')</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection