@extends('admin.layouts.app')

@section('content')
<div id="page-inner">
    <div class="row text-center">
        <div class="col-lg-12">
            <h2>ADMIN DASHBOARD</h2>
        </div>
    </div>
    <hr />
    <div class="row">
        <div class="col-lg-12 ">
            <div class="alert alert-info">
            Welcome <strong>{{auth()->user()->name}}</strong>!
            {{$leadsSentCount}} leads were sent to the brokers yesterday.
            </div>
        </div>
    </div>
    <div class="row text-center pad-top">
        {{-- <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
            <div class="div-square">
                <a href="#">
                    <i class="fa fa-circle-o-notch fa-5x"></i>
                    <h4>Check Data</h4>
                </a>
            </div>
        </div> --}}
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
            <div class="div-square">
                <a href="{{ route('users.index') }}">
                    <i class="fa fa-users fa-5x"></i>
                    <h4>See Users</h4>
                </a>
            </div>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
            <div class="div-square">
                <a href="{{ route('users.create') }}">
                    <i class="fa fa-user fa-5x"></i>
                    <h4>Register User</h4>
                </a>
            </div>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
            <div class="div-square">
                <a href="{{ route('leads.index') }}">
                    <i class="fa fa-users fa-5x"></i>
                    <h4>Check Leads</h4>
                </a>
            </div>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
            <div class="div-square">
                <a href="{{ route('leads.create') }}">
                    <i class="fa fa-user fa-5x"></i>
                    <h4>Register Lead</h4>
                </a>
            </div>
        </div>
    </div>
    {{-- <div class="row">
        <div class="col-lg-12 ">
            <br />
            <div class="alert alert-danger">
                <strong>Want More Icons Free ? </strong>
                Checkout fontawesome website and use any icon
                <a
                    target="_blank"
                    href="http://fortawesome.github.io/Font-Awesome/icons/"
                    >Click Here</a
                >.
            </div>
        </div>
    </div> --}}    
</div>
@endsection