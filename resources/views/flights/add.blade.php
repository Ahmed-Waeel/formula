@extends('layouts.app')
@section('tabTitle', __("view.addFlight"))
@section('content')
<div class="wrapper">
    <div class="page-wrapper">
        <div class="container-xl">
            <!-- Page title -->
            <div class="page-header d-print-none">
                <div class="row align-items-center">
                    <div class="col">
                        <h2 class="page-title">
                            {{ __("view.addFlight") }}
                        </h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-body">
            <form action="{{ route('flight.store') }}" method="POST" data-form class="card">
                @csrf
                <input type="hidden" name="options">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12">

                                    <!-- Start & End Date  -->
                                    <div class="mb-3">
                                        <div class="d-flex align-items-center">
                                            <div class="w-50">
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
                                                    <input class="form-control" name="start_date" id="start_date" placeholder="Select a date" value="" />
                                                </div>
                                            </div>
                                            <div class="w-50">
                                                <label class="form-label">{{ __('view.endDate') }}</label>
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
                                                    <input class="form-control" name="end_date" id="end_date" placeholder="Select a date" value="" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- to -->
                                    <div class="mb-3">
                                        <label class="form-label">{{ __('view.flightTo') }}</label>
                                        <textarea class="form-control" name="flight_to" rows="4"></textarea>
                                    </div>

                                    <!-- Notes -->
                                    <div class="mb-3">
                                        <label class="form-label">{{ __('view.notes') }}</label>
                                        <textarea class="form-control" name="notes" rows="4"></textarea>
                                    </div>

                                    <!-- Day Component -->
                                    <div day-component>
                                        <!-- Title -->
                                        <div class="d-flex align-items-center justify-content-between" style="margin-bottom: 25px">
                                            <div class="page-title">{{ __('view.days') }}</div>
                                            <div>
                                                <a onclick="addDay()" type="button" class="btn btn-facebook btn-sm">
                                                    <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <line x1="12" y1="5" x2="12" y2="19" />
                                                        <line x1="5" y1="12" x2="19" y2="12" />
                                                    </svg>
                                                    {{ __('view.addDay') }}
                                                </a>
                                            </div>
                                        </div>
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
<!-- Day Template -->
<div data-days-template hidden style="margin-top: 15px">
    <a onclick="removeDay(this)" style="margin-bottom: 15px" type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete-modal">
        <!-- Download SVG icon from http://tabler-icons.io/i/x -->
        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <line x1="18" y1="6" x2="6" y2="18" />
            <line x1="6" y1="6" x2="18" y2="18" />
        </svg>
        {{ __('view.delete') }}
    </a>

    <!-- day -->
    <div class="mb-3">
        <label class="form-label">{{ __('view.day') }}</label>
        <input type="text" class="form-control" day></input>
    </div>

    <!-- Hotel Container -->
    <div class="mb-3" data-hotels-container>
        <!-- Title -->
        <div class="d-flex align-items-center justify-content-between">
            <div class="page-title">{{ __('view.hotels') }}</div>
            <div>
                <a onclick="addHotel(this)" add-hotel type="button" class="btn btn-facebook btn-sm">
                    <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <line x1="12" y1="5" x2="12" y2="19" />
                        <line x1="5" y1="12" x2="19" y2="12" />
                    </svg>
                    {{ __('view.addHotel') }}
                </a>
            </div>
        </div>
    </div>

    <!-- Airports Container -->
    <div class="mb-3" data-airports-container>
        <!-- Title -->
        <div class="d-flex align-items-center justify-content-between">
            <div class="page-title">{{ __('view.airports') }}</div>
            <div>
                <a onclick="addAirport(this)" add-airport type="button" class="btn btn-facebook btn-sm">
                    <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <line x1="12" y1="5" x2="12" y2="19" />
                        <line x1="5" y1="12" x2="19" y2="12" />
                    </svg>
                    {{ __('view.addAirport') }}
                </a>
            </div>
        </div>
    </div>

    <!-- transportations Container -->
    <div class="mb-3" data-transportations-container>
        <!-- Title -->
        <div class="d-flex align-items-center justify-content-between">
            <div class="page-title">{{ __('view.transportations') }}</div>
            <div>
                <a onclick="addTranspotaion(this)" add-transportation type="button" class="btn btn-facebook btn-sm">
                    <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <line x1="12" y1="5" x2="12" y2="19" />
                        <line x1="5" y1="12" x2="19" y2="12" />
                    </svg>
                    {{ __('view.addTranspotaion') }}
                </a>
            </div>
        </div>
    </div>

    <!-- Activities Container -->
    <div class="mb-3" data-activities-container>
        <!-- Title -->
        <div class="d-flex align-items-center justify-content-between">
            <div class="page-title">{{ __('view.activities') }}</div>
            <div>
                <a onclick="addActivity(this)" add-activity type="button" class="btn btn-facebook btn-sm">
                    <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <line x1="12" y1="5" x2="12" y2="19" />
                        <line x1="5" y1="12" x2="19" y2="12" />
                    </svg>
                    {{ __('view.addActivity') }}
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Hotel template -->
<div data-hotel-template hidden class="mt-3 mb-3">
    <div>
        <!-- buttons  -->
        <div style="margin: 25px 0">
            <a onclick="addHotel(this)" type="button" class="btn btn-facebook btn-sm">
                <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <line x1="12" y1="5" x2="12" y2="19" />
                    <line x1="5" y1="12" x2="19" y2="12" />
                </svg>
                {{ __('view.addHotel') }}
            </a>

            <a onclick="removeItem(this)" type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete-modal">
                <!-- Download SVG icon from http://tabler-icons.io/i/x -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <line x1="18" y1="6" x2="6" y2="18" />
                    <line x1="6" y1="6" x2="18" y2="18" />
                </svg>
                {{ __('view.delete') }}
            </a>
        </div>
    </div>

    <!-- Date  -->
    <div class="mb-3">
        <div class="d-flex align-items-center">
            <div class="w-50">
                <label class="form-label">{{ __('view.enterDate') }}</label>
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
                    <input class="form-control" start_date placeholder="Select a date" value="" />
                </div>
            </div>
            <div class="w-50">
                <label class="form-label">{{ __('view.exitDate') }}</label>
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
                    <input class="form-control" end_date placeholder="Select a date" value="" />
                </div>
            </div>
        </div>
    </div>

    <!-- Hotel -->
    <div class="mb-3">
        <label class="form-label">{{ __('view.hotel') }}</label>
        <select hotel class="form-select">
            <option value="" hidden>{{ __('view.selectOption') }}</option>
            @foreach($hotels As $hotel)
            <option value="{{ $hotel->id }}">{{ $hotel->name }}</option>
            @endforeach
        </select>
    </div>

    <!-- Room -->
    <div class="mb-3">
        <label class="form-label">{{ __('view.room') }}</label>
        <select room class="form-select">
            <option value="" hidden>{{ __('view.selectOption') }}</option>
        </select>
    </div>

    <!-- notes -->
    <div class="mb-3">
        <label class="form-label">{{ __('view.notes') }}</label>
        <textarea class="form-control" notes rows="4"></textarea>
    </div>
</div>

<!-- Airport template -->
<div data-airports-template hidden class="mt-3 mb-3">
    <div>
        <!-- buttons  -->
        <div style="margin: 25px 0">
            <a onclick="addAirport(this)" type="button" class="btn btn-facebook btn-sm">
                <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <line x1="12" y1="5" x2="12" y2="19" />
                    <line x1="5" y1="12" x2="19" y2="12" />
                </svg>
                {{ __('view.addAirport') }}
            </a>

            <a onclick="removeItem(this)" type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete-modal">
                <!-- Download SVG icon from http://tabler-icons.io/i/x -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <line x1="18" y1="6" x2="6" y2="18" />
                    <line x1="6" y1="6" x2="18" y2="18" />
                </svg>
                {{ __('view.delete') }}
            </a>
        </div>
    </div>

    <!-- Date  -->
    <div class="mb-3">
        <div class="d-flex align-items-center">
            <div class="w-100">
                <label class="form-label">{{ __('view.date') }}</label>
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
                    <input class="form-control" date placeholder="Select a date" value="" />
                </div>
            </div>
        </div>
    </div>

    <!-- Time -->
    <div class="mb-3">
        <div class="d-flex align-items-center">
            <div class="w-50">
                <label class="form-label">{{ __('view.from') }}</label>
                <input type="time" class="form-control" time_from />
            </div>
            <div class="w-50">
                <label class="form-label">{{ __('view.to') }}</label>
                <input type="time" class="form-control" time_to />
            </div>
        </div>
    </div>

    <!-- From {Airport} To {Airport} -->
    <div class="mb-3">
        <div class="d-flex align-items-center">
            <div class="w-50">
                <label class="form-label">{{ __('view.from') }}</label>
                <input type="text" from class="form-control">
            </div>
            <div class="w-50">
                <label class="form-label">{{ __('view.to') }}</label>
                <input type="text" to class="form-control">
            </div>
        </div>
    </div>

    <!-- {company}  {flight Number} -->
    <div class="mb-3">
        <div class="d-flex align-items-center">
            <div class="w-50">
                <label class="form-label">{{ __('view.company') }}</label>
                <input type="text" company class="form-control">
            </div>
            <div class="w-50">
                <label class="form-label">{{ __('view.flightNumber') }}</label>
                <input type="text" flight_number class="form-control">
            </div>
        </div>
    </div>

    <!-- notes with the room -->
    <div class="mb-3">
        <label class="form-label">{{ __('view.notes') }}</label>
        <textarea class="form-control" notes rows="4"></textarea>
    </div>
</div>

<!-- Transportation template -->
<div data-transportations-template hidden class="mt-3 mb-3">
    <div>
        <div style="margin: 25px 0">
            <a onclick="addTranspotaion(this)" type="button" class="btn btn-facebook btn-sm">
                <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <line x1="12" y1="5" x2="12" y2="19" />
                    <line x1="5" y1="12" x2="19" y2="12" />
                </svg>
                {{ __('view.addTranspotaion') }}
            </a>

            <a onclick="removeItem(this)" type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete-modal">
                <!-- Download SVG icon from http://tabler-icons.io/i/x -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <line x1="18" y1="6" x2="6" y2="18" />
                    <line x1="6" y1="6" x2="18" y2="18" />
                </svg>
                {{ __('view.delete') }}
            </a>
        </div>
    </div><!-- buttons  -->

    <!-- Date  -->
    <div class="mb-3">
        <div class="w-100">
            <label class="form-label">{{ __('view.date') }}</label>
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
                <input class="form-control" date placeholder="Select a date" value="" />
            </div>
        </div>
    </div>

    <!-- From {Place} To {Another Place} -->
    <div class="mb-3">
        <div class="d-flex align-items-center">
            <div class="w-50">
                <label class="form-label">{{ __('view.from') }}</label>
                <input type="text" from class="form-control">
            </div>
            <div class="w-50">
                <label class="form-label">{{ __('view.to') }}</label>
                <input type="text" to class="form-control">
            </div>
        </div>
    </div>

    <!-- notes with the room -->
    <div class="mb-3">
        <label class="form-label">{{ __('view.notes') }}</label>
        <textarea class="form-control" notes rows="4"></textarea>
    </div>
</div>

<!-- activities template -->
<div data-activities-template hidden class="mt-3 mb-3">
    <div>
        <!-- buttons  -->
        <div style="margin: 25px 0">
            <a onclick="addActivity(this)" type="button" class="btn btn-facebook btn-sm">
                <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <line x1="12" y1="5" x2="12" y2="19" />
                    <line x1="5" y1="12" x2="19" y2="12" />
                </svg>
                {{ __('view.addActivity') }}
            </a>

            <a onclick="removeItem(this)" type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete-modal">
                <!-- Download SVG icon from http://tabler-icons.io/i/x -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <line x1="18" y1="6" x2="6" y2="18" />
                    <line x1="6" y1="6" x2="18" y2="18" />
                </svg>
                {{ __('view.delete') }}
            </a>
        </div>
    </div>

    <!-- Date  -->
    <div class="mb-3">
        <div class="w-100">
            <label class="form-label">{{ __('view.date') }}</label>
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
                <input class="form-control" date placeholder="Select a date" value="" />
            </div>
        </div>
    </div>

    <!-- Activity -->
    <div class="mb-3">
        <label class="form-label">{{ __('view.activity') }}</label>
        <select activity class="form-select">
            <option value="" hidden>{{ __('view.selectOption') }}</option>
            @foreach($activities As $activity)
            <option value="{{ $activity->id }}">{{ $activity->name }}</option>
            @endforeach
        </select>
    </div>

    <!-- description -->
    <div class="mb-3">
        <label class="form-label">{{ __('view.description') }}</label>
        <textarea class="form-control" description rows="4"></textarea>
    </div>

    <!-- notes -->
    <div class="mb-3">
        <label class="form-label">{{ __('view.notes') }}</label>
        <textarea class="form-control" notes rows="4"></textarea>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal modal-blur fade" id="delete-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-title">{{ __('view.delete') }}</div>
                <div>{{ __('view.deleteMessage') }}</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link link-secondary me-auto" data-bs-dismiss="modal">{{ __('view.cancel') }}</button>
                <button data-delete type="button" class="btn btn-danger" data-bs-dismiss="modal">{{ __('view.delete') }}</button>
            </div>
        </div>
    </div>
</div>

<!-- Libs JS -->
<script src="{{ asset('libs/litepicker/dist/litepicker.js') }}"></script>
<script src="{{ asset('libs/tom-select/dist/js/tom-select.base.min.js') }}"></script>
<script>
    const hotels = <?= $hotels ?>;
    $(() => {
        intailizeDate('start_date');
        intailizeDate('end_date');
    });

    $('[flights_tab]').addClass('active');

    // Intailize the plugin For date
    const intailizeDate = (target) => {
        window.Litepicker && (new Litepicker({
            element: document.getElementById(target),
            buttonText: {
                previousMonth: `<!-- Download SVG icon from http://tabler-icons.io/i/chevron-left -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="15 6 9 12 15 18" /></svg>`,
                nextMonth: `<!-- Download SVG icon from http://tabler-icons.io/i/chevron-right -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="9 6 15 12 9 18" /></svg>`,
            },
        }));
    }

    const addDay = (data = null) => {
        const template = $('[data-days-template]').clone();

        template.removeAttr("data-days-template hidden").attr('data-day', true);

        if (data) template.find('[day]').val(data.day)
        $('[day-component]').append(template);
    };

    const addHotel = (target = null, data = null) => {
        const hotel_id = "select_hotel_" + (Math.random() + 1).toString(36).substring(2);
        const room_id = "select_room_" + (Math.random() + 1).toString(36).substring(2);
        let startDateId = "start_data_" + (Math.random() + 1).toString(36).substring(2);
        let endDateId = "end_date_" + (Math.random() + 1).toString(36).substring(2);

        let template = $('[data-hotel-template]').clone();
        template.find('[start_date]').attr('id', startDateId);
        template.find('[end_date]').attr('id', endDateId);
        template.removeAttr('data-hotel-template hidden');
        template.attr('data-hotel', true);
        template.find('select[hotel]').on('change', ({
            target
        }) => {
            const roomsSelect = template.find('select[room]');
            hotels.forEach((el, i) => {
                if (el.id == $(target).val()) {
                    roomsSelect.html('');
                    JSON.parse(el['rooms']).forEach((room, i) => {
                        roomsSelect.append(`
                            <option value='${i+1}'>${room.name}</option>
                        `);
                    });
                }
            });
        });
        template.find('select[hotel]').attr('id', hotel_id);
        template.find('select[room]').attr('id', room_id);
        if (data) {
            template.find('input[start_date]').val(data.start_date);
            template.find('input[end_date]').val(data.end_date);
            template.find(`select[hotel] option[value=${data.hotel}]`).attr('selected', true).trigger('change');
            template.find(`select[room] option[value=${data.room}]`).attr('selected', true);
            template.find('textarea[notes]').val(data.notes);
        }
        if (target) {
            $(target).closest('[data-day]').find('[data-hotels-container]').append(template);
        } else {
            $('[data-hotels-container]').append(template);
        }

        var hotel_select;
        window.TomSelect && (new TomSelect(hotel_select = document.getElementById(`${hotel_id}`), {
            maxOptions: 5000,
            searchField: 'name',
            valueField: 'id',
            labelField: 'name',
            dropdownClass: 'dropdown-menu',
            optionClass: 'dropdown-item',
        }));

        if ($('body').hasClass('theme-dark')) $('[type=select-one]').css('color', '#fff');

        intailizeDate(startDateId);
        intailizeDate(endDateId);
    };

    const addAirport = (target = null, data = null) => {
        let dateId = "data_" + (Math.random() + 1).toString(36).substring(2);

        let template = $('[data-airports-template]').clone();
        template.removeAttr('data-airports-template hidden');
        template.attr('data-airport', true);
        template.find('[date]').attr('id', dateId);

        if (data) {
            console.log(data);
            template.find('input[date]').val(data.date);
            template.find('input[time_from]').val(data.time_from);
            template.find('input[time_to]').val(data.time_to);
            template.find('input[from]').val(data.from);
            template.find('input[to]').val(data.to);
            template.find('input[company]').val(data.compnay);
            template.find('input[flight_number]').val(data.flight_number);
            template.find('textarea[notes]').val(data.notes);
        }
        if (target) {
            $(target).closest('[data-day]').find('[data-airports-container]').append(template);
        } else {
            $('[data-airports-container]').append(template);
        }
        intailizeDate(dateId);
    };

    const addTranspotaion = (target = null, data = null) => {
        let dateId = "data_" + (Math.random() + 1).toString(36).substring(2);

        let template = $('[data-transportations-template]').clone();
        template.removeAttr('data-transportations-template hidden');
        template.attr('data-transportation', true);
        template.find('[date]').attr('id', dateId);

        if (data) {
            console.log(data);
            template.find('input[date]').val(data.date);
            template.find('input[from]').val(data.from);
            template.find('input[to]').val(data.to);
            template.find('textarea[notes]').val(data.notes);
        }
        if (target) {
            $(target).closest('[data-day]').find('[data-transportations-container]').append(template);
        } else {
            $('[data-transportations-container]').append(template);
        }
        intailizeDate(dateId);
    };

    const addActivity = (target = null, data = null) => {
        let dateId = "date_" + (Math.random() + 1).toString(36).substring(2);
        let activity_id = "activity_" + (Math.random() + 1).toString(36).substring(2);

        let template = $('[data-activities-template]').clone();
        template.find('[date]').attr('id', dateId);
        template.find('select[activity]').attr('id', activity_id);
        template.removeAttr('data-activities-template hidden');
        template.attr('data-activity', true);

        if (data) {
            console.log(data);
            template.find('input[date]').val(data.date);
            template.find(`select[activity] option[value=${data.activity}]`).attr('selected', true);
            template.find('textarea[description]').val(data.description);
            template.find('textarea[notes]').val(data.notes);
        }
        if (target) {
            $(target).closest('[data-day]').find('[data-activities-container]').append(template);
        } else {
            $('[data-activities-container]').append(template);
        }

        var activity_select;
        window.TomSelect && (new TomSelect(activity_select = document.getElementById(`${activity_id}`), {
            maxOptions: 5000,
            searchField: 'name',
            valueField: 'id',
            labelField: 'name',
            dropdownClass: 'dropdown-menu',
            optionClass: 'dropdown-item',
        }));

        if ($('body').hasClass('theme-dark')) $('[type=select-one]').css('color', '#fff');

        intailizeDate(dateId);
    };

    const removeItem = (target) => {
        $('[data-delete]').on('click', () => {
            $(target).parent().parent().parent().remove();
        });
    };

    const removeDay = (target) => {
        $('[data-delete]').on('click', () => {
            $(target).parent().remove();
        });
    }

    /*
        {
            day1:{
                hotels: [{}, {}, {}],
                activities: [{}, {}, {}],
                airports: [{}, {}, {}],
                transportations: [{}, {}, {}],
            },
            day2:{
                hotels: [{}, {}, {}],
                activities: [{}, {}, {}],
                airports: [{}, {}, {}],
                transportations: [{}, {}, {}],
            },
        }
    */

    // const ahmed = () => {
    //     let validationError = false

    //     let days = {};
    //     $('[day-component] [data-day]').each((i, e) => {
    //         let day = {};
    //         day['day'] = $(e).find(`[day]`).val();
    //         if (!day['day']) validationError = true;

    //         if (validationError) {
    //             // e.preventDefault();
    //             return alert("{{ __('view.submitError') }}");
    //         }

    //         // Collect Hotels Data
    //         let hotels = [];
    //         $(e).find(`[data-hotels-container] [data-hotel]`).each((i, e) => {
    //             let start_date = $(e).find('input[start_date]').val();
    //             let end_date = $(e).find('input[end_date]').val();
    //             let hotel = $(e).find('select[hotel]').val();
    //             let room = $(e).find('select[room]').val();
    //             let notes = $(e).find('textarea[notes]').val().replace(/\n/g, "\\n");
    //             if (!start_date || !end_date || !hotel || !room || !notes) {
    //                 validationError = true;
    //                 return;
    //             }
    //             let hotelObj = {
    //                 start_date,
    //                 end_date,
    //                 hotel,
    //                 room,
    //                 notes,
    //             };
    //             hotels.push(hotelObj);
    //         });
    //         if (validationError) {
    //             // e.preventDefault();
    //             return alert("{{ __('view.submitError') }}");
    //         }

    //         day['hotels'] = hotels;

    //         // Collect activities Data
    //         let activities = [];
    //         $(e).find(`[data-activities-container] [data-activity]`).each((i, e) => {
    //             let date = $(e).find('input[date]').val();
    //             let activity = $(e).find('select[activity]').val();
    //             let notes = $(e).find('textarea[notes]').val().replace(/\n/g, "\\n");
    //             if (!date || !activity || !notes) {
    //                 validationError = true;
    //                 return;
    //             }
    //             let activityObj = {
    //                 date,
    //                 activity,
    //                 notes,
    //             };
    //             activities.push(activityObj);
    //         });
    //         if (validationError) {
    //             // e.preventDefault();
    //             return alert("{{ __('view.submitError') }}");
    //         }

    //         day['activities'] = activities;

    //         // Collect Airports Data
    //         let airports = [];
    //         $(e).find(`[data-airports-container] [data-airport]`).each((i, e) => {
    //             let date = $(e).find('input[date]').val();
    //             let time = $(e).find('input[time]').val();
    //             let from = $(e).find('input[from]').val();
    //             let to = $(e).find('input[to]').val();
    //             let notes = $(e).find('textarea[notes]').val().replace(/\n/g, "\\n");

    //             if (!date || !from || !to || !notes) {
    //                 validationError = true;
    //                 return;
    //             }

    //             let airport = {
    //                 date,
    //                 time,
    //                 from,
    //                 to,
    //                 notes
    //             };

    //             airports.push(airport);
    //         });
    //         if (validationError) {
    //             // e.preventDefault();
    //             return alert("{{ __('view.submitError') }}");
    //         }

    //         day['airports'] = airports;

    //         // Collect Transportations Data
    //         let transportations = [];
    //         $(e).find(`[data-transportations-container] [data-transportation]`).each((i, e) => {
    //             let date = $(e).find('input[date]').val();
    //             let from = $(e).find('input[from]').val();
    //             let to = $(e).find('input[to]').val();
    //             let notes = $(e).find('textarea[notes]').val().replace(/\n/g, "\\n");

    //             if (!date || !from || !to || !notes) {
    //                 validationError = true;
    //                 return;
    //             }

    //             let Transportation = {
    //                 date,
    //                 from,
    //                 to,
    //                 notes
    //             };
    //             transportations.push(Transportation);
    //         });
    //         if (validationError) {
    //             // e.preventDefault();
    //             return alert("{{ __('view.submitError') }}");
    //         }

    //         day['transportations'] = transportations;

    //         days[i] = day;
    //     });
    //     $('[name=options]').val(JSON.stringify(days));
    //     console.log(days);
    //     return days;
    // }

    $('[data-form]').on('submit', (e) => {
        let validationError = false

        let days = {};
        $('[day-component] [data-day]').each((i, e) => {
            let day = {};
            day['day'] = $(e).find(`[day]`).val();
            if (!day['day']) validationError = true;

            if (validationError) {
                e.preventDefault();
                return alert("{{ __('view.submitError') }}");
            }

            // Collect Hotels Data
            let hotels = [];
            $(e).find(`[data-hotels-container] [data-hotel]`).each((i, e) => {
                let start_date = $(e).find('input[start_date]').val();
                let end_date = $(e).find('input[end_date]').val();
                let hotel = $(e).find('select[hotel]').val();
                let room = $(e).find('select[room]').val();
                let notes = $(e).find('textarea[notes]').val().replace(/\n/g, "\\n");
                if (!start_date || !end_date || !hotel || !room || !notes) {
                    validationError = true;
                    return;
                }
                let hotelObj = {
                    start_date,
                    end_date,
                    hotel,
                    room,
                    notes,
                };
                hotels.push(hotelObj);
            });
            if (validationError) {
                e.preventDefault();
                return alert("{{ __('view.submitError') }}");
            }

            day['hotels'] = hotels;

            // Collect activities Data
            let activities = [];
            $(e).find(`[data-activities-container] [data-activity]`).each((i, e) => {
                let date = $(e).find('input[date]').val();
                let activity = $(e).find('select[activity]').val();
                let description = $(e).find('textarea[description]').val().replace(/\n/g, "\\n");
                let notes = $(e).find('textarea[notes]').val().replace(/\n/g, "\\n");
                if (!date || !activity || !notes || !description) {
                    validationError = true;
                    return;
                }
                let activityObj = {
                    date,
                    activity,
                    description,
                    notes,
                };
                activities.push(activityObj);
            });
            if (validationError) {
                e.preventDefault();
                return alert("{{ __('view.submitError') }}");
            }

            day['activities'] = activities;

            // Collect Airports Data
            let airports = [];
            $(e).find(`[data-airports-container] [data-airport]`).each((i, e) => {
                let date = $(e).find('input[date]').val();
                let time_from = $(e).find('input[time_from]').val();
                let time_to = $(e).find('input[time_to]').val();
                let from = $(e).find('input[from]').val();
                let to = $(e).find('input[to]').val();
                let company = $(e).find('input[company]').val();
                let flight_number = $(e).find('input[flight_number]').val();
                let notes = $(e).find('textarea[notes]').val().replace(/\n/g, "\\n");

                if (!date || !time_from || !time_to || !from || !to || !notes || !company || !flight_number) {
                    validationError = true;
                    return;
                }

                let airport = {
                    date,
                    time_from,
                    time_to,
                    from,
                    to,
                    company,
                    flight_number,
                    notes
                };

                airports.push(airport);
            });
            if (validationError) {
                e.preventDefault();
                return alert("{{ __('view.submitError') }}");
            }

            day['airports'] = airports;

            // Collect Transportations Data
            let transportations = [];
            $(e).find(`[data-transportations-container] [data-Transportation]`).each((i, e) => {
                let date = $(e).find('input[date]').val();
                let from = $(e).find('input[from]').val();
                let to = $(e).find('input[to]').val();
                let notes = $(e).find('textarea[notes]').val().replace(/\n/g, "\\n");

                if (!date || !from || !to || !notes) {
                    validationError = true;
                    return;
                }

                let Transportation = {
                    date,
                    from,
                    to,
                    notes
                };
                transportations.push(Transportation);
            });
            if (validationError) {
                e.preventDefault();
                return alert("{{ __('view.submitError') }}");
            }

            day['transportations'] = transportations;

            days[i] = day;
        });
        $('[name=options]').val(JSON.stringify(days));
    });
</script>

@if(old('options'))
<script>
    $(() => {
        let options = JSON.parse(JSON.stringify(<?= old('options') ?>));
        $.each(options, (i, day) => {
            console.log(day);
            addDay(day);
            const dayElement = $('[data-day]').last();
            const hotelElement = dayElement.find('[add-hotel]');
            const airportElement = dayElement.find('[add-airport]');
            const transportationElement = dayElement.find('[add-transportation]');
            const activityElement = dayElement.find('[add-activity]');

            const hotels = day.hotels;
            const airports = day.airports;
            const transportations = day.transportations;
            const activities = day.activities;

            $.each(hotels, (i, el) => {
                addHotel(hotelElement, el);
            });
            $.each(airports, (i, el) => {
                addAirport(airportElement, el);
            });
            $.each(transportations, (i, el) => {
                addTranspotaion(transportationElement, el);
            });
            $.each(activities, (i, el) => {
                addActivity(activityElement, el);
            });
        });
    });
</script>
@endif
@endsection