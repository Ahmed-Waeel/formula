@extends('layouts.app')
@section('tabTitle', __("view.addAdmin"))
@section('content')
<div class="wrapper">
    <div class="page-wrapper">
        <div class="container-xl">
            <!-- Page title -->
            <div class="page-header d-print-none">
                <div class="row align-items-center">
                    <div class="col">
                        <h2 class="page-title">
                            {{ __("view.addAdmin") }}
                        </h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-body">
            <form action="{{ route('admin.store') }}" method="POST" data-form class="card">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label class="form-label">{{ __("view.name") }}</label>
                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                                        @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-label">{{ __('view.email') }}</div>
                                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
                                        @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <div class="form-label">{{ __('view.role') }}</div>
                                        <div>
                                            <label class="form-check form-check-inline">
                                                <input class="form-check-input  @error('role') is-invalid @enderror" name="role" type="radio" value="0" checked>
                                                <span class="form-check-label">Admin</span>
                                            </label>
                                            <label class="form-check form-check-inline">
                                                <input class="form-check-input  @error('role') is-invalid @enderror" name="role" type="radio" super_admin value="1">
                                                <span class="form-check-label">Super Admin</span>
                                            </label>
                                            @error('role')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        @if(old('role') == 1)
                                        <script>
                                            $('[type=radio]:checked').prop('checked', false);
                                            $('[super_admin]').prop('checked', true);
                                        </script>
                                        @endif
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">{{ __('view.password') }}</label>
                                        <div class="input-group input-group-flat">
                                            <input type="password" password-input name="password" class="form-control @error('password') is-invalid @enderror">
                                            @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <span class="input-group-text" eye @error('password') hidden @enderror>
                                                <a class="link-secondary" password data-input=password data-bs-toggle="tooltip">
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

                                    <div class="mb-3">
                                        <label class="form-label">{{ __('view.confirmPassword') }}</label>
                                        <div class="input-group input-group-flat">
                                            <input type="password" password-input name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror">
                                            @error('password_confirmation')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <span class="input-group-text" eye @error('password_confirmation') hidden @enderror>
                                                <a class="link-secondary" password data-input=password_confirmation data-bs-toggle="tooltip">
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
                                    <div class="card-footer text-end">
                                        <div class="d-flex">
                                            <button type="submit" class="btn btn-primary ms-auto">{{ __('view.submit') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $('[admins_tab]').addClass('active');

    $(document).ready(function() {
        $('a[password]').on('click', function({
            target
        }) {
            const selector = $(target).parent().attr('data-input');
            const type = ($(`[name=${selector}]`).attr('type') == 'password' ? 'text' : 'password');
            $(`[name=${selector}]`).attr('type', type);
        });
    });
    $('input').on('focus', ({
        target
    }) => {
        $(target)
            .removeClass('is-invalid')
            .siblings('[eye]').removeAttr('hidden');
    });
</script>
@endsection