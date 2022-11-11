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
                            {{ __("view.editFlight") }} {{ $flight->flight_id }}
                        </h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-body">
            <form action="{{ route('flight.update') }}" method="POST" data-form class="card">
                @csrf
                <input type="hidden" name="flight_id" value="{{ $flight->flight_id }}">
                <input type="hidden" name="hotels" value="{{ $flight->hotels }}">
                <input type="hidden" name="airports" value="{{ $flight->airports }}">
                <input type="hidden" name="activities" value="{{ $flight->activities }}">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12">

                                    <div class="mb-3">
                                        <label class="form-label">{{ __("view.flightId") }}</label>
                                        <input type="text" class="form-control" value="{{ $flight->flight_id }}">
                                    </div>

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
                                                    <input class="form-control" name="start_date" id="start_date" onkeypress="return /[]/i.test(event.key)" placeholder="Select a date" value="{{ $flight->start_date }}" />
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
                                                    <input class="form-control" name="end_date" id="end_date" onkeypress="return /[]/i.test(event.key)" placeholder="Select a date" value="{{ $flight->end_date }}" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Notes -->
                                    <div class="mb-3">
                                        <label class="form-label">{{ __('view.notes') }}</label>
                                        <textarea class="form-control" name="notes" rows="4">{{ $flight->notes }}</textarea>
                                    </div>

                                    <!-- Hotel Container -->
                                    <div class="mb-3" data-hotels-container>
                                        <!-- Title -->
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="page-title">{{ __('view.hotels') }}</div>
                                            <div>
                                                <a onclick="addHotel()" type="button" class="btn btn-facebook btn-sm">
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

                                        <!-- Hotel template -->
                                        <div data-hotel-template hidden class="mt-3 mb-3">
                                            <!-- buttons  -->
                                            <div style="margin: 25px 0">
                                                <a onclick="addHotel()" type="button" class="btn btn-facebook btn-sm">
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

                                            <!-- day -->
                                            <div class="mb-3">
                                                <label class="form-label">{{ __('view.day') }}</label>
                                                <input type="text" class="form-control" day></input>
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
                                                            <input class="form-control" start_date onkeypress="return /[]/i.test(event.key)" placeholder="Select a date" value="" />
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
                                                            <input class="form-control" end_date onkeypress="return /[]/i.test(event.key)" placeholder="Select a date" value="" />
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
                                    </div>

                                    <!-- Airports Container -->
                                    <div class="mb-3" data-airports-container>
                                        <!-- Title -->
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="page-title">{{ __('view.airports') }}</div>
                                            <div>
                                                <a onclick="addAirport()" type="button" class="btn btn-facebook btn-sm">
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

                                        <!-- Airport template -->
                                        <div data-airports-template hidden class="mt-3 mb-3">
                                            <!-- buttons  -->
                                            <div style="margin: 25px 0">
                                                <a onclick="addAirport()" type="button" class="btn btn-facebook btn-sm">
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

                                            <!-- day -->
                                            <div class="mb-3">
                                                <label class="form-label">{{ __('view.day') }}</label>
                                                <input type="text" class="form-control" day></input>
                                            </div>

                                            <!-- Date  -->
                                            <div class="mb-3">
                                                <div class="d-flex align-items-center">
                                                    <div class="w-50">
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
                                                            <input class="form-control" date onkeypress="return /[]/i.test(event.key)" placeholder="Select a date" value="" />
                                                        </div>
                                                    </div>
                                                    <div class="w-50">
                                                        <label class="form-label">{{ __('view.time') }}</label>
                                                        <input type="time" class="form-control" time />
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

                                            <!-- notes with the room -->
                                            <div class="mb-3">
                                                <label class="form-label">{{ __('view.notes') }}</label>
                                                <textarea class="form-control" notes rows="4"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Activities Container -->
                                    <div class="mb-3" data-activities-container>
                                        <!-- Title -->
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="page-title">{{ __('view.activities') }}</div>
                                            <div>
                                                <a onclick="addActivity()" type="button" class="btn btn-facebook btn-sm">
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

                                        <!-- Activity template -->
                                        <div data-activities-template hidden class="mt-3 mb-3">
                                            <!-- buttons  -->
                                            <div style="margin: 25px 0">
                                                <a onclick="addActivity()" type="button" class="btn btn-facebook btn-sm">
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

                                            <!-- day -->
                                            <div class="mb-3">
                                                <label class="form-label">{{ __('view.day') }}</label>
                                                <input type="text" class="form-control" day></input>
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
                                                        <input class="form-control" date onkeypress="return /[]/i.test(event.key)" placeholder="Select a date" value="" />
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

    const addHotel = (data = null) => {
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
                    JSON.parse(el['rooms']).forEach((el, i) => {
                        roomsSelect.append(`
                            <option value="${i+1}">${el.name}</option>
                        `);
                    });
                }
            });
        });

        template.find('select[hotel]').attr('id', hotel_id);
        template.find('select[room]').attr('id', room_id);
        $('[data-hotels-container]').append(template);
        if (data) {
            $('[data-hotels-container] [data-hotel]:last').find('input[day]').val(data.day);
            $('[data-hotels-container] [data-hotel]:last').find('input[start_date]').val(data.start_date);
            $('[data-hotels-container] [data-hotel]:last').find('input[end_date]').val(data.end_date);
            $('[data-hotels-container] [data-hotel]:last').find(`select[hotel] option[value=${data.hotel}]`).attr('selected', true).trigger('change');
            $('[data-hotels-container] [data-hotel]:last').find(`select[room] option[value=${+data.room}]`).attr('selected', true);
            $('[data-hotels-container] [data-hotel]:last').find('textarea[notes]').val(data.notes);
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

        var room_select;
        window.TomSelect && (new TomSelect(room_select = document.getElementById(`${room_id}`), {
            maxOptions: 5000,
            dropdownClass: 'dropdown-menu',
            optionClass: 'dropdown-item',
        }));

        if ($('body').hasClass('theme-dark')) $('[type=select-one]').css('color', '#fff');

        intailizeDate(startDateId);
        intailizeDate(endDateId);
    };

    const addAirport = (data = null) => {
        let dateId = "data_" + (Math.random() + 1).toString(36).substring(2);

        let template = $('[data-airports-template]').clone();
        template.removeAttr('data-airports-template hidden');
        template.attr('data-airport', true);
        template.find('[date]').attr('id', dateId);

        if (data) {
            template.find('input[day]').val(data.day);
            template.find('input[date]').val(data.date);
            template.find('input[time]').val(data.time);
            template.find('input[from]').val(data.from);
            template.find('input[to]').val(data.to);
            template.find('textarea[notes]').val(data.notes);
        }
        $('[data-airports-container]').append(template);
        intailizeDate(dateId);
    };

    const addActivity = (data = null) => {
        let dateId = "data_" + (Math.random() + 1).toString(36).substring(2);

        let template = $('[data-activities-template]').clone();
        template.removeAttr('data-activities-template hidden');
        template.attr('data-activity', true);
        template.find('[date]').attr('id', dateId);

        if (data) {
            template.find('input[day]').val(data.day);
            template.find('input[date]').val(data.date);
            template.find('input[from]').val(data.from);
            template.find('input[to]').val(data.to);
            template.find('textarea[notes]').val(data.notes);
        }
        $('[data-activities-container]').append(template);
        intailizeDate(dateId);
    };

    const removeItem = (target) => {
        $('[data-delete]').on('click', () => {
            $(target).parent().parent().remove();
        });
    };

    $('[data-form]').on('submit', (e) => {
        let validationError = false
        // Collect Hotels Data
        let hotels = [];
        $('[data-hotels-container] [data-hotel]').each((i, e) => {
            let day = $(e).find('input[day]').val();
            let start_date = $(e).find('input[start_date]').val();
            let end_date = $(e).find('input[end_date]').val();
            let hotel = $(e).find('select[hotel]').val();
            let room = $(e).find('select[room]').val();
            let notes = $(e).find('textarea[notes]').val().replace(/\n/g, "\\n");
            if (!day || !start_date || !end_date || !hotel || !room || !notes) {
                validationError = true;
                return;
            }
            let hotelObj = {
                day,
                start_date,
                end_date,
                hotel,
                room,
                notes,
            };
            hotels.push(hotelObj);
        });
        $('[name=hotels]').val(JSON.stringify(hotels));

        if (validationError) {
            e.preventDefault();
            return alert("{{ __('view.submitError') }}");
        }
        // Collect Airports Data
        let airports = [];
        $('[data-airports-container] [data-airport]').each((i, e) => {
            let day = $(e).find('input[day]').val();
            let date = $(e).find('input[date]').val();
            let time = $(e).find('input[time]').val();
            let from = $(e).find('input[from]').val();
            let to = $(e).find('input[to]').val();
            let notes = $(e).find('textarea[notes]').val().replace(/\n/g, "\\n");

            if (!day || !date || !from || !to || !notes) {
                validationError = true;
                return;
            }

            let airport = {
                day,
                date,
                time,
                from,
                to,
                notes
            };

            airports.push(airport);
        });
        $('input[name=airports]').val(JSON.stringify(airports));

        if (validationError) {
            e.preventDefault();
            return alert("{{ __('view.submitError') }}");
        }
        // Collect Airports Data
        let activities = [];
        $('[data-activities-container] [data-activity]').each((i, e) => {
            let day = $(e).find('input[day]').val();
            let date = $(e).find('input[date]').val();
            let from = $(e).find('input[from]').val();
            let to = $(e).find('input[to]').val();
            let notes = $(e).find('textarea[notes]').val().replace(/\n/g, "\\n");

            if (!day || !date || !from || !to || !notes) {
                validationError = true;
                return;
            }

            let activity = {
                day,
                date,
                from,
                to,
                notes
            };
            activities.push(activity);
        });
        $('input[name=activities]').val(JSON.stringify(activities));
        if (validationError) {
            e.preventDefault();
            return alert("{{ __('view.submitError') }}");
        }
    });
</script>

<script>
    $(() => {
        let hotels = JSON.parse('<?= $flight->hotels ?>');
        hotels.forEach((el) => {
            addHotel(el);
        });
        let airports = JSON.parse('<?= $flight->airports ?>');
        airports.forEach((el) => {
            addAirport(el);
        });

        let activities = JSON.parse('<?= $flight->activities ?>');
        activities.forEach((el) => {
            addActivity(el);
        });
    });
</script>

@endsection