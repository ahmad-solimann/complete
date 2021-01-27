@extends('users.layouts.app')

@section('content')
    <section id="breadcrumbs" class="breadcrumbs">

        <div class="container" style="font-family: 'Open Sans Semibold'">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card" style="box-shadow: -8px 4px 8px 7px darkgrey;">
                        <div class="card-header"><h3 class="text-center">{{ __('Register') }}</h3></div>

                        <div class="card-body">
                            <form id="form" method="POST" action="{{ route('register') }}"  autocomplete="off">
                                @csrf
                                <div class="form-group row">
                                    <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                                    <div class="col-md-6">
                                        <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" autocomplete="off" value="{{old('username')}}" autofocus/>

                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{old('name')}}" autocomplete="off" required />

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required />

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                    <div class="col-md-6">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="first_name" class="col-md-4 col-form-label text-md-right">{{ __('First name') }}</label>

                                    <div class="col-md-6">
                                        <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" value="{{old('first_name')}}" name="first_name" autofocus />

                                        @error('first_name')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="last_name" class="col-md-4 col-form-label text-md-right">{{ __('Last name') }}</label>

                                    <div class="col-md-6">
                                        <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" value="{{old('last_name')}}" name="last_name" autocomplete="off" autofocus />

                                        @error('last_name')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('phone') }}</label>

                                    <div class="col-md-6">
                                        <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" value="{{old('phone')}}" autocomplete="off" name="phone" autofocus />

                                        @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="city" class="col-md-4 col-form-label text-md-right">{{ __('city') }}</label>

                                    <div class="col-md-6">
                                        <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" value="{{old('city')}}" name="city" autocomplete="off" autofocus />

                                        @error('city')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="address_1" class="col-md-4 col-form-label text-md-right">{{ __('address') }}</label>

                                    <div class="col-md-6">
                                        <input id="city" type="text" class="form-control @error('address_1') is-invalid @enderror" value="{{old('address_1')}}" name="address_1" autocomplete="off" autofocus />

                                        @error('address_1')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="form-group row mb-0">
                                    <div class=" text-center col-md-6 offset-md-4">
                                        <button type="submit" class="btn" style="background:#0c0c0c; color: #e9e9e9">
                                            {{ __('Register') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection