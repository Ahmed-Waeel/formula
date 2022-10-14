@extends('layouts.auth')
@section('tabTitle', __('view.resetPassword'))
@section('content')


@if (session('status'))
<div class="alert alert-success" role="alert">
    {{ session('status') }}
</div>
@endif

<form method="POST" class="card card-md" action="{{ route('password.email') }}">
    @csrf
    <div class="card-body">
        <h2 class="card-title text-center mb-4">{{ __('view.resetPassword') }}</h2>
        <div class="card-body">
            <div class="mb-3">
                <label class="form-label">{{ __('view.email') }}</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

        </div>

        <div class="row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('view.sendResetPasswordLink') }}
                </button>
            </div>
        </div>
    </div>
</form>
@endsection