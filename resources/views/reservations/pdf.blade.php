<!doctype html>
@php

@endphp
<html dir=rtl lang="ar">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style>
        body {
            font-family: DejaVu Sans, sans-serif !important;
            font-size: 14px;
            padding: 0;
            width: 800px;
            margin: 70px auto 0 auto;
            word-break: break-word;
            background-image: url("{{ public_path('icon.png') }}");
            background-repeat: no-repeat;
            background-position: center;
            opacity: 10%;
        }

        hr:not(:first-of-type) {
            color: #5acb98;
            border: 2px solid #5acb98;
        }

        table {
            min-width: 100%;
            margin-bottom: 20px;
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
            margin-top: 40px;
        }
    </style>
</head>

<body>
    <div class="page_container">

        <div style="display: flex;align-items: center;justify-content: between;margin-bottom: 40px">
            <a>
                <img src="{{ public_path('logo.png') }}" style="width: 250px;height: 80px;">
            </a>
        </div>

        <hr>

        <table class="header_table" style="text-align: right">
            <tbody>
                <tr>
                    <td>
                        اسم العميل: {!! '&nbsp;' !!}<span> Ahmed Wael </span>
                    </td>
                    <td>
                        التاريخ: 13may 2020
                    </td>
                </tr>
                <tr>
                    <td>
                        رقم العميل: 231424
                    </td>
                    <td>
                        رقم الرحلة: 234324
                    </td>
                </tr>
                <tr>
                    <td colspan=2>
                        رقم الحجز: 3423QF432
                    </td>
                </tr>
            </tbody>
        </table>

        <table style="width: 100%">
            <tbody>
                <tr>
                    <td colspan=4 class="table_title">
                        حجز الفنادق
                    </td>
                </tr>
                <tr>
                    <td>نوع الغرف وعددها</td>
                    <td>الفندق والمدينة <br> اضفط علي اسم الفندق لمشاهدة صور وفيديوهات الفندق </td>
                    <td>تاريخ الدخول <br> - <br> تاريخ الخروج</td>
                    <td>اليوم</td>
                </tr>
                <tr>
                    <td>Room Title <br> Quantity: 1 <br> include breakfast</td>
                    <td>Cairo - Egypt <br> <a href="#">Hotel Name</a> (number Of Days)</span></td>
                    <td>12-2-2022 <br> - <br> 14-2-2022</td>
                    <td>Day 1</td>
                </tr>
                <tr>
                    <td>Room Title <br> Quantity: 1 <br> include breakfast</td>
                    <td>Cairo - Egypt <br> <a href="#">Hotel Name</a> (number Of Days)</span></td>
                    <td>12-2-2022 <br> - <br> 14-2-2022</td>
                    <td>Day 1</td>
                </tr>
                <tr>
                    <td>Room Title <br> Quantity: 1 <br> include breakfast</td>
                    <td>Cairo - Egypt <br> <a href="#">Hotel Name</a> (number Of Days)</span></td>
                    <td>12-2-2022 <br> - <br> 14-2-2022</td>
                    <td>Day 1</td>
                </tr>
            </tbody>
        </table>

        <table style="width: 100%">
            <tbody>
                <tr>
                    <td colspan=4 class="table_title">
                        الطيران
                    </td>
                </tr>
                <tr>
                    <td>عدد المسافرين</td>
                    <td>من - إالي</td>
                    <td>التاريخ</td>
                    <td>اليوم</td>
                </tr>
                <tr>
                    <td>Room Title <br> Quantity: 1 <br> include breakfast</td>
                    <td>Cairo - Egypt <br> <a href="#">Hotel Name</a> (number Of Days)</span></td>
                    <td>12-2-2022 <br> - <br> 14-2-2022</td>
                    <td>Day 1</td>
                </tr>
                <tr>
                    <td>Room Title <br> Quantity: 1 <br> include breakfast</td>
                    <td>Cairo - Egypt <br> <a href="#">Hotel Name</a> (number Of Days)</span></td>
                    <td>12-2-2022 <br> - <br> 14-2-2022</td>
                    <td>Day 1</td>
                </tr>
                <tr>
                    <td>Room Title <br> Quantity: 1 <br> include breakfast</td>
                    <td>Cairo - Egypt <br> <a href="#">Hotel Name</a> (number Of Days)</span></td>
                    <td>12-2-2022 <br> - <br> 14-2-2022</td>
                    <td>Day 1</td>
                </tr>
            </tbody>
        </table>

        <table style="width: 100%">
            <tbody>
                <tr>
                    <td colspan=4 class="table_title">
                        المواصلات
                    </td>
                </tr>
                <tr>
                    <td>عدد السيارات ونوعها</td>
                    <td>الوصف</td>
                    <td>التاريخ</td>
                    <td>اليوم</td>
                </tr>
                <tr>
                    <td>Day 1</td>
                    <td>12-2-2022 <br> - <br> 14-2-2022</td>
                    <td>Cairo - Egypt <br> <a href="#">Hotel Name</a> (number Of Days)</span></td>
                    <td>Room Title <br> Quantity: 1 <br> include breakfast</td>
                </tr>
                <tr>
                    <td>Day 1</td>
                    <td>12-2-2022 <br> - <br> 14-2-2022</td>
                    <td>Cairo - Egypt <br> <a href="#">Hotel Name</a> (number Of Days)</span></td>
                    <td>Room Title <br> Quantity: 1 <br> include breakfast</td>
                </tr>
                <tr>
                    <td>Day 1</td>
                    <td>12-2-2022 <br> - <br> 14-2-2022</td>
                    <td>Cairo - Egypt <br> <a href="#">Hotel Name</a> (number Of Days)</span></td>
                    <td>Room Title <br> Quantity: 1 <br> include breakfast</td>
                </tr>
            </tbody>
        </table>

        <table style="width: 100%">
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
    </div>

</body>

</html>