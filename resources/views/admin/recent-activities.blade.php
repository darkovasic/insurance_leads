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
                        <th>@sortablelink('id', 'ID')</th>
                        <th>@sortablelink('user.name', 'User')</th>
                        <th>@sortablelink('lead.legal_name', 'Lead')</th>
                        <th>@sortablelink('response', 'Bold Penguin Response')</th>
                        <th>@sortablelink('response_time', 'Response Time')</th>                        
                        <th>@sortablelink('created_at', 'Created')</th>
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
            {{-- {{ $apiLog->links() }} --}}
            {!! $apiLog->appends(Request::except('page'))->render() !!}
        </div>
    </div>
</div>
@endsection