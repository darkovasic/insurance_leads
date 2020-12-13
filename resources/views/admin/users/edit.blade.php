@extends('admin.layouts.app')

@section('content')
<div id="page-inner">
    <div class="row">
        <div class="col-lg-12">
            <h2>EDIT USER / {{ $user->name }}</h2>
        </div>
    </div>
    <hr />
    <div class="row">
        <div class="col-md-8">
            <div class="form-container">
                <form method="POST" action="{{ route('users.update', $user->id) }}">
                    @csrf

                    @method('PUT')
                    <div class="form-group row">
                        <label for="name" class="col-md-3 col-form-label text-md-right">{{ __('Full Name') }} <span>*</span></label>

                        <div class="col-md-6">
                            <input id="name" type="text" value="{{ $user->name }}" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-md-3 col-form-label text-md-right">{{ __('E-Mail Address') }} <span>*</span></label>

                        <div class="col-md-6">
                            <input id="email" type="email" value="{{ $user->email }}" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="phone" class="col-md-3 col-form-label text-md-right">{{ __('Phone Number') }} <span>*</span></label>

                        <div class="col-md-6">
                            <input id="phone" type="text" value="{{ $user->phone }}" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" autocomplete="phone">

                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="city" class="col-md-3 col-form-label text-md-right">{{ __('City') }}</label>

                        <div class="col-md-6">
                            <input id="city" type="text" value="{{ $user->city }}" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ old('city') }}" autocomplete="city">

                            @error('city')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="state" class="col-md-3 col-form-label text-md-right">{{ __('Country') }}</label>

                        <div class="col-md-6">
                            <input id="state" type="text" value="{{ $user->state }}" class="form-control @error('state') is-invalid @enderror" name="state" value="{{ old('state') }}" autocomplete="state">

                            @error('state')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="role" class="col-md-3 col-form-label text-md-right">Role <span>*</span></label>
                    
                        <div class="col-md-6">
                            <select name="role" class="form-control" >
                                <option value="agent" {{$user && $user->roles && $user->roles[0]->name == 'agent' ? 'selected' : ''}}>Agent</option>
                                <option value="admin" {{$user && $user->roles && $user->roles[0]->name == 'admin' ? 'selected' : ''}}>Admin</option>
                            </select> 
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-md-3 col-form-label text-md-right">{{ __('Password') }}</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password-confirm" class="col-md-3 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 col-md-offset-3">
                            <button type="submit" class="btn btn-primary btn-lg">
                                {{ __('Update') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection