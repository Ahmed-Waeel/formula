@extends('layouts.app')
@section('tabTitle', __("view.flights"))
@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h3 class="card-title">{{ __('view.flights') }}</h3>
            <a href="{{ route('flight.add') }}" class="btn btn-facebook btn-sm">
                <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <line x1="12" y1="5" x2="12" y2="19" />
                    <line x1="5" y1="12" x2="19" y2="12" />
                </svg>
                {{ __('view.addFlight') }}
            </a>
        </div>
        <form action="{{ route('flight.filter') }}" method="POST" id="form">
            @csrf
            <input type="hidden" name="page">
            <div class="card-body border-bottom py-3">
                <div class="d-flex">
                    <div class="text-muted">
                        {{ __('view.show') }}
                        <div class="mx-2 d-inline-block">
                            <select type="text" class="form-select" name="pagination" id="select-users" value="">

                                <option value="25" @if(isset($pagination) && $pagination=='25' || !isset($pagination)) selected @endif>25</option>
                                <option value="50" @if(isset($pagination) && $pagination=='50' ) selected @endif>50</option>
                                <option value="100" @if(isset($pagination) && $pagination=='100' ) selected @endif>100</option>
                                <option value="200" @if(isset($pagination) && $pagination=='200' ) selected @endif>200</option>
                            </select>
                        </div>
                        {{ __('view.entries') }}
                    </div>
                    <div class="ms-auto text-muted">
                        <div class="ms-2 d-flex align-items-center justify-content-between gap-2">
                            <label class="">{{ __('view.search') }}&nbsp;:&nbsp;</label>
                            <div class="d-inline-block" style="height: 100%">
                                <input type="text" @if(isset($data)) value="{{ $data }}" @endif name=data class="form-control form-control-sm" style="height: 100%">
                            </div>
                            <button type="submit" search-button class="btn btn-facebook btn-sm" style="height: 100%">
                                <!-- Download SVG icon from http://tabler-icons.io/i/search -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <circle cx="10" cy="10" r="7" />
                                    <line x1="21" y1="21" x2="15" y2="15" />
                                </svg>
                                {{ __('view.search') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="table-responsive">
            <table class="table card-table table-vcenter text-nowrap datatable">
                <thead>
                    <tr>
                        <th class="w-2">{{ __('view.flightId') }} </th>
                        <th class="w-2"> {{ __('view.startDate') }} </th>
                        <th class="w-2">{{ __('view.endDate') }} </th>
                        <th class="w-2">{{ __('view.actions') }} </th>
                    </tr>
                </thead>
                <tbody>
                    @if(!count($flights))
                    <tr>
                        <td style="height: 50px;text-align: center" colspan=5> {{ __('view.notAvailable') }} </td>
                    </tr>
                    @endif
                    @foreach($flights AS $flight)
                    <tr>
                        <td><span>{{ $flight->flight_id }}</span></td>
                        <td>{{ date('d/m/Y', strtotime($flight->start_date)) }}</td>
                        <td>{{ date('d/m/Y', strtotime($flight->end_date)) }}</td>
                        <td>
                            <span class="dropdown">
                                <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">{{ __('view.actions') }}</button>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="{{ route('flight.edit', $flight->flight_id) }}">
                                        <!-- Download SVG icon from http://tabler-icons.io/i/edit -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" />
                                            <path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" />
                                            <line x1="16" y1="5" x2="19" y2="8" />
                                        </svg>&nbsp;
                                        {{ __('view.edit') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('flight.delete', $flight->flight_id) }}">
                                        <!-- Download SVG icon from http://tabler-icons.io/i/trash -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <line x1="4" y1="7" x2="20" y2="7" />
                                            <line x1="10" y1="11" x2="10" y2="17" />
                                            <line x1="14" y1="11" x2="14" y2="17" />
                                            <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                            <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                        </svg>&nbsp;
                                        {{ __('view.delete') }}
                                    </a>
                                </div>
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $flights->links('vendor.pagination.custom')}}
    </div>
</div>
<script>
    $('[flights_tab]').addClass('active');
    $('#form').on('submit', function(event) {
        if (!$('[name=data]').val()) {
            alert("{{ __('view.searchError') }}");
            event.preventDefault();
        }
    });

    $('select[name=pagination]').on('change', function() {
        $('#form').off('submit').submit();
    });

    $('.pagination a').on('click', function(event) {
        event.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        $('[name=page]').val(page);
        $('#form').off('submit').submit();
    });
</script>
@endsection