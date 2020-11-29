@extends('admin.layouts.app')

@section('content')
<div id="page-inner">
    <div class="row">
        <div class="col-lg-12">
            <h2>CREATE LEAD</h2>
        </div>
    </div>
    <hr />
    <div class="row">
        <div class="col-md-12">
            <div class="form-container">
                <form method="POST" action="{{ route('leads.store') }}">
                    @csrf
                    {{-- @method('PUT') --}}

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="legal_name">Legal Name <span>*</span></label>
                            <input type="text" class="form-control" id="legal_name" name="legal_name" value="">
                            @error('legal_name')
                                <small class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </small>
                            @enderror
                        </div>
                        <div class="form-group col-md-2">
                            <label for="first_name">First Name <span>*</span></label>
                            <input type="text" class="form-control" id="first_name" name="first_name" value="">
                            @error('first_name')
                                <small class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </small>
                            @enderror
                        </div>
                        <div class="form-group col-md-2">
                            <label for="last_name">Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" value="">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="full_time_employees">Full Time Employees</label>
                            <input type="number" class="form-control" id="full_time_employees" name="full_time_employees" value="">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="email_address">Email</label>
                            <input type="email" class="form-control" id="email_address" name="email_address" value="">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="phone">Phone Number <span>*</span></label>
                            <input type="text" class="form-control" id="phone" name="phone" value="">
                            @error('phone')
                                <small class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </small>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="part_time_employees">Part Time Employees</label>
                            <input type="number" class="form-control" id="part_time_employees" name="part_time_employees" value="">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="phy_street">Street</label>
                            <input type="text" class="form-control" id="phy_street" name="phy_street" value="">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="dba_name">DBA Name</label>
                            <input type="text" class="form-control" id="dba_name" name="dba_name" value="">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="currently_insured">Currently Insured</label>
                            <select id="currently_insured" name="currently_insured" class="form-control">
                                <option selected></option>
                                <option value="YES">YES</option>
                                <option value="NO">NO</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="phy_zip">ZIP Code <span>*</span></label>
                            <input type="text" class="form-control" id="phy_zip" name="phy_zip" value="">
                            @error('phy_zip')
                                <small class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </small>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="phy_city">City <span>*</span></label>
                            <input type="text" class="form-control" id="phy_city" name="phy_city" value="">
                            @error('phy_city')
                                <small class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </small>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="years_of_experience">Part Time Employees</label>
                            <input type="number" class="form-control" id="years_of_experience" name="years_of_experience" value="">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-2">
                            <label for="nbr_power_unit"># Trucks</label>
                            <input type="number" class="form-control" id="nbr_power_unit" name="nbr_power_unit" value="">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="driver_total"># Drivers</label>
                            <input type="number" class="form-control" id="driver_total" name="driver_total" value="">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="phy_state">State <span>*</span></label>
                            <select id="phy_state" name="phy_state"  class="form-control">
                                @foreach($states as $key => $value)
                                <option value="{{$key}}">{{ $value }}</option>
                                @endforeach
                            </select>
                            @error('phy_state')
                                <small class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </small>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="legal_entity">Legal Entity</label>
                            <select id="legal_entity" name="legal_entity" class="form-control">
                                @foreach($legal_entities as $key => $value)
                                <option value="{{$key}}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="last_insurance_carrier">Last Insurance Carrier</label>
                            <input type="text" class="form-control" id="last_insurance_carrier" name="last_insurance_carrier" value="">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="dot_number">DOT Number</label>
                            <input type="text" class="form-control" id="dot_number" name="dot_number" value="">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="coverage_type">Coverage Type</label>
                            <select id="coverage_type" name="coverage_type"  class="form-control">
                                @foreach($coverage_types as $key => $value)
                                <option value="{{$key}}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="description">Description</label>
                            <input type="text" class="form-control" id="description" name="description" value="">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="last_insurance_date">Last Insurance Date</label>
                            <input type="text" class="form-control" id="last_insurance_date" name="last_insurance_date" value="">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="insurance_cancellation_date">Insurance Cancelation Date</label>
                            <input type="text" class="form-control" id="insurance_cancellation_date" name="insurance_cancellation_date" value="">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="comment">Comment</label>
                            <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-primary btn-lg" style="float: right">Create Lead</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection