@extends('admin.layouts.app')

@section('content')
<div id="page-inner">
    <div class="row">
        <div class="col-lg-12">
            <h2>RECENT ACTIVITIES</h2>
        </div>
    </div>
    <hr />
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>User</th>
                        <th>Lead</th>
                        <th>Bold Penguin Response</th>
                        <th>Response Time</th>                        
                        <th>Created</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($apiLog as $log)
                    <tr>
                        <td>{{ $log->id ?? '' }}</td>
                        <td>{{ $log->user->name ?? '' }}</td>
                        <td>{{ $log->lead->legal_name ?? '' }}</td>
                        <td>{{ $log->response ?? '' }}</td>
                        <td>{{ $log->response_time ?? '' }}</td>
                        <td>{{ $log->created_at ?? '' }}</td>
                        {{-- <td>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <a class="btn btn-primary" href="{{ route('users.edit', $user->id) }}">Edit</a>
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td> --}}
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection