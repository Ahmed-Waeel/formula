@extends('layouts.app')
@section('tabTitle', __("view.profile"))
@section('content')
<div class="wrapper">
    <div class="page-wrapper">
        <div class="container-xl">
            <!-- Page title -->
            <div class="page-header d-print-none">
                <div class="row align-items-center">
                    <div class="col">
                        <h2 class="page-title">
                            {{ __("view.profile") }}
                        </h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-body">
            <form action="{{ route('admin.update') }}" method="POST" enctype="multipart/form-data" data-form class="card">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-3">
                                        <div class="form-label">{{ __('view.photo') }}</div>
                                        <input type="file" name=photo class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">{{ __("view.name") }}</label>
                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $admin->name }}">
                                        @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-label">{{ __('view.email') }}</div>
                                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ $admin->email }}">
                                        @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="card-footer text-end">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <a href="{{ route('admin.changePassword') }}">{{ __('view.changePassword') }}</a>
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
@endsection