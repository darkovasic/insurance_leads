@extends('admin.layouts.app')

@section('content')
<div id="page-inner">
    <div class="row">
        <div class="col-lg-12">
            <h2>EDIT LEAD / {{ $lead->legal_name }}</h2>
        </div>
    </div>
    <hr />
    <div class="row">
        <div class="col-md-12">
            <div class="form-container">
                <form method="POST" action="{{ route('leads.update', $lead->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="legal_name">Legal Name <span>*</span></label>
                            <input type="text" class="form-control" id="legal_name" name="legal_name" value="{{ $lead->legal_name }}" required autofocus>
                            @error('legal_name')
                                <small class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </small>
                            @enderror
                        </div>
                        <div class="form-group col-md-2">
                            <label for="first_name">First Name <span>*</span></label>
                            <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $lead->first_name }}" required>
                            @error('first_name')
                                <small class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </small>
                            @enderror
                        </div>
                        <div class="form-group col-md-2">
                            <label for="last_name">Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $lead->last_name }}">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="full_time_employees">Full Time Employees</label>
                            <input type="number" class="form-control" id="full_time_employees" name="full_time_employees" value="{{ $lead->full_time_employees }}">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="email_address">Email</label>
                            <input type="email" class="form-control" id="email_address" name="email_address" value="{{ $lead->email_address }}">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="phone">Phone Number <span>*</span></label>
                            <input type="text" class="form-control" id="phone" name="phone" value="{{ $lead->phone }}" required>
                            @error('phone')
                                <small class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </small>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="part_time_employees">Part Time Employees</label>
                            <input type="number" class="form-control" id="part_time_employees" name="part_time_employees" value="{{ $lead->part_time_employees }}">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="phy_street">Street</label>
                            <input type="text" class="form-control" id="phy_street" name="phy_street" value="{{ $lead->phy_street }}">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="dba_name">DBA Name</label>
                            <input type="text" class="form-control" id="dba_name" name="dba_name" value="{{ $lead->dba_name ?? '' }}">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="currently_insured">Currently Insured <span>*</span></label>
                            <select id="currently_insured" name="currently_insured"  class="form-control" required>
                                <option selected></option>
                                <option value="YES" {{$lead && $lead->currently_insured == 'YES' ? 'selected' : ''}}>YES</option>
                                <option value="NO" {{$lead && $lead->currently_insured == 'NO' ? 'selected' : ''}}>NO</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="phy_zip">ZIP Code <span>*</span></label>
                            <input type="text" class="form-control" id="phy_zip" name="phy_zip" value="{{ $lead->phy_zip }}" required>
                            @error('phy_zip')
                                <small class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </small>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="phy_city">City <span>*</span></label>
                            <input type="text" class="form-control" id="phy_city" name="phy_city" value="{{ $lead->phy_city }}" required>
                            @error('phy_city')
                                <small class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </small>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="years_of_experience">Part Time Employees</label>
                            <input type="number" class="form-control" id="years_of_experience" name="years_of_experience" value="{{ $lead->years_of_experience }}">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-2">
                            <label for="nbr_power_unit"># Trucks</label>
                            <input type="number" class="form-control" id="nbr_power_unit" name="nbr_power_unit" value="{{ $lead->nbr_power_unit }}">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="driver_total"># Drivers</label>
                            <input type="number" class="form-control" id="driver_total" name="driver_total" value="{{ $lead->driver_total }}">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="phy_state">State <span>*</span></label>
                            <select id="phy_state" name="phy_state" class="form-control" required>
                                @foreach($states as $key => $value)
                                <option value="{{$key}}" {{$lead && $lead->phy_state == $key ? 'selected' : ''}}>{{ $value }}</option>
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
                                <option value="{{$key}}" {{$lead && $lead->legal_entity == $key ? 'selected' : ''}}>{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="last_insurance_carrier">Last Insurance Carrier</label>
                            <input type="text" class="form-control" id="last_insurance_carrier" name="last_insurance_carrier" value="{{ $lead->last_insurance_carrier }}">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="dot_number">DOT Number</label>
                            <input type="text" class="form-control" id="dot_number" name="dot_number" value="{{ $lead->dot_number }}" disabled>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="coverage_type">Coverage Type</label>
                            <select id="coverage_type" name="coverage_type" class="form-control">
                                @foreach($coverage_types as $key => $value)
                                <option value="{{$key}}" {{$lead && $lead->coverage_type == $key ? 'selected' : ''}}>{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="description">Description</label>
                            <input type="text" class="form-control" id="description" name="description" value="{{ $lead->description }}">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="last_insurance_date">Last Insurance Date</label>
                            <input type="date" class="form-control" id="last_insurance_date" name="last_insurance_date" value="{{ $lead->last_insurance_date }}">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="insurance_cancellation_date">Insurance Cancelation Date</label>
                            <input type="date" class="form-control" id="insurance_cancellation_date" name="insurance_cancellation_date" value="{{ $lead->insurance_cancellation_date }}">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="comment">Comment</label>
                            <textarea class="form-control" id="comment" name="comment" rows="3">{{ $lead->comment }}</textarea>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-primary btn-lg" style="float: right">Update Lead</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection