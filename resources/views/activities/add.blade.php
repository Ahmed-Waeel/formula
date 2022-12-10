@extends('layouts.app')
@section('tabTitle', __("view.addActivity"))
@section('content')
<div class="wrapper">
    <div class="page-wrapper">
        <div class="container-xl">
            <!-- Page title -->
            <div class="page-header d-print-none">
                <div class="row align-items-center">
                    <div class="col">
                        <h2 class="page-title">
                            {{ __("view.addActivity") }}
                        </h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-body">
            <form action="{{ route('activity.store') }}" method="POST" enctype="multipart/form-data" data-form class="card">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label class="form-label">{{ __("view.title") }}</label>
                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                                        @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">{{ __('view.country') }}</label>
                                        <select type="text" name="country" class="form-select @error('country') is-invalid @enderror" id="select-countries">
                                            @foreach($countries AS $country)
                                                <option value="{{ $country->code }}" @if($country->code == old('country')) selected @endif data-custom-properties=" &lt;span class=&quot;flag flag-xs flag-country-{{ $country->code }}&quot;&gt;&lt;/span&gt;">{{ $country->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('country')
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

<script src="{{ asset('libs/tom-select/dist/js/tom-select.base.min.js') }}"></script>
<script>
    $('[activities_tab]').addClass('active');

        document.addEventListener("DOMContentLoaded", function() {
        var el;
        window.TomSelect && (new TomSelect(el = document.getElementById('select-countries'), {
            maxOptions: 5000,
            searchField: 'name',
            valueField: 'code',
            labelField: 'name',
            dropdownClass: 'dropdown-menu',
            optionClass: 'dropdown-item',
            render: {
                item: function(data, escape) {
                    if (data.customProperties) {
                        return '<div><span class="dropdown-item-indicator">' + data.customProperties + '</span>' + escape(data.name) + '</div>';
                    }
                    return '<div>' + escape(data.text) + '</div>';
                },
                option: function(data, escape) {
                    if (data.customProperties) {
                        return '<div><span class="dropdown-item-indicator">' + data.customProperties + '</span>' + escape(data.name) + '</div>';
                    }
                    return '<div>' + escape(data.text) + '</div>';
                },
            },
        }));
    });
</script>
@endsection