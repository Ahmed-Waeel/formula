@extends('layouts.app')
@section('tabTitle', __("view.edit"))
@section('content')
<div class="wrapper">
    <div class="page-wrapper">
        <div class="container-xl">
            <!-- Page title -->
            <div class="page-header d-print-none">
                <div class="row align-items-center">
                    <div class="col">
                        <h2 class="page-title">
                            {{ __("view.editActivity") }} {{ $activity->name }}
                        </h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-body">
            <form action="{{ route('activity.update') }}" method="POST" enctype="multipart/form-data" data-form class="card">
                @csrf
                <input type="hidden" name="id" value="{{ $activity->id }}">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label class="form-label">{{ __("view.title") }}</label>
                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $activity->name }}">
                                        @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <div class="form-label">{{ __('view.image') }}</div>
                                        <input type="file" name=image class="form-control @error('image') is-invalid @enderror">
                                        @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    @if(trim($activity->image) != '')
                                    <div class="d-flex align-items-center">
                                        <span style="width: 100px;">{{ __('view.currentRoomImage') }}</span><img src="{{ asset('uploads/activities') . '/' . $activity->image }}" style="width: fit-content;height: 200px;margin-bottom: 10px">
                                    </div>
                                    @endif
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
    $('[activities_tab]').addClass('active');
</script>
@endsection