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
    </style>
</head>

<body dir="rtl">
    <div>
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
        <hr>
    </div>

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
                <td>من &nbsp; - &nbsp; إلي</td>
                <td>ملاحظات</td>
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
                            <td> {{ $airport['from'] }} -> {{ $airport['to'] }} <br> شركة الطيران: {{$airport['company']}} <br> رقم الرحلة: {{$airport['flight_number']}} <br> من: {{ $airport['time_from'] }} - إلي: {{$airport['time_to']}}</td>
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
                <td>ملاحظات</td>
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
                <td> {{ $transportation['from'] }} -> {{ $transportation['to'] }} </td>
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
                <td colspan=5 class="table_title">
                    الأنشطة
                </td>
            </tr>
            <tr>
                <td>اليوم</td>
                <td>التاريخ</td>
                <td>الصورة</td>
                <td>الوصف</td>
                <td>ملاحظات</td>
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
                            <td>{!! nl2br(str_replace('\\n', '<br>', $activity['description'])) !!}</td>
                            <td>{!! nl2br(str_replace('\\n', '<br>', $activity['notes'])) !!}</td>
                        </tr>
                    @endforeach
                @endforeach
            @endif
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

</body>
</html>

    {{-- <div style="position: fixed;">
        <span style="position: fixed; left: 30px bottom 20px">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M10 21v-6.5a3.5 3.5 0 0 0 -7 0v6.5h18v-6a4 4 0 0 0 -4 -4h-10.5" />
                <path d="M12 11v-8h4l2 2l-2 2h-4" />
                <path d="M6 15h1" />
            </svg>
        </span>
    </div>

    <div style="position: fixed;">
        <span style="position: fixed left: 0px ">
            PO Box. 7155, Jeddah-23534, KSA
        </span>
    </div> --}}

 {{-- <table style="width: 100%; height: 10px; background-color: red">
        <tr>
            <td>
                www.formula.com.sa

                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <circle cx="12" cy="12" r="9" />
                    <line x1="3.6" y1="9" x2="20.4" y2="9" />
                    <line x1="3.6" y1="15" x2="20.4" y2="15" />
                    <path d="M11.5 3a17 17 0 0 0 0 18" />
                    <path d="M12.5 3a17 17 0 0 1 0 18" />
                </svg>
            </td>
            <td>
                966&nbsp;126044944+

                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="17" height="17" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2" />
                </svg>
            </td>
            <td>
                92000&nbsp;40&nbsp;80


            </td>
            <td>
                PO Box. 7155, Jeddah-23534, KSA

                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M10 21v-6.5a3.5 3.5 0 0 0 -7 0v6.5h18v-6a4 4 0 0 0 -4 -4h-10.5" />
                    <path d="M12 11v-8h4l2 2l-2 2h-4" />
                    <path d="M6 15h1" />
                </svg>
            </td>
            <td>@formula_KSA</td>
        </tr>
    </table> --}}


<!-- twitter -->
<!-- <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
    <path d="M22 4.01c-1 .49 -1.98 .689 -3 .99c-1.121 -1.265 -2.783 -1.335 -4.38 -.737s-2.643 2.06 -2.62 3.737v1c-3.245 .083 -6.135 -1.395 -8 -4c0 0 -4.182 7.433 4 11c-1.872 1.247 -3.739 2.088 -6 2c3.308 1.803 6.913 2.423 10.034 1.517c3.58 -1.04 6.522 -3.723 7.651 -7.742a13.84 13.84 0 0 0 .497 -3.753c-.002 -.249 1.51 -2.772 1.818 -4.013z" />
</svg> -->

<!-- snap chat -->
<!-- <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
    <path d="M16.882 7.842a4.882 4.882 0 0 0 -9.764 0c0 4.273 -.213 6.409 -4.118 8.118c2 .882 2 .882 3 3c3 0 4 2 6 2s3 -2 6 -2c1 -2.118 1 -2.118 3 -3c-3.906 -1.709 -4.118 -3.845 -4.118 -8.118zm-13.882 8.119c4 -2.118 4 -4.118 1 -7.118m17 7.118c-4 -2.118 -4 -4.118 -1 -7.118" />
</svg> -->

<!-- linked in -->
<!-- <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
    <rect x="4" y="4" width="16" height="16" rx="2" />
    <line x1="8" y1="11" x2="8" y2="16" />
    <line x1="8" y1="8" x2="8" y2="8.01" />
    <line x1="12" y1="16" x2="12" y2="11" />
    <path d="M16 16v-3a2 2 0 0 0 -4 0" />
</svg> -->

<!-- facebook -->
<!-- <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
    <path d="M7 10v4h3v7h4v-7h3l1 -4h-4v-2a1 1 0 0 1 1 -1h3v-4h-3a5 5 0 0 0 -5 5v2h-3" />
</svg> -->

<!-- instagram -->
<!-- <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
    <rect x="4" y="4" width="16" height="16" rx="4" />
    <circle cx="12" cy="12" r="3" />
    <line x1="16.5" y1="7.5" x2="16.5" y2="7.501" />
</svg> -->