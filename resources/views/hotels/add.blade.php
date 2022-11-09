@extends('layouts.app')
@section('tabTitle', __("view.addHotel"))
@section('content')
<div class="wrapper">
    <div class="page-wrapper">
        <div class="container-xl">
            <!-- Page title -->
            <div class="page-header d-print-none">
                <div class="row align-items-center">
                    <div class="col">
                        <h2 class="page-title">
                            {{ __("view.addHotel") }}
                        </h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-body">
            <form action="{{ route('hotel.store') }}" method="POST" enctype="multipart/form-data"    data-form class="card">
                @csrf
                <input type="hidden" name="rooms">
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
                                        <label class="form-label">{{ __('view.country') }}</label>
                                        <select type="text" name="country" class="form-select @error('country') is-invalid @enderror" id="select-countries">
                                            <option value="" selected></option>
                                            @foreach($countries AS $country)
                                            <option value="{{ $country->code }}" @if($country->code == old('country')) selected @endif data-custom-properties=" &lt;span class=&quot;flag flag-xs flag-country-{{ $country->code }}&quot;&gt;&lt;/span&gt;">{{ $country->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('country')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">{{ __('view.city') }}</label>
                                        <select type="text" name="city" class="form-select @error('city') is-invalid @enderror">
                                            <option value="" Selected>{{ __('view.selectOption') }}</option>
                                        </select>
                                        @error('city')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3" data-rooms>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="page-title">{{ __('view.rooms') }}</div>
                                            <div class="col-4 col-sm-2 col-md-2 col-xl-auto mt-3">
                                                <a onclick="addRoom()" type="button" data-button class="btn btn-facebook btn-sm">
                                                    <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <line x1="12" y1="5" x2="12" y2="19" />
                                                        <line x1="5" y1="12" x2="19" y2="12" />
                                                    </svg>
                                                    {{ __('view.addRoom') }}
                                                </a>
                                            </div>
                                        </div>
                                        <div data-template data-room hidden class="mt-3">
                                            <a onclick="removeRoom(this)" type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete-room">
                                                <!-- Download SVG icon from http://tabler-icons.io/i/x -->
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <line x1="18" y1="6" x2="6" y2="18" />
                                                    <line x1="6" y1="6" x2="18" y2="18" />
                                                </svg>
                                                {{ __('view.delete') }}
                                            </a>
                                            <div class="d-flex align-items-center">
                                                <span style="width: 100px;">{{ __('view.roomName') }}</span><input type="text" data-name=name name=rooms_titles[] class="form-control" style="margin-bottom: 10px">
                                            </div>

                                            <div class="d-flex align-items-center">
                                                <span style="width: 100px;">{{ __('view.roomImage') }}</span><input type="file" data-name=image name=rooms_image[] class="form-control" style="margin-bottom: 10px">
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

<div class="modal modal-blur fade" id="delete-room" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-title">{{ __('view.delete') }}</div>
                <div>{{ __('view.deleteRoomMessage') }}</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link link-secondary me-auto" data-bs-dismiss="modal">{{ __('view.cancel') }}</button>
                <button data-delete-room type="button" class="btn btn-danger" data-bs-dismiss="modal">{{ __('view.delete') }}</button>
            </div>
        </div>
    </div>
</div>
<!-- Libs JS -->
<script src="{{ asset('libs/nouislider/dist/nouislider.min.js') }}"></script>
<script src="{{ asset('libs/litepicker/dist/litepicker.js') }}"></script>
<script src="{{ asset('libs/tom-select/dist/js/tom-select.base.min.js') }}"></script>
<script>
    const countries = $.map(<?= $countries ?>, (el) => {
        return el;
    });

    $('[hotels_tab]').addClass('active');

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

    $(() => {
        if ($('body').hasClass('theme-dark')) $('[type=select-one]').css('color', '#fff');
    });

    $('#select-countries').on('input', () => {
        $.ajax({
            url: "{{ route('get.cities') }}",
            type: "POST",
            data: {
                _token: '{{ csrf_token() }}',
                countryCode: $('#select-countries').val()
            },
            success: function(response) {
                $('[name=city]').html('');
                response['cities'].forEach((el, i) => {
                    $('[name=city]').append(`
                        <option value=${el['id']}>${el['name']}</option>
                    `);
                });
            }
        });
    });

    const addRoom = (data = null) => {
        if (!data) {
            let template = $('[data-template]').clone();
            template.removeAttr('data-template hidden');
            $('[data-rooms]').append(template);
        } else {
            let template = $('[data-template]').clone();
            template.removeAttr('data-template hidden');
            template.find('input[data-name=name]').val(data)
            $('[data-rooms]').append(template);
        }
    };

    const removeRoom = (target) => {
        $('[data-delete-room]').on('click', () => {
            $(target).parent().remove();
        });
    };

    $('[data-form]').on('submit', (event) => {
        let rooms = [];
        let validation = false;
        $('[data-room]:not("[data-template]")').each((i, el) => {
            if ($(el).find('[data-name=name]').val()) {
                let room = {
                    name: $(el).find('input[type=text]').val()
                }
                rooms.push(room);
            } else {
                validation = true;
            }
        });
        if (validation) {
            event.preventDefault();
            alert("{{ __('view.roomsValidation') }}");
        } else {
            $('[name=rooms]').val(JSON.stringify(rooms));
        }
    });
</script>
@if(old('rooms'))
<script>
    $(() => {
        let rooms = JSON.parse(JSON.stringify(<?= old('rooms') ?>));
        rooms.forEach((el) => {
            addRoom(el.name);
        });
    });
</script>
@endif

@if(old('city'))
<script>
    $.ajax({
        url: "{{ route('get.cities') }}",
        type: "POST",
        data: {
            _token: '{{ csrf_token() }}',
            countryCode: "{{ old('country') }}"
        },
        success: function(response) {
            $('[name=city]').html('');
            response['cities'].forEach((el, i) => {
                $('[name=city]').append(`
<option value=${el['id']}>${el['name']}</option>
`);
            });
        },
    });
</script>
@endif
@endsection