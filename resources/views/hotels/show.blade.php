@extends('layouts.app')
@section('tabTitle', __("view.hotelsAndRooms"))
@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h3 class="card-title">{{ __('view.hotels') }}</h3>
            <a href="{{ route('hotel.add') }}" class="btn btn-facebook btn-sm">
                <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <line x1="12" y1="5" x2="12" y2="19" />
                    <line x1="5" y1="12" x2="19" y2="12" />
                </svg>
                {{ __('view.addHotel') }}
            </a>
        </div>
        <div class="card-body border-bottom py-3">
            <div class="d-flex">
                <div class="text-muted">
                    {{ __('view.show') }}
                    <div class="mx-2 d-inline-block">
                        <input type="text" class="form-control form-control-sm" value="8" size="3" aria-label="Invoices count">
                    </div>
                    {{ __('view.entries') }}
                </div>
                <div class="ms-auto text-muted">
                    <div class="ms-2 d-flex align-items-center justify-content-between gap-2">
                        <label class="">{{ __('view.search') }}&nbsp;:&nbsp;</label>
                        <div class="d-inline-block" style="height: 100%">
                            <input type="text" name=search class="form-control form-control-sm" style="height: 100%">
                        </div>
                        <a href="{{ route('hotel.add') }}" class="btn btn-facebook btn-sm" style="height: 100%">
                            <!-- Download SVG icon from http://tabler-icons.io/i/search -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <circle cx="10" cy="10" r="7" />
                                <line x1="21" y1="21" x2="15" y2="15" />
                            </svg>
                            {{ __('view.search') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table card-table table-vcenter text-nowrap datatable">
                <thead>
                    <tr>
                        <th class="w-2">{{ __('view.id') }} </th>
                        <th class="w-2"> {{ __('view.name') }} </th>
                        <th class="w-2">{{ __('view.country') }} </th>
                        <th class="w-2">{{ __('view.city') }} </th>
                        <th class="w-2">{{ __('view.actions') }} </th>
                    </tr>
                </thead>
                <tbody>
                    @if(!count($hotels))
                    <tr>
                        <td style="height: 50px;text-align: center" colspan=5> {{ __('view.notAvailable') }} </td>
                    </tr>
                    @endif
                    @foreach($hotels AS $hotel)
                    <tr>
                        <td><span class="text-muted">{{ $hotel->id }}</span></td>
                        <td>{{ $hotel->name }}</td>
                        <td>
                            <span class="flag flag-country-{{$hotel->country}}"></span>
                            {{ $hotel->countryName }}
                        </td>
                        <td>
                            {{ $hotel->city }}
                        </td>
                        <td>
                            <span class="dropdown">
                                <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">{{ __('view.actions') }}</button>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="{{ route('hotel.edit', $hotel->id) }}">
                                        <!-- Download SVG icon from http://tabler-icons.io/i/edit -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" />
                                            <path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" />
                                            <line x1="16" y1="5" x2="19" y2="8" />
                                        </svg>&nbsp;
                                        {{ __('view.edit') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('hotel.delete', $hotel->id) }}">
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
        {{ $hotels->links('vendor.pagination.custom')}}
    </div>
</div>
<script>
    $('[hotels_tab]').addClass('active');
</script> 
@endsection