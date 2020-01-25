@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Agent Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <agent-dashboard></agent-dashboard>
                    {{-- <form>
                        @csrf
                        <div class="row" style="background:cadetblue">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="dot_number">DOT Number</label>
                                    <input type="text" class="form-control" id="dot_number">
                                </div>                                
                            </div>
                            <div class="col-md-6" >
                                <button type="submit" class="btn btn-primary">Submit</button>                               
                            </div>
                        </div>
                    </form>
                    <form>
                        @csrf
                        <div class="row" style="background:burlywood">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="person_name">Contact Name</label>
                                    <input type="text" class="form-control" id="person_name">
                                </div>
                                <div class="form-group">
                                    <label for="email_address">Email</label>
                                    <input type="email" class="form-control" id="email_address">
                                </div>
                                <div class="form-group">
                                    <label for="phy_street">Street</label>
                                    <input type="text" class="form-control" id="phy_street">
                                </div>
                                <div class="form-group">
                                    <label for="phy_zip">ZIP Code</label>
                                    <input type="text" class="form-control" id="phy_zip">
                                </div>
                                <div class="form-group">
                                    <label for="nbr_power_unit">Number of Trucks</label>
                                    <input type="text" class="form-control" id="nbr_power_unit">
                                </div>
                                <div class="form-group">
                                    <label for="last_insurance_carrier">Last Insurance Carrier</label>
                                    <input type="text" class="form-control" id="last_insurance_carrier">
                                </div>                             
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="telephone">Phone Number</label>
                                    <input type="text" class="form-control" id="telephone">
                                </div>
                                <div class="form-group">
                                    <label for="dba_name">Company</label>
                                    <input type="text" class="form-control" id="dba_name">
                                </div>
                                <div class="form-group">
                                    <label for="phy_city">City</label>
                                    <input type="text" class="form-control" id="phy_city">
                                </div>
                                <div class="form-group">
                                    <label for="phy_state">State</label>
                                    <input type="text" class="form-control" id="phy_state">
                                </div>
                                <div class="form-group">
                                    <label for="driver_total">Number of Drivers</label>
                                    <input type="text" class="form-control" id="driver_total">
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <input type="text" class="form-control" id="description">
                                </div>                   
                            </div>
                        </div>
                    </form> --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
