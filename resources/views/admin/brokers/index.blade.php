@extends('admin.layouts.app')

@section('content')
<div id="page-inner">
    <div class="row">
        <div class="col-lg-12">
            <h2>BROKERS</h2>
        </div>
    </div>
    <hr />
    <div class="row">
        <div class="col-lg-12">
            <div class="form-container" style="float: left">
                <form class="form-inline" method="GET">
                    <div class="form-group">
                        <input type="text" class="form-control" id="search" name="search" placeholder="Broker Name" value="{{$search ?? ''}}">
                    </div>
                    <button type="submit" class="btn btn-default">Filter</button>
                </form>
            </div>
            <div class="form-group" style="float: right">
                <a href="{{ route('brokers.create') }}" class="btn btn-primary">Create Broker</a>
            </div>
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>@sortablelink('id', 'ID')</th>
                        <th>@sortablelink('broker_name', 'Broker Name')</th>
                        <th>@sortablelink('speed_dial', 'Speed Dial')</th>
                        <th>@sortablelink('phone', 'Phone Number')</th>
                        <th>@sortablelink('email', 'Email')</th>
                        <th>@sortablelink('preferred_comm_service', 'Preferred Channel')</th>
                        <th>@sortablelink('created_at', 'Created')</th>
                        <th>@sortablelink('updated_at', 'Updated')</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($brokers as $broker)
                    <tr>
                        <td>{{ $broker->id ?? 'n/a' }}</td>
                        <td>{{ $broker->broker_name ?? 'n/a' }}</td>
                        <td>{{ $broker->speed_dial ?? 'n/a' }}</td>
                        <td>{{ $broker->phone ?? 'n/a' }}</td>
                        <td>{{ $broker->email ?? 'n/a' }}</td>
                        <td>{{ $broker->preferred_comm_service ?? 'n/a' }}</td>
                        <td>{{ $broker->created_at ?? 'n/a' }}</td>
                        <td>{{ $broker->updated_at ?? 'n/a' }}</td>
                        <td>
                            <form action="{{ route('brokers.destroy', $broker->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <a class="btn btn-primary" href="{{ route('brokers.edit', $broker->id) }}">Edit</a>
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this broker?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {!! $brokers->appends(Request::except('page'))->render() !!}
        </div>
    </div>
</div>
@endsection