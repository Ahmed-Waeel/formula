@extends('layouts.auth')
@section('tabTitle', __('view.login'))
@section('content')
<form class="card card-md" method="POST" action="{{ url('/login') }}" autocomplete>
    @csrf
    <div class="card-body">
        <h2 class="card-title text-center mb-4">{{ __('view.login') }}</h2>
        <div class="mb-3">
            <label class="form-label">{{ __('view.email') }}</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="mb-2">
            <label class="form-label">
                {{ __('view.password') }}
                <span class="form-label-description">
                    <a href="{{ url('/password/reset') }}">{{ __('view.forgotPassword') }}</a>
                </span>
            </label>
            <div class="input-group input-group-flat">
                <input type="password" password-input class="form-control @error('password') is-invalid @enderror" name="password" required>
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <span class="input-group-text">
                    <a class="link-secondary" password data-bs-toggle="tooltip">
                        <!-- Download SVG icon from http://tabler-icons.io/i/eye -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <circle cx="12" cy="12" r="2" />
                            <path d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7" />
                        </svg>
                    </a>
                </span>
            </div>
        </div>
        <div class="mb-2">
            <label class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <span class="form-check-label">{{ __('view.rememberMe') }}</span>
            </label>
        </div>
        <div class="form-footer">
            <button type="submit" class="btn btn-primary w-100">{{ __('view.signin') }}</button>
        </div>
    </div>
</form>
@endsection
