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
            {{-- <div class="form-container">
                <form class="form-inline" method="GET">
                    <div class="form-group">
                        <label for="filter" class="col-sm-2 col-form-label">Filter</label>
                        <input type="text" class="form-control" id="filter" name="filter" placeholder="User name..." value="{{$filter ?? ''}}">
                    </div>
                    <button type="submit" class="btn btn-default mb-2">Filter</button>
                </form>
            </div> --}}
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>@sortablelink('id', 'ID')</th>
                        <th>@sortablelink('user.name', 'User')</th>
                        <th>@sortablelink('lead.legal_name', 'Lead')</th>
                        <th>@sortablelink('response', 'Response ID')</th>
                        <th>@sortablelink('response_time', 'Response Time')</th>                        
                        <th>@sortablelink('created_at', 'Date')</th>
                        <th>BP Request</th>
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
                        <td>
                            <button 
                                type="button" 
                                class="btn btn-primary" 
                                data-toggle="modal" 
                                data-name="{{ $log->user->name }}" 
                                data-date="{{ $log->created_at }}" 
                                data-request="{{ $log->request }}" 
                                data-target="#bp_request"
                            >
                                View
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- {{ $apiLog->links() }} --}}
            {!! $apiLog->appends(Request::except('page'))->render() !!}
        </div>
    </div>
</div>

<div class="modal fade" id="bp_request" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> --}}
            </div>
            <div class="modal-body">
                <samp></samp>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page-js-script')
<script type="text/javascript">
    $('#bp_request').on('show.bs.modal', function(e) {

        var request  = e.relatedTarget.dataset.request,
            name  = e.relatedTarget.dataset.name,
            date  = e.relatedTarget.dataset.date,
            modal    = $(this);

        modal.find("samp").html(request);
        modal.find(".modal-title").html(name+' on '+date);
    });
</script>
@endsection