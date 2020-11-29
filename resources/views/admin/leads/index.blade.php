@extends('admin.layouts.app')

@section('content')
<div id="page-inner">
    <div class="row">
        <div class="col-lg-12">
            <h2>LEADS</h2>
        </div>
    </div>
    <hr />
    <div class="row">
        <div class="col-lg-12">
            <div class="form-container" style="float: left">
                <form class="form-inline" method="GET">
                    <div class="form-group">
                        <input type="text" class="form-control" id="search" name="search" placeholder="Legal Name" value="{{$search ?? ''}}">
                    </div>
                    <button type="submit" class="btn btn-default" ali>Filter</button>
                </form>
            </div>
            <div class="form-group" style="float: right">
                <a href="{{ route('leads.create') }}" class="btn btn-primary">Create Lead</a>
            </div>
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>@sortablelink('id', 'ID')</th>
                        <th>@sortablelink('dot_number', 'DOT Number')</th>
                        <th>@sortablelink('legal_name', 'Legal Name')</th>
                        <th>@sortablelink('email_address', 'Email')</th>
                        <th>@sortablelink('phone', 'Phone Number')</th>
                        <th>@sortablelink('state', 'State')</th>
                        <th>@sortablelink('created_at', 'Created')</th>
                        <th>@sortablelink('updated_at', 'Updated')</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($leads as $lead)
                    <tr>
                        <td>{{ $lead->id ?? 'n/a' }}</td>
                        <td>{{ $lead->dot_number ?? 'n/a' }}</td>
                        <td>{{ $lead->legal_name ?? 'n/a' }}</td>
                        <td>{{ $lead->email_address ?? 'n/a' }}</td>
                        <td>{{ $lead->phone ?? 'n/a' }}</td>
                        <td>{{ $lead->phy_state ?? 'n/a' }}</td>
                        <td>{{ $lead->created_at ?? 'n/a' }}</td>
                        <td>{{ $lead->updated_at ?? 'n/a' }}</td>
                        <td>
                            <form action="{{ route('leads.destroy', $lead->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <a class="btn btn-primary" href="{{ route('leads.edit', $lead->id) }}">Edit</a>
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {!! $leads->appends(Request::except('page'))->render() !!}
        </div>
    </div>
</div>
@endsection