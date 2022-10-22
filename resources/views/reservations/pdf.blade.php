<!doctype html>
@php

@endphp
<html>

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
                        اسم العميل: &nbsp;<span> Ahmed Wael </span>
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

        <div class="table_title">حجز الفنادق </div>
        <hr>
        <table style="width: 100%">
            <tbody>
                <tr>
                    <td>Day</td>
                    <td>Entry Date <br> - <br> Exit Date</td>
                    <td>Hotel Name & City <br> <span>Click on the Hotel Name To View The Hotel Images And Videos</span></td>
                    <td>Number & Type of Rooms</td>
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

        <div class="table_title">الطيران</div>
        <table style="width: 100%">
            <tbody>
                <tr>
                    <td>Day</td>
                    <td>Entry Date <br> - <br> Exit Date</td>
                    <td>Hotel Name & City <br> <span>Click on the Hotel Name To View The Hotel Images And Videos</span></td>
                    <td>Number & Type of Rooms</td>
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
            <thead>
                <tr>
                    <th colspan=4>
                        <span style="margin: 0 340px"> Activites </span>
                        <span style="vertical-align: middle">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <circle cx="7" cy="17" r="2" />
                                <circle cx="17" cy="17" r="2" />
                                <path d="M5 17h-2v-6l2 -5h9l4 5h1a2 2 0 0 1 2 2v4h-2m-4 0h-6m-6 -6h15m-6 0v-5" />
                            </svg>
                        </span>

                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Day</td>
                    <td>Entry Date <br> - <br> Exit Date</td>
                    <td>Hotel Name & City <br> <span>Click on the Hotel Name To View The Hotel Images And Videos</span></td>
                    <td>Number & Type of Rooms</td>
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
            <thead>
                <tr>
                    <th style="min-width: 100%;text-align: center">
                        Notes
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="min-width: 100%;text-align: left">
                        sdfffffffffffffffflmsdflmdsflmdsfldsmfdsmfksdnfdmf <br> sdfdsfdfdfsd fdsfsdfdsfsad asdwasdasfasd
                        sdfffffffffffffffflmsdflmdsflmdsfldsmfdsmfksdnfdmf <br> sdfdsfdfdfsd fdsfsdfdsfsad asdwasdasfasd
                        sdfffffffffffffffflmsdflmdsflmdsfldsmfdsmfksdnfdmf <br> sdfdsfdfdfsd fdsfsdfdsfsad asdwasdasfasd
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

</body>

</html>