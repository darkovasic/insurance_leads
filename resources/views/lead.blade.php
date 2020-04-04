@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Agent Dashboard</div>

                <div class="form-container">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <agent-dashboard>
                        {{ csrf_field() }}
                    </agent-dashboard>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
