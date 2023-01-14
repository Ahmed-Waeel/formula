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
<html lang="ar" dir=rtl>

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

<body dir="rtl">
    <table class="header_content" style="width: 100%">
        <tr>
            <td style="text-align: right">
                <img src="{{ $settings['pdf_ar_logo'] != '' ? $settings['pdf_ar_logo'] : public_path('pdf/ar_logo.png') }}">
            </td>
            <td style="text-align: left">
                <img src="{{ $settings['pdf_en_logo'] != '' ? $settings['pdf_en_logo'] : public_path('pdf/en_logo.png')}}">
            </td>
        </tr>
    </table>

    <table class="header_table" style="font-size: 24px; text-align: right; width: 100%">
        <tbody>
            <tr>
                <td style="margin-left: 100px">
                    اسم العميل: {{ $customer->name }}
                </td>

                <td rowspan=3 style="text-align: right; vertical-align: middle; font-size: 100px; color: #1b64cc; margin-left: 100px">
                {{ $settings['ar_title'] != '' ? strip_tags($settings['ar_title']) : "عرض سعر" }}
                </td>

                <td style="text-align: center">
                    التاريخ: {{ date('d-m-Y', strtotime($reservation->date)) }}
                </td>
            </tr>
            <tr>
                <td>
                    رقم العميل: {{ $customer->customer_id }}
                </td>


                <td style="text-align: center">
                    الوجهة: {{ $flight->flight_to }}
                </td>
            </tr>
            <tr>
                <td>
                    رقم الحجز: {{ $reservation->reservation_id }}
                </td>

                <td style="text-align: center">
                    عدد المسافرين: {{ $flight->num_passengers }}
                </td>
            </tr>
        </tbody>
    </table>
    
    @if($international_flights_check)
        <table>
            <thead>
                <tr>
                    <td colspan=4 class="table_title">
                        {{ $settings['ar_pdf_international_flights'] != '' ? strip_tags($settings['ar_pdf_international_flights'])  : "الطيران الدولي" }}
                    </td>
                </tr>
                <tr>
                    <td style="width: 15%">{{ $settings['ar_pdf_international_flights_1'] != '' ? strip_tags($settings['ar_pdf_international_flights_1'])  : "اليوم" }}</td>
                    <td style="width: 15%">{{ $settings['ar_pdf_international_flights_2'] != '' ? strip_tags($settings['ar_pdf_international_flights_2'])  : "التاريخ" }}</td>
                    <td style="width: 50%">{{ $settings['ar_pdf_international_flights_3'] != '' ? strip_tags($settings['ar_pdf_international_flights_3'])  : "من &nbsp; - &nbsp; إلى" }}</td>
                    <td style="width: 20%">{{ $settings['ar_pdf_international_flights_4'] != '' ? strip_tags($settings['ar_pdf_international_flights_4'])  : "ملاحظات" }}</td>
                </tr>
            </thead>
            <tbody>
                @foreach($options AS $option)
                    @foreach($option['international_flights'] AS $international_flight)
                        <tr>
                            <td>{{ $option['day'] }}</td>
                            <td>{{ date('d-m-Y', strtotime($international_flight['date'])) }}</td>
                            <td>
                                 {{ $international_flight['from'] }} -> {{ $international_flight['to'] }} <br>
                                 شركة الطيران: {{$international_flight['company']}}<br>
                                 رقم الرحلة: {{$international_flight['flight_number']}} <br>
                                 الإقلاع: {{ $international_flight['time_from'] }} -
                            الوصول: {{$international_flight['time_to']}}</td>
                            <td>{!! nl2br(str_replace('\\n', '<br>', $international_flight['notes'])) !!}</td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    @endif
    
    @if($hotels_check)
        <table>
            <thead>
                <tr>
                    <td colspan=4 class="table_title">
                        {{ $settings['ar_pdf_hotels'] != '' ? strip_tags($settings['ar_pdf_hotels'])  : "حجز الفنادق" }}
                    </td>
                </tr>
                <tr>
                    <td style="width: 15%">{{ $settings['ar_pdf_hotels_1'] != '' ? strip_tags($settings['ar_pdf_hotels_1'])  : "اليوم" }}</td>
                    <td style="width: 15%">{{ strip_tags($settings['ar_pdf_hotels_2']) != '' ? strip_tags($settings['ar_pdf_hotels_2']) : strip_tags("تاريخ الدخول <br> - <br> تاريخ الخروج") }}</td>
                    <td style="width: 50%">{{ $settings['ar_pdf_hotels_3'] != '' ? strip_tags($settings['ar_pdf_hotels_3'])  : "اضغط على اسم الغرفة لمشاهدة صورة الغرف" }}</td>
                    <td style="width: 20%">{{ $settings['ar_pdf_hotels_4'] != '' ? strip_tags($settings['ar_pdf_hotels_4'])  : "عدد الغرف والوجبات" }}</td>
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
                        {{ $settings['ar_pdf_transportations'] != '' ? strip_tags($settings['ar_pdf_transportations'])  : "المواصلات" }}
                    </td>
                </tr>
                <tr>
                    <td style="width: 15%">{{ $settings['ar_pdf_transportations_1'] != '' ? strip_tags($settings['ar_pdf_transportations_1'])  : "اليوم" }}</td>
                    <td style="width: 15%">{{ $settings['ar_pdf_transportations_2'] != '' ? strip_tags($settings['ar_pdf_transportations_2'])  : "التاريخ" }}</td>
                    <td style="width: 50%">{{ $settings['ar_pdf_transportations_3'] != '' ? strip_tags($settings['ar_pdf_transportations_3'])  : "الوصف" }}</td>
                    <td style="width: 20%">{{ $settings['ar_pdf_transportations_4'] != '' ? strip_tags($settings['ar_pdf_transportations_4'])  : "ملاحظات" }}</td>
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
                        {{ $settings['ar_pdf_activities'] != '' ? strip_tags($settings['ar_pdf_activities'])  : "الأنشطة" }}
                    </td>
                </tr>
                <tr>
                    <td style="width: 15%">{{ $settings['ar_pdf_activities_1'] != '' ? strip_tags($settings['ar_pdf_activities_1'])  : "اليوم" }}</td>
                    <td style="width: 15%">{{ $settings['ar_pdf_activities_2'] != '' ? strip_tags($settings['ar_pdf_activities_2'])  : "التاريخ" }}</td>
                    <td style="width: 10%">{{ $settings['ar_pdf_activities_3'] != '' ? strip_tags($settings['ar_pdf_activities_3'])  : "الصورة" }}</td>
                    <td style="width: 20%">{{ $settings['ar_pdf_activities_4'] != '' ? strip_tags($settings['ar_pdf_activities_4'])  : "الوصف" }}</td>
                    <td style="width: 20%">{{ $settings['ar_pdf_activities_5'] != '' ? strip_tags($settings['ar_pdf_activities_5'])  : "ملاحظات" }}</td>
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
                        {{ $settings['ar_pdf_internal_flights'] != '' ? strip_tags($settings['ar_pdf_internal_flights'])  : "الطيران الداخلي" }}
                    </td>
                </tr>
                <tr>
                    <td style="width: 15%">{{ $settings['ar_pdf_internal_flights_1'] != '' ? strip_tags($settings['ar_pdf_internal_flights_1'])  : "اليوم" }}</td>
                    <td style="width: 15%">{{ $settings['ar_pdf_internal_flights_2'] != '' ? strip_tags($settings['ar_pdf_internal_flights_2'])  : "التاريخ" }}</td>
                    <td style="width: 50%">{{ $settings['ar_pdf_internal_flights_3'] != '' ? strip_tags($settings['ar_pdf_internal_flights_3'])  : "من &nbsp; - &nbsp; إلى" }}</td>
                    <td style="width: 20%">{{ $settings['ar_pdf_internal_flights_4'] != '' ? strip_tags($settings['ar_pdf_internal_flights_4'])  : "ملاحظات" }}</td>
                </tr>
            </thead>
            <tbody>
                @foreach($options AS $option)
                    @foreach($option['internal_flights'] AS $internal_flight)
                        <tr>
                            <td>{{ $option['day'] }}</td>
                            <td>{{ date('d-m-Y', strtotime($internal_flight['date'])) }}</td>
                            <td>
                                 {{ $internal_flight['from'] }} -> {{ $internal_flight['to'] }} <br>
                                 شركة الطيران: {{$internal_flight['company']}}<br>
                                 رقم الرحلة: {{$internal_flight['flight_number']}} <br>
                                 الإقلاع: {{ $internal_flight['time_from'] }} -
                            الوصول: {{$internal_flight['time_to']}}</td>
                            <td>{!! nl2br(str_replace('\\n', '<br>', $internal_flight['notes'])) !!}</td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    @endif

    {{ $settings['ar_price'] != '' ? strip_tags($settings['ar_price']) : "السعر الإجمالي" }}:<b>{{ $flight->price }}</b> ريال سعودى
    <br>

    @if($flight->deposite)
        {{ $settings['ar_deposite'] != '' ? strip_tags($settings['ar_deposite']) : "ولتأكيد الحجز يرجي تحويل قيمة العربون كدفعة مقدمة من التكلفة الإجمالية وتساوي " }}<b>{{ $flight->deposite }}</b> ريال سعودى 
        <br>
    @endif

    @if(trim($flight->notes) != '')
        <table>
            <thead>
                <tr>
                    <td class="table_title">
                        {{ $settings['ar_notes'] != '' ? strip_tags($settings['ar_notes']) : "ملاحظات مهمة جدا" }}
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