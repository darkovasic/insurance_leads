@extends('admin.layouts.app')

@section('content')
<div id="page-inner">
    <div class="row">
        <div class="col-lg-12">
            <h2>CREATE BROKER</h2>
        </div>
    </div>
    <hr />
    <div class="row">
        <div class="col-md-12">
            <div class="form-container">
                <form method="POST" action="{{ route('brokers.store') }}">
                    @csrf
                    {{-- @method('PUT') --}}

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="broker_name">Broker Name <span>*</span></label>
                            <input type="text" class="form-control" id="broker_name" name="broker_name" value="{{ old('broker_name') }}" required>
                            @error('broker_name')
                            <small class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </small>
                        @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="speed_dial">Speed Dial <span>*</span></label>
                            <input type="text" class="form-control" id="speed_dial" name="speed_dial" value="{{ old('speed_dial') }}" required>
                            @error('speed_dial')
                                <small class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </small>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="preferred_comm_service">Preferred Communication Service <span>*</span></label>
                            <input type="text" class="form-control" id="preferred_comm_service" name="preferred_comm_service" value="{{ old('preferred_comm_service') }}" required>
                            @error('preferred_comm_service')
                                <small class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </small>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="contact_first_name">Contact - First Name <span>*</span></label>
                            <input type="text" class="form-control" id="contact_first_name" name="contact_first_name" value="{{ old('contact_first_name') }}" required>
                            @error('contact_first_name')
                            <small class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </small>
                        @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="contact_last_name">Contact - Last Name <span>*</span></label>
                            <input type="text" class="form-control" id="contact_last_name" name="contact_last_name" value="{{ old('contact_last_name') }}" required>
                            @error('contact_last_name')
                                <small class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </small>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="phone">Phone Number <span>*</span></label>
                            <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}" required>
                            @error('phone')
                                <small class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </small>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="email">Email <span>*</span></label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                            @error('email')
                                <small class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </small>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label><strong>States Covered:</strong></label><br/>
                            <select class="form-control" name="states_covered[]" multiple="">
                                @foreach($states as $key => $value)
                                <option value="{{$key}}" {{old("states_covered[]") == $key ? 'selected' : ''}}>{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-primary btn-lg" style="float: right">Create Broker</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection