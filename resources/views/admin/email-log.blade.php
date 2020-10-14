@extends('admin.layouts.app')

@section('content')
<div id="page-inner">
    <div class="row">
        <div class="col-lg-12">
            <h2>EMAIL LOG</h2>
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
                        <th>Email ID</th>
                        <th>Email Type</th>                        
                        <th>Email Status</th> 
                        {{-- <th>Created</th> --}}
                        <th>Updated</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($emailLog as $log)
                    <tr>
                        <td>{{ $log->id ?? 'n/a' }}</td>
                        <td>{{ $log->user->name ?? 'n/a' }}</td>
                        <td>{{ $log->lead->legal_name ?? 'n/a' }}</td>
                        <td>{{ $log->message_id ?? 'n/a' }}</td>
                        <td>{{ $log->type ?? 'n/a' }}</td>
                        <td>{{ $log->status ?? 'n/a' }}</td>
                        {{-- <td>{{ $log->created_at ?? 'n/a' }}</td> --}}
                        <td>{{ $log->updated_at ?? 'n/a' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection