@extends('admin.layouts.app')

@section('content')
<div id="page-inner">
    <div class="row">
        <div class="col-lg-12">
            <h2>USERS</h2>
        </div>
    </div>
    <hr />
    <div class="row">
        <div class="col-lg-12">
            <div class="form-container">
                <form class="form-inline" method="GET">
                    <div class="form-group">
                        <input type="text" class="form-control" id="search" name="search" placeholder="User name" value="{{$search ?? ''}}">
                    </div>
                    <button type="submit" class="btn btn-default">Filter</button>
                </form>
            </div>
            <div class="form-group">
                <a href="{{ route('users.create') }}" class="btn btn-primary btn-lg">Create User</a>
            </div>
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>@sortablelink('id', 'ID')</th>
                        <th>@sortablelink('name', 'Name')</th>
                        <th>@sortablelink('roles', 'Role')</th>
                        <th>@sortablelink('email', 'Email')</th>
                        <th>@sortablelink('created_at', 'Created')</th>
                        <th>@sortablelink('updated_at', 'Updated')</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id ?? '' }}</td>
                        <td>{{ $user->name ?? '' }}</td>
                        <td>{{ $user->roles ? $user->roles->pluck('name')->implode(', ') : 'n/a' }}</td>
                        <td>{{ $user->email ?? '' }}</td>
                        <td>{{ $user->created_at ?? '' }}</td>
                        <td>{{ $user->updated_at ?? '' }}</td>
                        <td>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <a class="btn btn-primary" href="{{ route('users.edit', $user->id) }}">Edit</a>
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {!! $users->appends(Request::except('page'))->render() !!}
        </div>
    </div>
</div>
@endsection