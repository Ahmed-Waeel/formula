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

        .logo {
            width: 250px;
            height: 80px;

        }

        .logo img {
            width: 250px;
            height: 80px;
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
    </style>
</head>

<body dir="rtl">
  
    <div class="page_container">

        <div class=logo>
            <img src="{{ public_path('ar_logo.png') }}">
        </div>

        <hr>
    </div>
    <table class="header_table" style="text-align: right">
        <tbody>
            <tr>
                <td>
                    اسم العميل: {{ $customer->name }}
                </td>
                <td>
                    التاريخ: {{ date('d-m-Y', strtotime($reservation->date)) }}
                </td>
            </tr>
            <tr>
                <td>
                    رقم العميل: {{ $customer->customer_id }}
                </td>
                <td>
                    رقم الرحلة: {{ $flight->flight_id }}
                </td>
            </tr>
            <tr>
                <td colspan=2>
                    رقم الحجز: {{ $reservation->reservation_id }}
                </td>
            </tr>
        </tbody>
    </table>

    <table>
        <tbody>
            <tr>
                <td colspan=4 class="table_title">
                    حجز الفنادق
                </td>
            </tr>
            <tr>
                <td>اليوم</td>
                <td>تاريخ الدخول <br> - <br> تاريخ الخروج</td>
                <td>الفندق والمدينة <br> اضفط علي اسم الفندق لمشاهدة صور وفيديوهات الفندق </td>
                <td>نوع الغرف وعددها</td>
            </tr>
            @if(!$hotels_check)
            <tr>
                <td colspan="4" style="text-align: center;">
                    لا يوجد فنادق في هذه الرحلة
                </td>
            </tr>
            @else
                @foreach($options AS $option)
                    @foreach($option['hotels'] AS $hotel)
                        @php $date1 = Carbon\Carbon::parse($hotel['start_date']);
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
                        @endphp
                        <tr>
                            <td>{{ $option['day'] }}</td>
                            <td>{{ date('d-m-Y', strtotime($hotel['start_date'])) }}<br> - <br>{{ date('d-m-Y', strtotime($hotel['end_date'])) }}</td>
                            <td>{{ $city . '-' . $country }}<br>  <a href="{{ asset('uploads/rooms') . '/' . ((array)json_decode($hotel_data['rooms'])[+$hotel['room'] - 1])['image']}}" target="_blank">{{ $hotel_data['name'] }}</a> <br> {{ $diff }} ليالي</span></td>
                            <td> <br> {!! nl2br(str_replace('\\n', '<br>', $hotel['notes'])) !!}</td>
                        </tr>
                    @endforeach
                @endforeach
            @endif
        </tbody>
    </table>

    <table>
        <tbody>
            <tr>
                <td colspan=4 class="table_title">
                    الطيران
                </td>
            </tr>
            <tr>
                <td>اليوم</td>
                <td>التاريخ</td>
                <td>من - إالي</td>
                <td>عدد المسافرين</td>
            </tr>
            @if(!$airports_check)
                <tr>
                    <td colspan="4" style="text-align: center;">
                        لا يوجد اي مطارات في هذه الرحلة
                    </td>
                </tr>
            @else
                @foreach($options AS $option)
                    @foreach($option['airports'] AS $airport)
                        <tr>
                            <td>{{ $option['day'] }}</td>
                            <td>{{ date('d-m-Y h:i A', strtotime($airport['date'])) }}</td>
                            <td> {{ $airport['from'] }} -> {{ $airport['to'] }} <br> الساعة: {{ $airport['time'] }} </td>
                            <td>{!! nl2br(str_replace('\\n', '<br>', $airport['notes'])) !!}</td>
                        </tr>
                    @endforeach
                @endforeach
            @endif
        </tbody>
    </table>

    <table>
        <tbody>
            <tr>
                <td colspan=4 class="table_title">
                    المواصلات
                </td>
            </tr>
            <tr>
                <td>اليوم</td>
                <td>التاريخ</td>
                <td>الوصف</td>
                <td>عدد السيارات ونوعها</td>
            </tr>
            @if(!$transportations_check)
                <tr>
                    <td colspan="4" style="text-align: center;">
                        لا يوجد اي مواصلات او انشطة في هذه الرحلة
                    </td>
                </tr>
            @else
                @foreach($options AS $option)
                    @foreach($option['transportations'] AS $transportation)
                        <tr>
                            <td>{{ $option['day'] }}</td>
                            <td>{{ date('d-m-Y', strtotime($transportation['date'])) }}</td>
                            <td> {{ $transportation['from'] }}  ->  {{ $transportation['to'] }} </td>
                            <td>{!! nl2br(str_replace('\\n', '<br>', $transportation['notes'])) !!}</td>
                        </tr>
                    @endforeach
                @endforeach
            @endif
        </tbody>
    </table>

    <table>
        <tbody>
            <tr>
                <td colspan=4 class="table_title">
                    الأنشطة
                </td>
            </tr>
            <tr>
                <td>اليوم</td>
                <td>التاريخ</td>
                <td>الوصف</td>
                <td>الملاحظات</td>
            </tr>
            @if(!$activities_check)
                <tr>
                    <td colspan="4" style="text-align: center;">
                        لا يوجد اي مواصلات او انشطة في هذه الرحلة
                    </td>
                </tr>
            @else
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
                            <td>{!! nl2br(str_replace('\\n', '<br>', $activity['notes'])) !!}</td>
                        </tr>
                    @endforeach
                @endforeach
            @endif

        </tbody>
    </table>
</body>

</html>