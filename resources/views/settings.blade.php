@extends('layouts.app')
@section('tabTitle', __("view.settings"))
@section('content')
<style>
    form{
        margin-bottom: 10px;
    }
    .page-title{
        margin-bottom: 5px;
    }
</style>
<div class="wrapper">
    <div class="page-wrapper">
        <div class="container-xl">
            <!-- Page title -->
            <div class="page-header d-print-none">
                <div class="row align-items-center">
                    <div class="col">
                        <h2 class="page-title">
                            {{ __("view.settings") }}
                        </h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-body">
            <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data" data-form class="card">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label class="form-label">{{ __("view.". $en_logo->key) }}</label>
                                        <input type="file" name="{{$en_logo->key}}" class="form-control @error($en_logo->key) is-invalid @enderror">
                                        @error($en_logo->key)
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        @if(trim($en_logo->value) != '')
                                            <div class="d-flex align-items-center">
                                                <span style="width: 100px;">{{ __('view.currentImage') }}</span><img src="{{ asset('pdf') . '/' . $en_logo->value }}" style="width: fit-content;height: 90px;margin-bottom: 10px">
                                            </div>
                                        @endif
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">{{ __("view.". $ar_logo->key) }}</label>
                                        <input type="file" name="{{$ar_logo->key}}" class="form-control @error($ar_logo->key) is-invalid @enderror">
                                        @error($ar_logo->key)
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        @if(trim($ar_logo->value) != '')
                                            <div class="d-flex align-items-center">
                                                <span style="width: 100px;">{{ __('view.currentImage') }}</span><img src="{{ asset('pdf') . '/' . $ar_logo->value }}" style="width: fit-content;height: 90px;margin-bottom: 10px">
                                            </div>
                                        @endif
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

            <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data" data-form class="card">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label class="form-label">{{ __("view." . str_replace('en_', '', $en_title->key)) }}</label>
                                        <input type="text" name="{{$en_title->key}}" class="form-control @error($en_title->key) is-invalid @enderror" value="{{ $en_title->value }}">
                                        @error($en_title->key)
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">{{ __("view." . str_replace('ar_', '', $ar_title->key)) }}</label>
                                        <input type="text" name="{{$ar_title->key}}" class="form-control @error($ar_title->key) is-invalid @enderror" value="{{ $ar_title->value }}">
                                        @error($ar_title->key)
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
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

            <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data" data-form class="card">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12">
                                    <div class="page-title">{{ __('view.enHotelsTable') }}</div>
                                    <div class="mb-3">
                                        <label class="form-label">{{ __("view." . str_replace( 'en_', '', $en_hotels[0]['key'])) }}</label>
                                        <input type="text" name="{{$en_hotels[0]['key']}}" class="form-control @error($en_hotels[0]['key']) is-invalid @enderror" value="{{ $en_hotels[0]['value'] }}">
                                        @error($en_hotels[0]['key'])
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    @for ($i = 1; $i <count($en_hotels) ; $i++)
                                            <div class="mb-3">
                                                <label class="form-label">{{ __("view.".str_replace('en_', '', $en_hotels[$i]['key'])) }}</label>
                                                <input type="text" name="{{$en_hotels[$i]['key']}}" class="form-control @error($en_hotels[$i]['key']) is-invalid @enderror" value="{{ $en_hotels[$i]->value }}">
                                                @error($en_hotels[$i]['key'])
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                    @endfor
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

            <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data" data-form class="card">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12">
                                    <div class="page-title">{{ __('view.arHotelsTable') }}</div>
                                    <div class="mb-3">
                                        <label class="form-label">{{ __("view." . str_replace( 'ar_', '', $ar_hotels[0]['key'])) }}</label>
                                        <input type="text" name="{{$ar_hotels[0]['key']}}" class="form-control @error($ar_hotels[0]['key']) is-invalid @enderror" value="{{ $ar_hotels[0]['value'] }}">
                                        @error($ar_hotels[0]['key'])
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    @for ($i = 1; $i < count($ar_hotels) ; $i++)
                                            <div class="mb-3">
                                                <label class="form-label">{{ __("view.".str_replace('ar_', '', $ar_hotels[$i]['key'])) }}</label>
                                                <input type="text" name="{{$ar_hotels[$i]['key']}}" class="form-control @error($ar_hotels[$i]['key']) is-invalid @enderror" value="{{ $ar_hotels[$i]->value }}">
                                                @error($ar_hotels[$i]['key'])
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                    @endfor
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

            <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data" data-form class="card">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12">
                                    <div class="page-title">{{ __('view.enInternationalFlightsTable') }}</div>
                                    <div class="mb-3">
                                        <label class="form-label">{{ __("view." . str_replace( 'en_', '', $en_international_flights[0]['key'])) }}</label>
                                        <input type="text" name="{{$en_international_flights[0]['key']}}" class="form-control @error($en_international_flights[0]['key']) is-invalid @enderror" value="{{ $en_international_flights[0]['value'] }}">
                                        @error($en_international_flights[0]['key'])
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    @for ($i = 1; $i < count($en_international_flights) ; $i++)
                                            <div class="mb-3">
                                                <label class="form-label">{{ __("view.".str_replace('en_', '', $en_international_flights[$i]['key'])) }}</label>
                                                <input type="text" name="{{$en_international_flights[$i]['key']}}" class="form-control @error($en_international_flights[$i]['key']) is-invalid @enderror" value="{{ $en_international_flights[$i]->value }}">
                                                @error($en_international_flights[$i]['key'])
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                    @endfor
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

            <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data" data-form class="card">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12">
                                    <div class="page-title">{{ __('view.arInternationalFlightsTable') }}</div>
                                    <div class="mb-3">
                                        <label class="form-label">{{ __("view." . str_replace( 'ar_', '', $ar_international_flights[0]['key'])) }}</label>
                                        <input type="text" name="{{$ar_international_flights[0]['key']}}" class="form-control @error($ar_international_flights[0]['key']) is-invalid @enderror" value="{{ $ar_international_flights[0]['value'] }}">
                                        @error($ar_international_flights[0]['key'])
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    @for ($i = 1; $i < count($ar_international_flights) ; $i++)
                                            <div class="mb-3">
                                                <label class="form-label">{{ __("view.".str_replace('ar_', '', $ar_international_flights[$i]['key'])) }}</label>
                                                <input type="text" name="{{$ar_international_flights[$i]['key']}}" class="form-control @error($ar_international_flights[$i]['key']) is-invalid @enderror" value="{{ $ar_international_flights[$i]->value }}">
                                                @error($ar_international_flights[$i]['key'])
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                    @endfor
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

            <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data" data-form class="card">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12">
                                    <div class=page-title>{{ __('view.enInternalFLightsTable') }}asdsadas</div>
                                    <div class="mb-3">
                                        <label class="form-label">{{ __("view." . str_replace( 'en_', '', $en_internal_flights[0]['key'])) }}</label>
                                        <input type="text" name="{{$en_internal_flights[0]['key']}}" class="form-control @error($en_internal_flights[0]['key']) is-invalid @enderror" value="{{ $en_internal_flights[0]['value'] }}">
                                        @error($en_internal_flights[0]['key'])
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    @for ($i = 1; $i < count($en_internal_flights) ; $i++)
                                            <div class="mb-3">
                                                <label class="form-label">{{ __("view.".str_replace('en_', '', $en_internal_flights[$i]['key'])) }}</label>
                                                <input type="text" name="{{$en_internal_flights[$i]['key']}}" class="form-control @error($en_internal_flights[$i]['key']) is-invalid @enderror" value="{{ $en_internal_flights[$i]->value }}">
                                                @error($en_internal_flights[$i]['key'])
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                    @endfor
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

            <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data" data-form class="card">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12">
                                    <div class="page-title">{{ __('view.enInternalFLightsTable') }}</div>
                                    <div class="mb-3">
                                        <label class="form-label">{{ __("view." . str_replace( 'ar_', '', $ar_internal_flights[0]['key'])) }}</label>
                                        <input type="text" name="{{$ar_internal_flights[0]['key']}}" class="form-control @error($ar_internal_flights[0]['key']) is-invalid @enderror" value="{{ $ar_internal_flights[0]['value'] }}">
                                        @error($ar_internal_flights[0]['key'])
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    @for ($i = 1; $i < count($ar_internal_flights) ; $i++)
                                            <div class="mb-3">
                                                <label class="form-label">{{ __("view.".str_replace('ar_', '', $ar_internal_flights[$i]['key'])) }}</label>
                                                <input type="text" name="{{$ar_internal_flights[$i]['key']}}" class="form-control @error($ar_internal_flights[$i]['key']) is-invalid @enderror" value="{{ $ar_internal_flights[$i]->value }}">
                                                @error($ar_internal_flights[$i]['key'])
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                    @endfor
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

            <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data" data-form class="card">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12">
                                    <div class="page-title">{{ __('view.enTransportationsTable') }}</div>
                                    <div class="mb-3">
                                        <label class="form-label">{{ __("view." . str_replace( 'en_', '', $en_transportations[0]['key'])) }}</label>
                                        <input type="text" name="{{$en_transportations[0]['key']}}" class="form-control @error($en_transportations[0]['key']) is-invalid @enderror" value="{{ $en_transportations[0]['value'] }}">
                                        @error($en_transportations[0]['key'])
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    @for ($i = 1; $i < count($en_transportations) ; $i++)
                                            <div class="mb-3">
                                                <label class="form-label">{{ __("view.".str_replace('en_', '', $en_transportations[$i]['key'])) }}</label>
                                                <input type="text" name="{{$en_transportations[$i]['key']}}" class="form-control @error($en_transportations[$i]['key']) is-invalid @enderror" value="{{ $en_transportations[$i]->value }}">
                                                @error($en_transportations[$i]['key'])
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                    @endfor
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

            <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data" data-form class="card">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12">
                                    <div class="page-title">{{ __('view.arTransportationsTable') }}</div>
                                    <div class="mb-3">
                                        <label class="form-label">{{ __("view." . str_replace( 'ar_', '', $ar_transportations[0]['key'])) }}</label>
                                        <input type="text" name="{{$ar_transportations[0]['key']}}" class="form-control @error($ar_transportations[0]['key']) is-invalid @enderror" value="{{ $ar_transportations[0]['value'] }}">
                                        @error($ar_transportations[0]['key'])
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    @for ($i = 1; $i < count($ar_transportations) ; $i++)
                                            <div class="mb-3">
                                                <label class="form-label">{{ __("view.".str_replace('ar_', '', $ar_transportations[$i]['key'])) }}</label>
                                                <input type="text" name="{{$ar_transportations[$i]['key']}}" class="form-control @error($ar_transportations[$i]['key']) is-invalid @enderror" value="{{ $ar_transportations[$i]->value }}">
                                                @error($ar_transportations[$i]['key'])
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                    @endfor
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

            <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data" data-form class="card">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12">
                                    <div class="page-title">{{ __('view.enActivitiesTable') }}</div>
                                    <div class="mb-3">
                                        <label class="form-label">{{ __("view." . str_replace( 'en_', '', $en_activities[0]['key'])) }}</label>
                                        <input type="text" name="{{$en_activities[0]['key']}}" class="form-control @error($en_activities[0]['key']) is-invalid @enderror" value="{{ $en_activities[0]['value'] }}">
                                        @error($en_activities[0]['key'])
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    @for ($i = 1; $i < count($en_activities) ; $i++)
                                            <div class="mb-3">
                                                <label class="form-label">{{ __("view.".str_replace('en_', '', $en_activities[$i]['key'])) }}</label>
                                                <input type="text" name="{{$en_activities[$i]['key']}}" class="form-control @error($en_activities[$i]['key']) is-invalid @enderror" value="{{ $en_activities[$i]->value }}">
                                                @error($en_activities[$i]['key'])
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                    @endfor
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

            <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data" data-form class="card">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12">
                                        <div class="page-title">{{ __('view.arActivitiesTable') }}</div>
                                        <div class="mb-3">
                                            <label class="form-label">{{ __("view." . str_replace( 'ar_', '', $ar_activities[0]['key'])) }}</label>
                                            <input type="text" name="{{$ar_activities[0]['key']}}" class="form-control @error($ar_activities[0]['key']) is-invalid @enderror" value="{{ $ar_activities[0]['value'] }}">
                                            @error($ar_activities[0]['key'])
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        @for ($i = 1; $i < count($ar_activities) ; $i++)
                                            <div class="mb-3">
                                                <label class="form-label">{{ __("view.".str_replace('ar_', '', $ar_activities[$i]['key'])) }}</label>
                                                <input type="text" name="{{$ar_activities[$i]['key']}}" class="form-control @error($ar_activities[$i]['key']) is-invalid @enderror" value="{{ $ar_activities[$i]->value }}">
                                                @error($ar_activities[$i]['key'])
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        @endfor
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

            <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data" data-form class="card">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label class="form-label">{{ __("view." . str_replace('en_', '', $en_price->key)) }}</label>
                                        <input type="text" name="{{$en_price->key}}" class="form-control @error($en_price->key) is-invalid @enderror" value="{{ $en_price->value }}">
                                        @error($en_price->key)
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">{{ __("view." . str_replace('ar_', '', $ar_price->key)) }}</label>
                                        <input type="text" name="{{$ar_price->key}}" class="form-control @error($ar_price->key) is-invalid @enderror" value="{{ $ar_price->value }}">
                                        @error($ar_price->key)
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
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

            <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data" data-form class="card">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label class="form-label">{{ __("view." . str_replace('en_', '', $en_deposite->key)) }}</label>
                                        <input type="text" name="{{$en_deposite->key}}" class="form-control @error($en_deposite->key) is-invalid @enderror" value="{{ $en_deposite->value }}">
                                        @error($en_deposite->key)
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">{{ __("view." . str_replace('ar_', '', $ar_deposite->key)) }}</label>
                                        <input type="text" name="{{$ar_deposite->key}}" class="form-control @error($ar_deposite->key) is-invalid @enderror" value="{{ $ar_deposite->value }}">
                                        @error($ar_deposite->key)
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
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

            <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data" data-form class="card">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label class="form-label">{{ __("view." . str_replace('en_', '', $en_notes->key)) }}</label>
                                        <input type="text" name="{{$en_notes->key}}" class="form-control @error($en_notes->key) is-invalid @enderror" value="{{ $en_notes->value }}">
                                        @error($en_notes->key)
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">{{ __("view." . str_replace('ar_', '', $ar_notes->key)) }}</label>
                                        <input type="text" name="{{$ar_notes->key}}" class="form-control @error($ar_notes->key) is-invalid @enderror" value="{{ $ar_notes->value }}">
                                        @error($ar_notes->key)
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
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

            <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data" data-form class="card">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label class="form-label">{{ __("view." . str_replace('en_', '', $website_url->key)) }}</label>
                                        <input type="text" name="{{$website_url->key}}" class="form-control @error($website_url->key) is-invalid @enderror" value="{{ $website_url->value }}">
                                        @error($website_url->key)
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">{{ __("view." . str_replace('en_', '', $facebook->key)) }}</label>
                                        <input type="text" name="{{$facebook->key}}" class="form-control @error($facebook->key) is-invalid @enderror" value="{{ $facebook->value }}">
                                        @error($facebook->key)
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">{{ __("view." . str_replace('en_', '', $instagram->key)) }}</label>
                                        <input type="text" name="{{$instagram->key}}" class="form-control @error($instagram->key) is-invalid @enderror" value="{{ $instagram->value }}">
                                        @error($instagram->key)
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">{{ __("view." . str_replace('en_', '', $snapchat->key)) }}</label>
                                        <input type="text" name="{{$snapchat->key}}" class="form-control @error($snapchat->key) is-invalid @enderror" value="{{ $snapchat->value }}">
                                        @error($snapchat->key)
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">{{ __("view." . str_replace('en_', '', $twitter->key)) }}</label>
                                        <input type="text" name="{{$twitter->key}}" class="form-control @error($twitter->key) is-invalid @enderror" value="{{ $twitter->value }}">
                                        @error($twitter->key)
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
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
    $('[settings_tab]').addClass('active');
</script>
@endsection