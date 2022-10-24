<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservationRequest;
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
            $reservation_id = md5(rand());
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
        $hotels = Hotel::all();

        $view = view('reservations/pdf', [
            'reservation' => $reservation,
            'customer' => $customer,
            'flight' => $flight,
            'countries' => $countries,
            'cities' => $cities,
            'hotels' => $hotels
        ])->render();

        $time = time();
        $pdf = new \Mpdf\Mpdf();
        $pdf->setFooter('<div style="text-align: center"><p>{PAGENO} من {nbpg}</p></div>');
        $pdf->WriteHTML($view);
        $pdf->SetDirectionality('rtl');
        $pdf->Output(public_path('pdfs/Reservation_' . $time . '.pdf'));
        return Response::download(public_path('pdfs/Reservation_' . $time . '.pdf'), 'Reservation.pdf')->deleteFileAfterSend(true);
    }
}
