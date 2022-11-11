@php
$airports = json_decode($flight->airports, true);
$transportations = json_decode($flight->transportations, true);
$flight_hotels = json_decode($flight->hotels, true);
function search($value, $array, $prop = 'id') {
foreach ($array as $key => $arr) {
if ($arr[$prop] == $value) {
return $arr;
}
}
return null;
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
    <!-- <div class="background_icon">
        <img src="{{ public_path('icon.png') }}">
    </div> -->
    <div class="page_container">

        <div class=logo>
            <img src="{{ public_path('ar_logo.png') }}">
        </div>

        <hr>

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
                @if(!$flight_hotels)
                <tr>
                    <td colspan="4" style="text-align: center;">
                        لا يوجد فنادق في هذه الرحلة
                    </td>
                </tr>
                @endif
                @foreach($flight_hotels AS $flight_hotel)
                @php
                $hotel = search($flight_hotel['hotel'], $hotels);
                $date1 = Carbon\Carbon::parse($flight_hotel['start_date']);
                $date2 = Carbon\Carbon::parse($flight_hotel['end_date']);
                $diff = $date1->diffInDays($date2);
                $country = search($hotel['country'], $countries, 'code')['name'];
                $city = search($hotel['city'], $cities)['name'];
                @endphp
                <tr>
                    <td>{{ $flight_hotel['day'] }}</td>
                    <td>{{ date('d-m-Y', strtotime($flight_hotel['start_date'])) }}<br> - <br>{{ date('d-m-Y', strtotime($flight_hotel['end_date'])) }}</td>
                    <td>{{ $city . '-' . $country }}<br> <a href="{{ asset('uploads/rooms') . '/' . ((array)json_decode($hotel['rooms'])[+$flight_hotel['room']])['image']}}" target="_blank">{{ $hotel->name }}</a> <br> {{ $diff }} ليالي</span></td>
                    <td> <br> {!! nl2br(str_replace('\\n', '<br>', $flight_hotel['notes'])) !!}</td>
                </tr>
                @endforeach
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
                @if(!$airports)
                <tr>
                    <td colspan="4" style="text-align: center;">
                        لا يوجد اي مطارات في هذه الرحلة
                    </td>
                </tr>
                @endif
                @foreach($airports AS $airport)
                <tr>
                    <td>{{ $airport['day'] }}</td>
                    <td>{{ date('d-m-Y h:i A', strtotime($airport['date'])) }}</td>
                    <td> {{ $airport['from'] }} -> {{ $airport['to'] }} <br> الساعة: {{ $airport['time'] }} </td>
                    <td>{!! nl2br(str_replace('\\n', '<br>', $airport['notes'])) !!}</td>
                </tr>
                @endforeach
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
                @if(!$transportations)
                <tr>
                    <td colspan="4" style="text-align: center;">
                        لا يوجد اي مواصلات او انشطة في هذه الرحلة
                    </td>
                </tr>
                @endif
                @foreach($transportations AS $transportation)
                <tr>
                    <td>{{ $transportation['day'] }}</td>
                    <td>{{ date('d-m-Y', strtotime($transportation['date'])) }}</td>
                    <td> {{ $transportation['from'] }} -> {{ $transportation['to'] }} </td>
                    <td>{!! nl2br(str_replace('\\n', '<br>', $transportation['notes'])) !!}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        @if(trim($flight->notes) != '')
        <table>
            <tbody>
                <tr>
                    <td class="table_title">
                        ملاحظات مهمة جدا
                    </td>
                </tr>
                <tr>
                    <td style="min-width: 100%;text-align: right">
                        {!! nl2br(e($flight->notes)) !!}
                    </td>
                </tr>
            </tbody>
        </table>
        @endif
    </div>

</body>

</html>