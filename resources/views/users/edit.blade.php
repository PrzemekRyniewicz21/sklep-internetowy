@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit user data') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('users.update', $user->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group row">
                            <label for="city" class="col-md-4 col-form-label text-md-right">{{ __('City') }}</label>

                            <div class="col-md-6">
                                <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="address[city]" value="{{ $user->hasAddress() ? $user->address->city : 'X' }}" required autocomplete="city" autofocus>

                                @error('city')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="zip_code" class="col-md-4 col-form-label text-md-right">{{ __('Zip code') }}</label>

                            <div class="col-md-6">
                                <input id="zip_code" type="text" class="form-control @error('zip_code') is-invalid @enderror" name="address[zip_code]" value="{{ $user->hasAddress() ? $user->address->zip_code : 'X' }}" required autocomplete="zip_code" autofocus>

                                @error('zip_code')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="street" class="col-md-4 col-form-label text-md-right">{{ __('Street') }}</label>

                            <div class="col-md-6">
                                <input id="street" type="text" class="form-control @error('street') is-invalid @enderror" name="address[street]" value="{{ $user->hasAddress() ? $user->address->street : 'X' }}" required autocomplete="street" autofocus>

                                @error('street')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="home_no" class="col-md-4 col-form-label text-md-right">{{ __('Home number') }}</label>

                            <div class="col-md-6">
                                <input id="home_no" type="text" class="form-control @error('home_no') is-invalid @enderror" name="address[home_no]" value="{{ $user->hasAddress() ? $user->address->home_no : 'X' }}" required autocomplete="home_no" autofocus>

                                @error('home_no')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection