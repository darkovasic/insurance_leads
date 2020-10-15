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
                        <td>{{ $log->id ?? 'n/a' }}</td>
                        <td>{{ $log->user->name ?? 'n/a' }}</td>
                        <td>{{ $log->lead->legal_name ?? 'n/a' }}</td>
                        <td>{{ $log->response ?? 'n/a' }}</td>
                        <td>{{ round($log->response_time, 2).' seconds' ?? 'n/a' }}</td>
                        <td>{{ $log->created_at ?? 'n/a' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $apiLog->links() }}
        </div>
    </div>
</div>
@endsection