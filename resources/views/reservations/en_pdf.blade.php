@php
    $options = json_decode($flight->options, true);

    $activities_check = false;
    $international_flights_check = false;
    $internal_flights_check = false;
    $transportations_check = false;
    $hotels_check = false;

    foreach($options AS $option){
        if(count($option['hotels'])) $hotels_check = true;
        if(count($option['international_flights'])) $international_flights_check = true;
        if(count($option['internal_flights'])) $internal_flights_check = true;
        if(count($option['activities'])) $activities_check = true;
        if(count($option['transportations'])) $transportations_check = true;
    }
@endphp

<!doctype html>
<html lang="en" dir=ltr>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-size: 14px;
            padding: 0;
            width: 800px;
            margin: 70px auto 0 auto;
            word-break: break-word;
            padding: 50px 20px;
            font-family: cairo;
            background: url("{{ public_path('icon.png') }}") no-repeat center;
            background-image-opacity: 0.1;
        }

        .background_icon {
            width: 600px;
            height: 600px;
            position: fixed;
            z-index: 1;
            opacity: 10%;
            top: 430px;
            left: 210px;
        }

        .background_icon img {
            width: 100%;
            height: 100%;
        }


        hr:not(:first-of-type) {
            color: #5acb98;
            border: 2px solid #5acb98;
        }

        table {
            width: 100%;
            margin-bottom: 60px;
        }

        table,
        th,
        td {
            border-collapse: collapse;
            padding: 5px;
            word-break: break-word;
            text-align: center;
            border-bottom: 2px solid #0985c8;
            border-collapse: collapse;
        }

        th td:first-of-type {
            border: none;
        }

        .header_table,
        .header_table td {
            border: none;
            text-align: right;

        }

        .header_table td {
            width: 70%;
            height: 50px;
            word-break: break-word;
            text-align: right;
        }

        .table_title {
            width: 100%;
            text-align: center;
            color: #2a96d0;
            font-size: 30px;
            margin-top: 100px;
        }
        .foot{
            position: absolute;
            top:100px;
            left: 100px
        }
        .header_content img{
            width: 190px;
            height: 55px;
        }
    </style>
</head>

<body dir="ltr">
    <table class="header_content" style="width: 100%">
        <tr>
            <td style="text-align: left">
                <img src="{{ $settings['pdf_en_logo'] != '' ? $settings['pdf_en_logo'] : public_path('pdf/en_logo.png') }}">
            </td>
            <td style="text-align: right">
                <img src="{{ $settings['pdf_ar_logo'] != '' ? $settings['pdf_ar_logo'] : public_path('pdf/ar_logo.png')}}">
            </td>
        </tr>
    </table>

    <table class="header_table" style="font-size: 24px; text-align: right; width: 100%">
        <tbody>
            <tr>
                <td style="margin-left: 100px">
                    Customer Name: {{ $customer->name }}
                </td>

                <td rowspan=3 style="text-align: center; vertical-align: middle; font-size: 70px; color: #1b64cc">
                    {{ $settings['en_title'] != '' ? strip_tags($settings['en_title']) : "Price Offer" }}
                </td>

                <td style="text-align: center">
                    Date: {{ date('d-m-Y', strtotime($reservation->date)) }}
                </td>
            </tr>
            <tr>
                <td>
                    Customer ID: {{ $customer->customer_id }}
                </td>


                <td style="text-align: center">
                    Destination: {{ $flight->flight_to }}
                </td>
            </tr>
            <tr>
                <td>
                    Reservation Number: {{ $reservation->reservation_id }}
                </td>

                <td style="text-align: center">
                    N. of Passengers: {{ $flight->num_passengers }}
                </td>
            </tr>
        </tbody>
    </table>

    @if($international_flights_check)
        <table>
            <thead>
                <tr>
                    <td colspan=4 class="table_title">
                        {{ $settings['en_pdf_international_flights'] != '' ? strip_tags($settings['en_pdf_international_flights'])  : "International Flights" }}
                    </td>
                </tr>
                <tr>
                    <td style="width: 15%">{{ $settings['en_pdf_international_flights_1'] != '' ? strip_tags($settings['en_pdf_international_flights_1'])  : "Day" }}</td>
                    <td style="width: 15%">{{ $settings['en_pdf_international_flights_2'] != '' ? strip_tags($settings['en_pdf_international_flights_2'])  : "Date" }}</td>
                    <td style="width: 50%">{{ $settings['en_pdf_international_flights_3'] != '' ? strip_tags($settings['en_pdf_international_flights_3'])  : "From &nbsp; - &nbsp; To" }}</td>
                    <td style="width: 20%">{{ $settings['en_pdf_international_flights_4'] != '' ? strip_tags($settings['en_pdf_international_flights_4'])  : "Note" }}</td>
                </tr>
            </thead>
            <tbody>
                @foreach($options AS $option)
                    @foreach($option['international_flights'] AS $airport)
                        <tr>
                            <td>{{ $option['day'] }}</td>
                            <td>{{ date('d-m-Y h:i A', strtotime($airport['date'])) }}</td>
                            <td> {{ $airport['from'] }} -> {{ $airport['to'] }} <br> Flight Company: {{$airport['company']}} <br> Flight Number: {{$airport['flight_number']}} <br> From: {{ $airport['time_from'] }} - To: {{$airport['time_to']}}</td>
                            <td>{!! nl2br(str_replace('\\n', '<br>', $airport['notes'])) !!}</td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>

        @if($flight->international_flights_cost)
            <div style="margin-top: 50px">{{ $settings['en_international_flights_cost'] != '' ? strip_tags($settings['en_international_flights_cost']) : "International Flights Cost" }}: <b>{{ $flight->international_flights_cost }}</b> Suadi Riyal </div> <br>
        @endif
    @endif
    
    @if($hotels_check)
        <table>
            <thead>
                <tr>
                    <td colspan=4 class="table_title">
                        {{ $settings['en_pdf_hotels'] != '' ? strip_tags($settings['en_pdf_hotels'])  : "Hotels" }}
                    </td>
                </tr>
                <tr>
                    <td style="width: 15%">{{ $settings['en_pdf_hotels_1'] != '' ? strip_tags($settings['en_pdf_hotels_1']) : "Day" }}</td>
                    <td style="width: 15%">{{ $settings['en_pdf_hotels_2'] != '' ? strip_tags($settings['en_pdf_hotels_2']) : strip_tags("Start Date <br> - <br> End Date") }}</td>
                    <td style="width: 50%">
                        {{ $settings['en_pdf_hotels_3'] != '' ? strip_tags($settings['en_pdf_hotels_3']) : "Click on the link to watch to room image" }}
                    </td>
                        
                    <td style="width: 20%">{{ $settings['en_pdf_hotels_4'] != '' ? strip_tags($settings['en_pdf_hotels_4']) : "Rooms type & Number Of Rooms" }}</td>
                </tr>
            </thead>
            <tbody>
                @foreach($options AS $option)
                    @foreach($option['hotels'] AS $hotel)
                        @php 
                            $date1 = Carbon\Carbon::parse($hotel['start_date']);
                            $date2 = Carbon\Carbon::parse($hotel['end_date']);
                            $diff = $date1->diffInDays($date2);

                            $hotel_data = [];
                            foreach ($hotels as $key => $arr) {
                                if ($arr['id'] == $hotel['hotel']) $hotel_data = $arr;
                            }


                            $country = '';
                            foreach ($countries as $key => $arr) {
                                if ($arr['code'] == $hotel_data['country']) $country = $arr['name'];
                            }

                            $city = '';
                            foreach ($cities as $key => $arr) {
                                if ($arr['id'] == $hotel_data['city']) $city = $arr['name'];
                            }

                            $rooms = json_decode($hotel_data['rooms'], true);
                            $roomIdx = +$hotel['room'] - 1;
                            $roomTitle = $rooms[$roomIdx]['name'];
                            $roomImage = $rooms[$roomIdx]['image'];
                            $imagePath = asset('uploads/rooms') . '/' . $roomImage;
                        @endphp
                        <tr>
                            <td>{{ $option['day'] }}</td>
                            <td>{{ date('d-m-Y', strtotime($hotel['start_date'])) }}<br> - <br>{{ date('d-m-Y', strtotime($hotel['end_date'])) }}</td>
                            <td>{{ $city . '-' . $country }}<br> {{ $hotel_data['name'] }} <br> <a href={{ $imagePath }} target="_blank"> {{ $roomTitle }} </a> <br> {{ $diff }} ليالي</span></td>
                            <td> <br> {!! nl2br(str_replace('\\n', '<br>', $hotel['notes'])) !!}</td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    @endif

    @if($transportations_check)
        <table>
            <thead>
                <tr>
                    <td colspan=4 class="table_title">
                        {{ $settings['en_pdf_transportations'] != '' ? strip_tags($settings['en_pdf_transportations'])  : "Transportations" }}
                    </td>
                </tr>
                <tr>
                    <td style="width: 15%">{{ $settings['en_pdf_transportations_1'] != '' ? strip_tags($settings['en_pdf_transportations_1'])  : "Day" }}</td>
                    <td style="width: 15%">{{ $settings['en_pdf_transportations_2'] != '' ? strip_tags($settings['en_pdf_transportations_1'])  : "Date" }}</td>
                    <td style="width: 50%">{{ $settings['en_pdf_transportations_3'] != '' ? strip_tags($settings['en_pdf_transportations_1'])  : "Description" }}</td>
                    <td style="width: 20%">{{ $settings['en_pdf_transportations_4'] != '' ? strip_tags($settings['en_pdf_transportations_1'])  : "Notes" }}</td>
                </tr>
            </thead>
            <tbody>
                @foreach($options AS $option)
                    @foreach($option['transportations'] AS $transportation)
                        <tr>
                            <td>{{ $option['day'] }}</td>
                            <td>{{ date('d-m-Y', strtotime($transportation['date'])) }}</td>
                            <td> @if($transportation['from'] != '') {{ $transportation['from'] . "->" }} @endif   @if($transportation['to'] != '') {{ $transportation['to'] }} {!! "<br>" !!} @endif @if($transportation['description'] != '') {{ $transportation['description'] }} @endif </td>
                            <td>{!! nl2br(str_replace('\\n', '<br>', $transportation['notes'])) !!}</td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    @endif

    @if($activities_check)
        <table>
            <thead>
                <tr>
                    <td colspan=5 class="table_title">
                        {{ $settings['en_pdf_activities'] != '' ? strip_tags($settings['en_pdf_activities'])  : "Activities" }}
                    </td>
                </tr>
                <tr>
                    <td style="width: 15%">{{ $settings['en_pdf_activities_1'] != '' ? strip_tags($settings['en_pdf_activities_1'])  : "Day" }}</td>
                    <td style="width: 15%">{{ $settings['en_pdf_activities_2'] != '' ? strip_tags($settings['en_pdf_activities_2'])  : "Date" }}</td>
                    <td style="width: 10%">{{ $settings['en_pdf_activities_3'] != '' ? strip_tags($settings['en_pdf_activities_3'])  : "Image" }}</td>
                    <td style="width: 20%">{{ $settings['en_pdf_activities_4'] != '' ? strip_tags($settings['en_pdf_activities_4'])  : "Description" }}</td>
                    <td style="width: 20%">{{ $settings['en_pdf_activities_5'] != '' ? strip_tags($settings['en_pdf_activities_5'])  : "Notes" }}</td>
                </tr>
            </thead>
            <tbody>
                @foreach($options AS $option)
                    @foreach($option['activities'] AS $activity)
                        @php
                            $activity_data = [];
                            foreach ($activities as $key => $arr) {
                                if ($arr['id'] == $activity['activity']) $activity_data = $arr;
                            }
                        @endphp
                        <tr>
                            <td>{{ $option['day'] }}</td>
                            <td>{{ date('d-m-Y', strtotime($activity['date'])) }}</td>
                            <td> <a href="{{ asset('uploads/activities') . '/' . $activity_data['image']}}" target="_blank">{{ $activity_data['name'] }}</a> </td>
                            <td>{!! nl2br(str_replace('\\n', '<br>', $activity['description'])) !!}</td>
                            <td>{!! nl2br(str_replace('\\n', '<br>', $activity['notes'])) !!}</td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    @endif

    @if($internal_flights_check)
        <table>
            <thead>
                <tr>
                    <td colspan=4 class="table_title">
                        {{ $settings['en_pdf_internal_flights'] != '' ? strip_tags($settings['en_pdf_internal_flights'])  : "Internal Flights" }}
                    </td>
                </tr>
                <tr>
                    <td style="width: 15%">{{ $settings['en_pdf_internal_flights_1'] != '' ? strip_tags($settings['en_pdf_internal_flights_1'])  : "Day" }}</td>
                    <td style="width: 15%">{{ $settings['en_pdf_internal_flights_2'] != '' ? strip_tags($settings['en_pdf_internal_flights_2'])  : "Date" }}</td>
                    <td style="width: 50%">{{ $settings['en_pdf_internal_flights_3'] != '' ? strip_tags($settings['en_pdf_internal_flights_3'])  : "From &nbsp; - &nbsp; To" }}</td>
                    <td style="width: 20%">{{ $settings['en_pdf_internal_flights_4'] != '' ? strip_tags($settings['en_pdf_internal_flights_4'])  : "Notes" }}</td>
                </tr>
            </thead>
            <tbody>
                @foreach($options AS $option)
                    @foreach($option['internal_flights'] AS $airport)
                        <tr>
                            <td>{{ $option['day'] }}</td>
                            <td>{{ date('d-m-Y h:i A', strtotime($airport['date'])) }}</td>
                            <td> {{ $airport['from'] }} -> {{ $airport['to'] }} <br> Flight Company: {{$airport['company']}} <br> Flight Number: {{$airport['flight_number']}} <br> From: {{ $airport['time_from'] }} - To: {{$airport['time_to']}}</td>
                            <td>{!! nl2br(str_replace('\\n', '<br>', $airport['notes'])) !!}</td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    @endif

   {{ $settings['en_price'] != '' ? strip_tags($settings['en_price']) : "Total Price" }}: {{ $flight->price }} Saudi Riyal
    <br>

    @if($flight->deposite)
        {{ $settings['en_deposite'] != '' ? strip_tags($settings['en_deposite']) : "To confirm the reservation, please transfer the deposit value as an advance payment of the total cost " }}<b>{{ $flight->deposite }}</b> Suadi Riyal
        <br>
    @endif

    @if(trim($flight->notes) != '')
        <table>
            <thead>
                <tr>
                    <td class="table_title">
                        {{ $settings['en_notes'] != '' ? strip_tags($settings['en_notes']) : "Very Important Notes" }}
                    </td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="min-width: 100%;text-align: right">
                        {!! nl2br(e($flight->notes)) !!}
                    </td>
                </tr>
            </tbody>
        </table>
    @endif
</body>
</html>