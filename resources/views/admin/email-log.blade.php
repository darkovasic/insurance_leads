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
            <div class="form-container">
                <form class="form-inline" method="GET">
                    <div class="form-group">
                        <input type="text" class="form-control" id="search" name="search" placeholder="User name" value="{{$search ?? ''}}">
                    </div>
                    <button type="submit" class="btn btn-default">Filter</button>
                </form>
            </div>
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>@sortablelink('id', 'ID')</th>
                        <th>@sortablelink('user.name', 'User')</th>
                        <th>@sortablelink('lead.legal_name', 'Lead')</th>
                        <th>@sortablelink('message_id', 'Message ID')</th>
                        <th>@sortablelink('type', 'Email Type')</th>                        
                        <th>@sortablelink('status', 'Email Status')</th> 
                        {{-- <th>Created</th> --}}
                        <th>@sortablelink('updated_at', 'Updated')</th>
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
            {!! $emailLog->appends(Request::except('page'))->render() !!}
        </div>
    </div>
</div>
@endsection