@php
    $options = json_decode($flight->options, true);

    $activities_check = false;
    $airports_check = false;
    $transportations_check = false;
    $hotels_check = false;

    foreach($options AS $option){
        if(count($option['hotels'])) $hotels_check = true;
        if(count($option['airports'])) $airports_check = true;
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

        .ar_logo {
            width: 220px;
            height: 70px;
        }

        .ar_logo img {
            width: 220px;
            height: 70px;
        }

        .en_logo {
            width: 200px;
            height: 70px;
            margin-right: 130px;
        }

        .en_logo img {
            width: 220px;
            height: 70px;
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
    </style>
</head>

<body dir="rtl">
    <table style="width: 100%">
        <tr>
            <td style="text-align: right">
                <img style="width: 220px; height: 70px" src="{{ public_path('ar_logo.png') }}">
            </td>
            <td style="text-align: left">
                <img style="width: 220px; height: 70px" src="{{ public_path('en_logo.png') }}">
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
                    عرض سعر
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
                    عدد المسافرين: {{ $numberOfCustomers }}
                </td>
            </tr>
        </tbody>
    </table>

    @if($hotels_check)
        <table>
            <thead>
                <tr>
                    <td colspan=4 class="table_title">
                        حجز الفنادق
                    </td>
                </tr>
                <tr>
                    <td style="width: 15%">اليوم</td>
                    <td style="width: 15%">تاريخ الدخول <br> - <br> تاريخ الخروج</td>
                    <td style="width: 50%">الفندق والمدينة <br> اضفط علي اسم الفندق لمشاهدة صور وفيديوهات الفندق </td>
                    <td style="width: 20%">نوع الغرف وعددها</td>
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

    @if($airports_check)
        <table>
            <thead>
                <tr>
                    <td colspan=4 class="table_title">
                        الطيران
                    </td>
                </tr>
                <tr>
                    <td style="width: 15%">اليوم</td>
                    <td style="width: 15%">التاريخ</td>
                    <td style="width: 50%">من &nbsp; - &nbsp; إلي</td>
                    <td style="width: 20%">ملاحظات</td>
                </tr>
            </thead>
            <tbody>
                @foreach($options AS $option)
                    @foreach($option['airports'] AS $airport)
                        <tr>
                            <td>{{ $option['day'] }}</td>
                            <td>{{ date('d-m-Y h:i A', strtotime($airport['date'])) }}</td>
                            <td> {{ $airport['from'] }} -> {{ $airport['to'] }} <br> شركة الطيران: {{$airport['company']}} <br> رقم الرحلة: {{$airport['flight_number']}} <br> من: {{ $airport['time_from'] }} - إلي: {{$airport['time_to']}}</td>
                            <td>{!! nl2br(str_replace('\\n', '<br>', $airport['notes'])) !!}</td>
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
                        المواصلات
                    </td>
                </tr>
                <tr>
                    <td style="width: 15%">اليوم</td>
                    <td style="width: 15%">التاريخ</td>
                    <td style="width: 50%">الوصف</td>
                    <td style="width: 20%">ملاحظات</td>
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
                        الأنشطة
                    </td>
                </tr>
                <tr>
                    <td style="width: 15%">اليوم</td>
                    <td style="width: 15%">التاريخ</td>
                    <td style="width: 10%">الصورة</td>
                    <td style="width: 20%">الوصف</td>
                    <td style="width: 20%">ملاحظات</td>
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

    @if(trim($flight->notes) != '')
        <table>
            <thead>
                <tr>
                    <td class="table_title">
                        ملاحظات مهمة جدا
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