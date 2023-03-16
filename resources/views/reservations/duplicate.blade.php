@extends('layouts.app')
@section('tabTitle', __("view.duplicateReservation"))
@section('content')
<div class="wrapper">
    <div class="page-wrapper">
        <div class="container-xl">
            <!-- Page title -->
            <div class="page-header d-print-none">
                <div class="row align-items-center">
                    <div class="col">
                        <h2 class="page-title">
                            {{ __("view.duplicateReservation") }}
                        </h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-body">
            <form action="{{ route('reservation.duplicate.submit') }}" method="POST" data-form class="card">
                @csrf
                <input type="hidden" name="reservation_id" value="{{$reservation_id}}">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label class="form-label">{{ __('view.customer') }}</label>
                                        <select name="customer_id" class="form-select @error('customer_id') is-invalid @enderror" id="select_customer">
                                            <option value="" selected></option>
                                            @foreach($customers AS $customer)
                                            <option value="{{ $customer->customer_id }}" @if($customer->customer_id == old('customer_id')) selected @endif>{{ $customer->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('customer_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">{{ __('view.startDate') }}</label>
                                        <div class="input-icon">
                                            <span class="input-icon-addon">
                                                <!-- Download SVG icon from http://tabler-icons.io/i/calendar -->
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <rect x="4" y="5" width="16" height="16" rx="2" />
                                                    <line x1="16" y1="3" x2="16" y2="7" />
                                                    <line x1="8" y1="3" x2="8" y2="7" />
                                                    <line x1="4" y1="11" x2="20" y2="11" />
                                                    <line x1="11" y1="15" x2="12" y2="15" />
                                                    <line x1="12" y1="15" x2="12" y2="18" />
                                                </svg>
                                            </span>
                                            <input class="form-control" name="date" id="date" placeholder="Select a date" value="" />
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
<!-- Libs JS -->
<script src="{{ asset('libs/litepicker/dist/litepicker.js') }}"></script>
<script src="{{ asset('libs/tom-select/dist/js/tom-select.base.min.js') }}"></script>
<script>
    $('[reservations_tab]').addClass('active');
    const customers = <?= $customers ?>;

    window.Litepicker && (new Litepicker({
        element: document.getElementById("date"),
        buttonText: {
            previousMonth: `<!-- Download SVG icon from http://tabler-icons.io/i/chevron-left -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="15 6 9 12 15 18" /></svg>`,
            nextMonth: `<!-- Download SVG icon from http://tabler-icons.io/i/chevron-right -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="9 6 15 12 9 18" /></svg>`,
        },
    }));

    document.addEventListener("DOMContentLoaded", function() {
        var el;
        new TomSelect(el = document.getElementById('select_customer'), {
            searchField: ['name', 'customer_id', 'email'],
            valueField: 'customer_id',
            labelField: 'name',
            options: customers,
            maxOptions: 1000000,
            dropdownClass: 'dropdown-menu',
            optionClass: 'dropdown-item',
        });
    });

    $(() => {
        if ($('body').hasClass('theme-dark')) $('[type=select-one]').css('color', '#fff');
    });
</script>
@endsection