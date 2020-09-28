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
            {{-- <a href="#" class="btn btn-default">default</a> --}}
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id ?? '' }}</td>
                        <td>{{ $user->name ?? '' }}</td>
                        <td>{{ $user->email ?? '' }}</td>
                        <td>{{ $user->created_at ?? '' }}</td>
                        <td>{{ $user->updated_at ?? '' }}</td>
                        <td><a href="#"><i class="fa fa-edit fa-2x"></i></a></td>
                        <td><a href="#"><i class="fa fa-times fa-2x"></i></a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection