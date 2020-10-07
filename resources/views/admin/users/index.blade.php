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
            <div class="form-group">
                <a href="{{ route('users.create') }}" class="btn btn-primary btn-lg">Create User</a>
            </div>
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Role</th>
                        <th>Email</th>
                        <th>Created</th>
                        <th>Updated</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id ?? '' }}</td>
                        <td>{{ $user->name ?? '' }}</td>
                        <td>{{ $user && $user->roles ? $user->roles[0]->name : 'n/a' }}</td>
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
        </div>
    </div>
</div>
@endsection