@extends('layouts.auth')
@section('tabTitle', __('view.newPassword'))
@section('content')

<form method="POST" class="card card-md" action="{{ route('password.update') }}">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">
    <div class="card-body">
        <h2 class="card-title text-center mb-4">{{ __('view.newPassword') }}</h2>
        <div class="card-body">
            <div class="row mb-3">
                <label class="form-label">{{ __('view.email') }}</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="row mb-3">
                <label class="form-label">{{ __('view.password') }}</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="row mb-3">
                <label class="form-label">{{ __('view.confirmPassword') }}</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
            </div>

            <div class="row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('view.save') }}
                    </button>
                </div>
            </div>
        </div>
</form>
@endsection
