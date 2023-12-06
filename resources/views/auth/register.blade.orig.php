@extends('layouts.public.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        {{-- sajat mezok ------------------------------------------------------------------------------- --}}

                        <div class="form-group row">
                            <label for="contact_name" class="col-md-4 col-form-label text-md-right">{{ __('messages.register_contact_name_label') }}</label>

                            <div class="col-md-6">
                                <input id="contact_name" type="text" class="form-control{{ $errors->has('contact_name') ? ' is-invalid' : '' }}" name="contact_name" value="{{ old('contact_name') }}" required>

                                @if ($errors->has('contact_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('contact_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone_1" class="col-md-4 col-form-label text-md-right">{{ __('messages.register_contact_phone_label') }}</label>

                            <div class="col-md-6">
                                <input id="phone_1" type="text" class="form-control{{ $errors->has('phone_1') ? ' is-invalid' : '' }}" name="phone_1" value="{{ old('phone_1') }}" required>
                                @if ($errors->has('phone_1'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone_1') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="preferred_contact" class="col-md-4 col-form-label text-md-right">{{ __('messages.register_preferred_contact_label') }}</label>

                            <div class="col-md-6">
                                @foreach(\App\Models\Enum\ClientPreferredContactEnum::toArray() as $contactType)
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="preferred_contact" value="{{$contactType}}" {{ (old('preferred_contect') == $contactType) ? 'checked' : '' }} required>
                                        <label class="form-check-label">
                                            {{ \App\Models\Enum\ClientPreferredContactEnum::getDescription($contactType) }}
                                        </label>
                                    </div>
                                @endforeach
                                    @if ($errors->has('preferred_contact'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('preferred_contact') }}</strong>
                                    </span>
                                    @endif
                            </div>
                        </div>

                        {{-- sajat mezok ------------------------------------------------------------------------------- --}}



                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
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
@endsection
