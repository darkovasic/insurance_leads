@extends('admin.layouts.app')

@section('content')
<div id="page-inner">
    <div class="row">
        <div class="col-lg-12">
            <h2>IMPORT ERROR LOG</h2>
        </div>
    </div>
    <hr />
    <div class="row">
        <div class="col-lg-12 col-md-12">
            {{-- <div class="form-container">
                <form class="form-inline" method="GET">
                    <div class="form-group">
                        <input type="text" class="form-control" id="search" name="search" placeholder="User Name" value="{{$search ?? ''}}">
                    </div>
                    <button type="submit" class="btn btn-default">Filter</button>
                </form>
            </div> --}}
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>@sortablelink('id', 'ID')</th>
                        <th>@sortablelink('job_id', 'Job ID')</th>
                        <th>@sortablelink('row_number', 'Row')</th>
                        <th>Error Message</th>
                        {{-- <th>Created</th> --}}
                        <th>@sortablelink('created_at', 'Created')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($errorLog as $log)
                    <tr>
                        <td>{{ $log->id ?? 'n/a' }}</td>
                        <td>{{ $log->job_id ?? 'n/a' }}</td>
                        <td>{{ $log->row_number ?? 'n/a' }}</td>
                        <td>{{ $log->message ?? 'n/a' }}</td>
                        {{-- <td>{{ $log->created_at ?? 'n/a' }}</td> --}}
                        <td>{{ $log->created_at ?? 'n/a' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {!! $errorLog->appends(Request::except('page'))->render() !!}
        </div>
    </div>
</div>
@endsection