<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservationRequest;
use App\Models\Activity;
use App\Models\City;
use App\Models\Country;
use App\Models\Customer;
use App\Models\Flight;
use App\Models\Hotel;
use App\Models\Reservation;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Mpdf\Mpdf;

class ReservationsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($pagination = PAGINATION)
    {
        $reservations = Reservation::where('deleted_at', null)->paginate($pagination, ['*'], 'page', $_GET['page'] ?? 1);
        return view('reservations/show', compact('reservations', 'pagination'));
    }

    public function add()
    {
        $customers = Customer::where('deleted_at', null)->get();
        $flights = Flight::where('deleted_at', null)->get();
        return view('reservations/add', compact('flights', 'customers'));
    }
 
    public function store(ReservationRequest $request)
    {
        while (true) {
            $reservation_id = substr(md5(rand()), 0, 15);
            $reservation = Reservation::where('reservation_id', $reservation_id)->first();
            if (!$reservation) {
                break;
            }
        }
        Reservation::create([
            'reservation_id' => $reservation_id,
            'customer_id' => $request->customer_id,
            'flight_id' => $request->flight_id,
            'date' => Carbon::createFromFormat('Y-m-d', $request->date),
        ]);
        return redirect(route('reservation.showAll'))->with('success',  __('view.reservationCreated', ['id' => $reservation_id]));
    }

    public function edit($reservationId)
    {
        $reservation = Reservation::where('deleted_at', null)->where('reservation_id', $reservationId)->first();
        if (!$reservation) {
            return redirect()->back()->with('error', __('view.wrong'));
        }
        $customers = Customer::where('deleted_at', null)->get();
        $flights = Flight::where('deleted_at', null)->get();
        return view('reservations/edit', compact('reservation', 'customers', 'flights'));
    }

    public function update(ReservationRequest $request)
    {
        $reservation = Reservation::where('deleted_at', null)->where('reservation_id', $request->reservation_id);
        if (!$reservation->first()) {
            return redirect()->back()->with('error', __('view.wrong'));
        }
        $reservation->update([
            'flight_id' => $request->flight_id ?? $reservation->first()->flight_id,
            'customer_id' => $request->customer_id ?? $reservation->first()->customer_id,
        ]);
        return redirect()->back()->with('success', __('view.reservationUpdated'));
    }

    public function delete($reservationId)
    {
        $reservation = Reservation::where('reservation_id', $reservationId);
        if (!$reservation) {
            return redirect()->back()->with('error', __('view.wrong'));
        }
        $reservation->update(['deleted_at' => now()]);
        return redirect(route('reservation.showAll'))->with('success', __('view.reservationDeleted'));
    }

    public function filter(Request $request)
    {
        $pagination = $request->pagination ?? PAGINATION;
        if (!$request->data) { // if There is no searching data return all hotels
            $reservations = Reservation::where('deleted_at', null)->paginate($pagination, ['*'], 'page', $request->page ?? 1);
            $data = '';
        } else {
            $data = $request->data;

            // Get reservations
            $reservations = Reservation::where('reservation_id', 'like', '%' . $request->data . '%')
            ->orWhere('customer_id', 'like', '%' . $request->data . '%')
            ->orWhere('flight_id', 'like', '%' . $request->data . '%')
            ->paginate($pagination, ['*'], 'page', $request->page ?? 1);
        }
        return view('reservations/show', compact('reservations', 'pagination', 'data'));
    }

    public function exportPdf($reservationId){
        $reservation = Reservation::where('reservation_id', $reservationId)->first();
        
        if(!$reservation) {
            return redirect()->back()->with('error', __('view.wrong'));
        }
        $customer = Customer::where('customer_id', $reservation->customer_id)->first();
        $flight = Flight::where('flight_id', $reservation->flight_id)->first();
        $countries = Country::all();
        $cities = City::all();
        $hotels = Hotel::where('deleted_at', null)->get();
        $activities = Activity::where('deleted_at', null)->get();
        $numberOfCustomers = Reservation::where('flight_id', $reservation->flight_id)->count();
        $view = view('reservations/pdf', [
            'reservation' => $reservation,
            'customer' => $customer,
            'flight' => $flight,
            'countries' => $countries,
            'cities' => $cities,
            'hotels' => $hotels,
            'activities' => $activities,
            'numberOfCustomers' => $numberOfCustomers,
        ])->render();

        // return view('reservations/pdf', compact('customer', 'activities', 'reservation', 'flight', 'countries', 'cities', 'hotels', 'activities', 'numberOfCustomers'));

        $time = time();
        $pdf = new \Mpdf\Mpdf();

        $pdf->defaultfooterline = 0;
        $pdf->setFooter(
            '<div style="text-align: left;">
                <svg class="icon" width="15" height="15" viewBox="0 -15 24 38" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path fill="white"  stroke="white" d="M0 0h24v24H0z" />
                    <path fill="#546cf7" stroke="#546cf7" d="M10 21v-6.5a3.5 3.5 0 0 0 -7 0v6.5h18v-6a4 4 0 0 0 -4 -4h-10.5" />
                    <path fill="#546cf7" stroke="#546cf7" d="M12 11v-8h4l2 2l-2 2h-4" />
                    <path fill="white" fill="Black" d="M6 15h1" />
                </svg>
                <span style="font-size: 10px">PO Box. 7155, Jeddah-23534, KSA</span> 


                <svg class="icon" width="15" height="15" viewBox="0 -15 24 38" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path fill="white" stroke="white" d="M0 0h24v24H0z" />
                    <path fill="white" stroke="white"  d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2" />
                </svg>


                <svg viewBox="0 -15 119.13 122.88" width="12" height="12" style="enable-background:new 0 0 119.13 122.88">
                    <style type="text/css">.st0{fill-rule:evenodd;clip-rule:evenodd;}</style>
                    <g>
                        <path fill="#546cf7" stoke="#546cf7" stroke-width="1" class="st0" d="M60.6,42.6h35.84v5.48H60.6V42.6L60.6,42.6z M5.64,23.89H9.5v82.76c0,3.92,3.21,7.12,7.12,7.12h23.12 c3.92,0,7.12-3.21,7.12-7.12V23.89h5.87V0h47.33l1.61,0.67l10.61,10.47l0.68,0.67v12.07l0.52,0c3.11,0,5.64,2.54,5.64,5.65v87.7 c0,3.1-2.54,5.65-5.64,5.65H5.64c-3.11,0-5.64-2.54-5.64-5.65l0-87.7C0,26.43,2.54,23.89,5.64,23.89L5.64,23.89z M57.34,53.1h51.03 V17.6H95.78V4.61H57.34V53.1L57.34,53.1L57.34,53.1z M107.61,12.99l-7.22-7.12v7.12H107.61L107.61,12.99z M60.6,21.12h43.93v5.48 l-43.93,0V21.12L60.6,21.12L60.6,21.12z M60.6,31.88h22.91v5.48l-22.91,0V31.88L60.6,31.88L60.6,31.88z M14.6,14.6h13.94V3.98h4.31 V14.6h8.63v92.68H14.6V14.6L14.6,14.6z M67.12,66.59c2.86,0,5.19,2.32,5.19,5.18c0,2.86-2.32,5.18-5.19,5.18 c-2.86,0-5.19-2.32-5.19-5.18C61.93,68.91,64.25,66.59,67.12,66.59L67.12,66.59z M82.85,97.87c2.86,0,5.18,2.32,5.18,5.18 c0,2.86-2.32,5.18-5.18,5.18c-2.86,0-5.19-2.32-5.19-5.18C77.66,100.19,79.99,97.87,82.85,97.87L82.85,97.87z M98.58,82.23 c2.86,0,5.19,2.32,5.19,5.18c0,2.86-2.32,5.19-5.19,5.19c-2.86,0-5.18-2.32-5.18-5.19C93.4,84.55,95.72,82.23,98.58,82.23 L98.58,82.23z M82.85,82.23c2.86,0,5.18,2.32,5.18,5.18c0,2.86-2.32,5.19-5.18,5.19c-2.86,0-5.19-2.32-5.19-5.19 C77.66,84.55,79.99,82.23,82.85,82.23L82.85,82.23z M67.12,82.23c2.86,0,5.19,2.32,5.19,5.18c0,2.86-2.32,5.19-5.19,5.19 c-2.86,0-5.19-2.32-5.19-5.19C61.93,84.55,64.25,82.23,67.12,82.23L67.12,82.23z M98.58,66.59c2.86,0,5.19,2.32,5.19,5.18 c0,2.86-2.32,5.18-5.19,5.18c-2.86,0-5.18-2.32-5.18-5.18C93.4,68.91,95.72,66.59,98.58,66.59L98.58,66.59z M82.85,66.59 c2.86,0,5.18,2.32,5.18,5.18c0,2.86-2.32,5.18-5.18,5.18c-2.86,0-5.19-2.32-5.19-5.18C77.66,68.91,79.99,66.59,82.85,66.59 L82.85,66.59z"/>
                    </g>
                </svg>
                <span style="font-size: 10px">92000 40 80</span> 


                <svg class="icon" width="15" height="15" viewBox="0 -15 24 38" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path fill="white" stroke="white" d="M0 0h24v24H0z" />
                    <path fill="white" stroke="white"  d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2" />
                </svg>



                <svg class="icon" width="15" height="17" viewBox="-5 -7 26 27" stroke-width="2" stroke="red" fill="red" stroke-linecap="round" stroke-linejoin="round">
                    <path fill="white" stroke="white" d="M0 0h24v24H0z" />
                    <path fill="#546cf7" stroke="#546cf7"  d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2" />
                </svg>
                <span style="font-size: 10px">+966 126044944</span> 


                <svg class="icon" width="15" height="15" viewBox="0 -15 24 38" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path fill="white" stroke="white" d="M0 0h24v24H0z" />
                    <path fill="white" stroke="white"  d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2" />
                </svg>



                <svg class="icon" width="15" height="15" viewBox="0 -60 25 80" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path fill="white" stroke="white" d="M0 0h24v24H0z" />
                    <circle fill="white" stroke="#546cf7" cx="12" cy="12" r="9" />
                    <line   fill="white" stroke="#546cf7" x1="3.6" y1="9" x2="20.4" y2="9" />
                    <line   fill="white" stroke="#546cf7" x1="3.6" y1="15" x2="20.4" y2="15" />
                    <path   fill="white" stroke="#546cf7" d="M11.5 3a17 17 0 0 0 0 18" />
                    <path   fill="white" stroke="#546cf7" d="M12.5 3a17 17 0 0 1 0 18" />
                </svg>
                <span style="font-size: 10px">www.formula.com.sa</span> 


                <svg class="icon" width="10" height="10" viewBox="0 -15 24 38" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path fill="white" stroke="white" d="M0 0h24v24H0z" />
                    <path fill="white" stroke="white"  d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2" />
                </svg>


                <a href="https://www.facebook.com/profile.php?id=100063259507751"><svg  class="icon facebook" width="15" height="15" viewBox="0 -15 24 38" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path fill="white" stroke="white" d="M0 0h24v24H0z" />
                    <path fill="#4267B2" stroke="#4267B2" d="M7 10v4h3v7h4v-7h3l1 -4h-4v-2a1 1 0 0 1 1 -1h3v-4h-3a5 5 0 0 0 -5 5v2h-3" />
                </svg></a>


                <svg class="icon" width="1" height="1" viewBox="0 -15 24 38" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path fill="white" stroke="white" d="M0 0h24v24H0z" />
                    <path fill="white" stroke="white"  d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2" />
                </svg>


                <a href="https://twitter.com/formula_ksa"><svg class="twitter icon" width="15" height="15" viewBox="0 -15 24 38" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path fill="white" stroke="white" d="M0 0h24v24H0z" />
                    <path fill="#1DA1F2" stroke="#1DA1F2" d="M22 4.01c-1 .49 -1.98 .689 -3 .99c-1.121 -1.265 -2.783 -1.335 -4.38 -.737s-2.643 2.06 -2.62 3.737v1c-3.245 .083 -6.135 -1.395 -8 -4c0 0 -4.182 7.433 4 11c-1.872 1.247 -3.739 2.088 -6 2c3.308 1.803 6.913 2.423 10.034 1.517c3.58 -1.04 6.522 -3.723 7.651 -7.742a13.84 13.84 0 0 0 .497 -3.753c-.002 -.249 1.51 -2.772 1.818 -4.013z" />
                </svg></a>


                <svg class="icon" width="1" height="1" viewBox="0 -15 24 38" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path fill="white" stroke="white" d="M0 0h24v24H0z" />
                    <path fill="white" stroke="white"  d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2" />
                </svg>


                <a href="https://www.instagram.com/formula_ksa/"><svg class="instagram icon" viewBox="0 -15 132.004 132" width="15" height="15">
                    <defs>
                        <linearGradient id="b">
                            <stop offset="0" stop-color="#3771c8"/>
                            <stop stop-color="#3771c8" offset=".128"/>
                            <stop offset="1" stop-color="#60f" stop-opacity="0"/>
                        </linearGradient>
                        <linearGradient id="a">
                            <stop offset="0" stop-color="#fd5"/>
                            <stop offset=".1" stop-color="#fd5"/>
                            <stop offset=".5" stop-color="#ff543e"/>
                            <stop offset="1" stop-color="#c837ab"/>
                        </linearGradient>
                        <radialGradient id="c" cx="158.429" cy="578.088" r="65" xlink:href="#a" gradientUnits="userSpaceOnUse" gradientTransform="matrix(0 -1.98198 1.8439 0 -1031.402 454.004)" fx="158.429" fy="578.088"/>
                        <radialGradient id="d" cx="147.694" cy="473.455" r="65" xlink:href="#b" gradientUnits="userSpaceOnUse" gradientTransform="matrix(.17394 .86872 -3.5818 .71718 1648.348 -458.493)" fx="147.694" fy="473.455"/>
                    </defs>
                    <path fill="url(#c)" d="M65.03 0C37.888 0 29.95.028 28.407.156c-5.57.463-9.036 1.34-12.812 3.22-2.91 1.445-5.205 3.12-7.47 5.468C4 13.126 1.5 18.394.595 24.656c-.44 3.04-.568 3.66-.594 19.188-.01 5.176 0 11.988 0 21.125 0 27.12.03 35.05.16 36.59.45 5.42 1.3 8.83 3.1 12.56 3.44 7.14 10.01 12.5 17.75 14.5 2.68.69 5.64 1.07 9.44 1.25 1.61.07 18.02.12 34.44.12 16.42 0 32.84-.02 34.41-.1 4.4-.207 6.955-.55 9.78-1.28 7.79-2.01 14.24-7.29 17.75-14.53 1.765-3.64 2.66-7.18 3.065-12.317.088-1.12.125-18.977.125-36.81 0-17.836-.04-35.66-.128-36.78-.41-5.22-1.305-8.73-3.127-12.44-1.495-3.037-3.155-5.305-5.565-7.624C116.9 4 111.64 1.5 105.372.596 102.335.157 101.73.027 86.19 0H65.03z" transform="translate(1.004 1)"/>
                    <path fill="url(#d)" d="M65.03 0C37.888 0 29.95.028 28.407.156c-5.57.463-9.036 1.34-12.812 3.22-2.91 1.445-5.205 3.12-7.47 5.468C4 13.126 1.5 18.394.595 24.656c-.44 3.04-.568 3.66-.594 19.188-.01 5.176 0 11.988 0 21.125 0 27.12.03 35.05.16 36.59.45 5.42 1.3 8.83 3.1 12.56 3.44 7.14 10.01 12.5 17.75 14.5 2.68.69 5.64 1.07 9.44 1.25 1.61.07 18.02.12 34.44.12 16.42 0 32.84-.02 34.41-.1 4.4-.207 6.955-.55 9.78-1.28 7.79-2.01 14.24-7.29 17.75-14.53 1.765-3.64 2.66-7.18 3.065-12.317.088-1.12.125-18.977.125-36.81 0-17.836-.04-35.66-.128-36.78-.41-5.22-1.305-8.73-3.127-12.44-1.495-3.037-3.155-5.305-5.565-7.624C116.9 4 111.64 1.5 105.372.596 102.335.157 101.73.027 86.19 0H65.03z" transform="translate(1.004 1)"/>
                    <path fill="#fff" d="M66.004 18c-13.036 0-14.672.057-19.792.29-5.11.234-8.598 1.043-11.65 2.23-3.157 1.226-5.835 2.866-8.503 5.535-2.67 2.668-4.31 5.346-5.54 8.502-1.19 3.053-2 6.542-2.23 11.65C18.06 51.327 18 52.964 18 66s.058 14.667.29 19.787c.235 5.11 1.044 8.598 2.23 11.65 1.227 3.157 2.867 5.835 5.536 8.503 2.667 2.67 5.345 4.314 8.5 5.54 3.054 1.187 6.543 1.996 11.652 2.23 5.12.233 6.755.29 19.79.29 13.037 0 14.668-.057 19.788-.29 5.11-.234 8.602-1.043 11.656-2.23 3.156-1.226 5.83-2.87 8.497-5.54 2.67-2.668 4.31-5.346 5.54-8.502 1.18-3.053 1.99-6.542 2.23-11.65.23-5.12.29-6.752.29-19.788 0-13.036-.06-14.672-.29-19.792-.24-5.11-1.05-8.598-2.23-11.65-1.23-3.157-2.87-5.835-5.54-8.503-2.67-2.67-5.34-4.31-8.5-5.535-3.06-1.187-6.55-1.996-11.66-2.23-5.12-.233-6.75-.29-19.79-.29zm-4.306 8.65c1.278-.002 2.704 0 4.306 0 12.816 0 14.335.046 19.396.276 4.68.214 7.22.996 8.912 1.653 2.24.87 3.837 1.91 5.516 3.59 1.68 1.68 2.72 3.28 3.592 5.52.657 1.69 1.44 4.23 1.653 8.91.23 5.06.28 6.58.28 19.39s-.05 14.33-.28 19.39c-.214 4.68-.996 7.22-1.653 8.91-.87 2.24-1.912 3.835-3.592 5.514-1.68 1.68-3.275 2.72-5.516 3.59-1.69.66-4.232 1.44-8.912 1.654-5.06.23-6.58.28-19.396.28-12.817 0-14.336-.05-19.396-.28-4.68-.216-7.22-.998-8.913-1.655-2.24-.87-3.84-1.91-5.52-3.59-1.68-1.68-2.72-3.276-3.592-5.517-.657-1.69-1.44-4.23-1.653-8.91-.23-5.06-.276-6.58-.276-19.398s.046-14.33.276-19.39c.214-4.68.996-7.22 1.653-8.912.87-2.24 1.912-3.84 3.592-5.52 1.68-1.68 3.28-2.72 5.52-3.592 1.692-.66 4.233-1.44 8.913-1.655 4.428-.2 6.144-.26 15.09-.27zm29.928 7.97c-3.18 0-5.76 2.577-5.76 5.758 0 3.18 2.58 5.76 5.76 5.76 3.18 0 5.76-2.58 5.76-5.76 0-3.18-2.58-5.76-5.76-5.76zm-25.622 6.73c-13.613 0-24.65 11.037-24.65 24.65 0 13.613 11.037 24.645 24.65 24.645C79.617 90.645 90.65 79.613 90.65 66S79.616 41.35 66.003 41.35zm0 8.65c8.836 0 16 7.163 16 16 0 8.836-7.164 16-16 16-8.837 0-16-7.164-16-16 0-8.837 7.163-16 16-16z"/>
                </svg></a>


                <svg class="icon" width="1" height="1" viewBox="0 -15 24 38" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path fill="white" stroke="white" d="M0 0h24v24H0z" />
                    <path fill="white" stroke="white"  d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2" />
                </svg>


                <a href="https://www.snapchat.com/add/formula_ksa"><svg class="snapchat icon" width="15" height="15" viewBox="147.353 39.286 514.631 514.631">
                    <path style="fill:#FFFC00;" d="M147.553,423.021v0.023c0.308,11.424,0.403,22.914,2.33,34.268	c2.042,12.012,4.961,23.725,10.53,34.627c7.529,14.756,17.869,27.217,30.921,37.396c9.371,7.309,19.608,13.111,30.94,16.771	c16.524,5.33,33.571,7.373,50.867,7.473c10.791,0.068,21.575,0.338,32.37,0.293c78.395-0.33,156.792,0.566,235.189-0.484	c10.403-0.141,20.636-1.41,30.846-3.277c19.569-3.582,36.864-11.932,51.661-25.133c17.245-15.381,28.88-34.205,34.132-56.924	c3.437-14.85,4.297-29.916,4.444-45.035v-3.016c0-1.17-0.445-256.892-0.486-260.272c-0.115-9.285-0.799-18.5-2.54-27.636	c-2.117-11.133-5.108-21.981-10.439-32.053c-5.629-10.641-12.68-20.209-21.401-28.57c-13.359-12.81-28.775-21.869-46.722-26.661	c-16.21-4.327-32.747-5.285-49.405-5.27c-0.027-0.004-0.09-0.173-0.094-0.255H278.56c-0.005,0.086-0.008,0.172-0.014,0.255	c-9.454,0.173-18.922,0.102-28.328,1.268c-10.304,1.281-20.509,3.21-30.262,6.812c-15.362,5.682-28.709,14.532-40.11,26.347	c-12.917,13.386-22.022,28.867-26.853,46.894c-4.31,16.084-5.248,32.488-5.271,49.008"/><path style="fill:#FFFFFF;" d="M407.001,473.488c-1.068,0-2.087-0.039-2.862-0.076c-0.615,0.053-1.25,0.076-1.886,0.076	c-22.437,0-37.439-10.607-50.678-19.973c-9.489-6.703-18.438-13.031-28.922-14.775c-5.149-0.854-10.271-1.287-15.22-1.287	c-8.917,0-15.964,1.383-21.109,2.389c-3.166,0.617-5.896,1.148-8.006,1.148c-2.21,0-4.895-0.49-6.014-4.311	c-0.887-3.014-1.523-5.934-2.137-8.746c-1.536-7.027-2.65-11.316-5.281-11.723c-28.141-4.342-44.768-10.738-48.08-18.484	c-0.347-0.814-0.541-1.633-0.584-2.443c-0.129-2.309,1.501-4.334,3.777-4.711c22.348-3.68,42.219-15.492,59.064-35.119	c13.049-15.195,19.457-29.713,20.145-31.316c0.03-0.072,0.065-0.148,0.101-0.217c3.247-6.588,3.893-12.281,1.926-16.916	c-3.626-8.551-15.635-12.361-23.58-14.882c-1.976-0.625-3.845-1.217-5.334-1.808c-7.043-2.782-18.626-8.66-17.083-16.773	c1.124-5.916,8.949-10.036,15.273-10.036c1.756,0,3.312,0.308,4.622,0.923c7.146,3.348,13.575,5.045,19.104,5.045	c6.876,0,10.197-2.618,11-3.362c-0.198-3.668-0.44-7.546-0.674-11.214c0-0.004-0.005-0.048-0.005-0.048	c-1.614-25.675-3.627-57.627,4.546-75.95c24.462-54.847,76.339-59.112,91.651-59.112c0.408,0,6.674-0.062,6.674-0.062	c0.283-0.005,0.59-0.009,0.908-0.009c15.354,0,67.339,4.27,91.816,59.15c8.173,18.335,6.158,50.314,4.539,76.016l-0.076,1.23	c-0.222,3.49-0.427,6.793-0.6,9.995c0.756,0.696,3.795,3.096,9.978,3.339c5.271-0.202,11.328-1.891,17.998-5.014	c2.062-0.968,4.345-1.169,5.895-1.169c2.343,0,4.727,0.456,6.714,1.285l0.106,0.041c5.66,2.009,9.367,6.024,9.447,10.242	c0.071,3.932-2.851,9.809-17.223,15.485c-1.472,0.583-3.35,1.179-5.334,1.808c-7.952,2.524-19.951,6.332-23.577,14.878	c-1.97,4.635-1.322,10.326,1.926,16.912c0.036,0.072,0.067,0.145,0.102,0.221c1,2.344,25.205,57.535,79.209,66.432	c2.275,0.379,3.908,2.406,3.778,4.711c-0.048,0.828-0.248,1.656-0.598,2.465c-3.289,7.703-19.915,14.09-48.064,18.438	c-2.642,0.408-3.755,4.678-5.277,11.668c-0.63,2.887-1.271,5.717-2.146,8.691c-0.819,2.797-2.641,4.164-5.567,4.164h-0.441	c-1.905,0-4.604-0.346-8.008-1.012c-5.95-1.158-12.623-2.236-21.109-2.236c-4.948,0-10.069,0.434-15.224,1.287	c-10.473,1.744-19.421,8.062-28.893,14.758C444.443,462.88,429.436,473.488,407.001,473.488"/><path style="fill:#020202;" d="M408.336,124.235c14.455,0,64.231,3.883,87.688,56.472c7.724,17.317,5.744,48.686,4.156,73.885	c-0.248,3.999-0.494,7.875-0.694,11.576l-0.084,1.591l1.062,1.185c0.429,0.476,4.444,4.672,13.374,5.017l0.144,0.008l0.15-0.003	c5.904-0.225,12.554-2.059,19.776-5.442c1.064-0.498,2.48-0.741,3.978-0.741c1.707,0,3.521,0.321,5.017,0.951l0.226,0.09	c3.787,1.327,6.464,3.829,6.505,6.093c0.022,1.28-0.935,5.891-14.359,11.194c-1.312,0.518-3.039,1.069-5.041,1.7	c-8.736,2.774-21.934,6.96-26.376,17.427c-2.501,5.896-1.816,12.854,2.034,20.678c1.584,3.697,26.52,59.865,82.631,69.111	c-0.011,0.266-0.079,0.557-0.229,0.9c-0.951,2.24-6.996,9.979-44.612,15.783c-5.886,0.902-7.328,7.5-9,15.17	c-0.604,2.746-1.218,5.518-2.062,8.381c-0.258,0.865-0.306,0.914-1.233,0.914c-0.128,0-0.278,0-0.442,0	c-1.668,0-4.2-0.346-7.135-0.922c-5.345-1.041-12.647-2.318-21.982-2.318c-5.21,0-10.577,0.453-15.962,1.352	c-11.511,1.914-20.872,8.535-30.786,15.543c-13.314,9.408-27.075,19.143-48.071,19.143c-0.917,0-1.812-0.031-2.709-0.076	l-0.236-0.01l-0.237,0.018c-0.515,0.045-1.034,0.068-1.564,0.068c-20.993,0-34.76-9.732-48.068-19.143	c-9.916-7.008-19.282-13.629-30.791-15.543c-5.38-0.896-10.752-1.352-15.959-1.352c-9.333,0-16.644,1.428-21.978,2.471	c-2.935,0.574-5.476,1.066-7.139,1.066c-1.362,0-1.388-0.08-1.676-1.064c-0.844-2.865-1.461-5.703-2.062-8.445	c-1.676-7.678-3.119-14.312-9.002-15.215c-37.613-5.809-43.659-13.561-44.613-15.795c-0.149-0.352-0.216-0.652-0.231-0.918	c56.11-9.238,81.041-65.408,82.63-69.119c3.857-7.818,4.541-14.775,2.032-20.678c-4.442-10.461-17.638-14.653-26.368-17.422	c-2.007-0.635-3.735-1.187-5.048-1.705c-11.336-4.479-14.823-8.991-14.305-11.725c0.601-3.153,6.067-6.359,10.837-6.359	c1.072,0,2.012,0.173,2.707,0.498c7.747,3.631,14.819,5.472,21.022,5.472c9.751,0,14.091-4.537,14.557-5.055l1.057-1.182	l-0.085-1.583c-0.197-3.699-0.44-7.574-0.696-11.565c-1.583-25.205-3.563-56.553,4.158-73.871	c23.37-52.396,72.903-56.435,87.525-56.435c0.36,0,6.717-0.065,6.717-0.065C407.744,124.239,408.033,124.235,408.336,124.235 M408.336,115.197h-0.017c-0.333,0-0.646,0-0.944,0.004c-2.376,0.024-6.282,0.062-6.633,0.066c-8.566,0-25.705,1.21-44.115,9.336	c-10.526,4.643-19.994,10.921-28.14,18.66c-9.712,9.221-17.624,20.59-23.512,33.796c-8.623,19.336-6.576,51.905-4.932,78.078	l0.006,0.041c0.176,2.803,0.361,5.73,0.53,8.582c-1.265,0.581-3.316,1.194-6.339,1.194c-4.864,0-10.648-1.555-17.187-4.619	c-1.924-0.896-4.12-1.349-6.543-1.349c-3.893,0-7.997,1.146-11.557,3.239c-4.479,2.63-7.373,6.347-8.159,10.468	c-0.518,2.726-0.493,8.114,5.492,13.578c3.292,3.008,8.128,5.782,14.37,8.249c1.638,0.645,3.582,1.261,5.641,1.914	c7.145,2.271,17.959,5.702,20.779,12.339c1.429,3.365,0.814,7.793-1.823,13.145c-0.069,0.146-0.138,0.289-0.201,0.439	c-0.659,1.539-6.807,15.465-19.418,30.152c-7.166,8.352-15.059,15.332-23.447,20.752c-10.238,6.617-21.316,10.943-32.923,12.855	c-4.558,0.748-7.813,4.809-7.559,9.424c0.078,1.33,0.39,2.656,0.931,3.939c0.004,0.008,0.009,0.016,0.013,0.023	c1.843,4.311,6.116,7.973,13.063,11.203c8.489,3.943,21.185,7.26,37.732,9.855c0.836,1.59,1.704,5.586,2.305,8.322	c0.629,2.908,1.285,5.898,2.22,9.074c1.009,3.441,3.626,7.553,10.349,7.553c2.548,0,5.478-0.574,8.871-1.232	c4.969-0.975,11.764-2.305,20.245-2.305c4.702,0,9.575,0.414,14.48,1.229c9.455,1.574,17.606,7.332,27.037,14	c13.804,9.758,29.429,20.803,53.302,20.803c0.651,0,1.304-0.021,1.949-0.066c0.789,0.037,1.767,0.066,2.799,0.066	c23.88,0,39.501-11.049,53.29-20.799l0.022-0.02c9.433-6.66,17.575-12.41,27.027-13.984c4.903-0.814,9.775-1.229,14.479-1.229	c8.102,0,14.517,1.033,20.245,2.15c3.738,0.736,6.643,1.09,8.872,1.09l0.218,0.004h0.226c4.917,0,8.53-2.699,9.909-7.422	c0.916-3.109,1.57-6.029,2.215-8.986c0.562-2.564,1.46-6.674,2.296-8.281c16.558-2.6,29.249-5.91,37.739-9.852	c6.931-3.215,11.199-6.873,13.053-11.166c0.556-1.287,0.881-2.621,0.954-3.979c0.261-4.607-2.999-8.676-7.56-9.424	c-51.585-8.502-74.824-61.506-75.785-63.758c-0.062-0.148-0.132-0.295-0.205-0.438c-2.637-5.354-3.246-9.777-1.816-13.148	c2.814-6.631,13.621-10.062,20.771-12.332c2.07-0.652,4.021-1.272,5.646-1.914c7.039-2.78,12.07-5.796,15.389-9.221	c3.964-4.083,4.736-7.995,4.688-10.555c-0.121-6.194-4.856-11.698-12.388-14.393c-2.544-1.052-5.445-1.607-8.399-1.607	c-2.011,0-4.989,0.276-7.808,1.592c-6.035,2.824-11.441,4.368-16.082,4.588c-2.468-0.125-4.199-0.66-5.32-1.171	c0.141-2.416,0.297-4.898,0.458-7.486l0.067-1.108c1.653-26.19,3.707-58.784-4.92-78.134c-5.913-13.253-13.853-24.651-23.604-33.892	c-8.178-7.744-17.678-14.021-28.242-18.661C434.052,116.402,416.914,115.197,408.336,115.197"/><rect x="147.553" y="39.443" style="fill:none;" width="514.231" height="514.23"/>
                </svg></a>


                <svg class="icon" width="1" height="1" viewBox="0 -15 24 38" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path fill="white" stroke="white" d="M0 0h24v24H0z" />
                    <path fill="white" stroke="white"  d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2" />
                </svg>


                <a href=""><svg class="linked-in icon" viewBox="0 0 48 48" width="15px" height="15px">
                    <path fill="#0288d1" d="M8.421 14h.052 0C11.263 14 13 12 13 9.5 12.948 6.945 11.263 5 8.526 5 5.789 5 4 6.945 4 9.5 4 12 5.736 14 8.421 14zM4 17H13V43H4zM44 26.5c0-5.247-4.253-9.5-9.5-9.5-3.053 0-5.762 1.446-7.5 3.684V17h-9v26h9V28h0c0-2.209 1.791-4 4-4s4 1.791 4 4v15h9C44 43 44 27.955 44 26.5z"/>
                </svg></a>


                <svg class="icon" width="2" height="2" viewBox="0 -15 24 38" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path fill="white" stroke="white" d="M0 0h24v24H0z" />
                    <path fill="white" stroke="white"  d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2" />
                </svg>


                <span style="margin-left: 30mm; font-size: 10px">@formula_KSA</span> 
        </div>'
        );

        $pdf->WriteHTML($view);
        $pdf->SetDirectionality('ltr');
        $pdf->WriteHTML('');
        $pdf->Output(public_path('Reservation_' . $time . '.pdf'));
        return Response::download(public_path('Reservation_' . $time . '.pdf'), 'Reservation.pdf')->deleteFileAfterSend(true);
    }
}
