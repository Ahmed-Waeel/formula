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
        // $pdf->setFooter('<div style="text-align: center"><p>{PAGENO} من {nbpg}</p></div>');

        $footer = '
            <div style="text-align: center">
                <span>
                    PO Box. 7155, Jeddah-23534, KSA
                </span>

                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;

                <span>
                    92000&nbsp;40&nbsp;80
                </span>

                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;

                <span>
                    966&nbsp;126044944+
                </span>

                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;

                <span>
                    www.formula.com.sa
                </span>

                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;

                <span>
                    @formula_KSA
                </span>
            </div>';
        // $pdf->SetHTMLFooter(`<img src="` . public_path('footer.png') . `" style="widht: 100% height: 40px">`);
        // $pdf->setFooter('<div style="text-align: center"><p>{PAGENO} من {nbpg}</p></div>');
        $pdf->WriteHTML($view);
        // $pdf->Image(public_path('footer.png'), 3, 280, 203, 15, 'png', 'https://www.linkedin.com/in/ahmeed-waael/', true, false);
        $pdf->Image(public_path('static/pdf/post icon.jpeg'), 8, 290, 4, 4, 'jpeg', '', true, false);
        $pdf->Image(public_path('static/pdf/1.jpeg'), 12, 290, 40, 4, 'jpeg', '', true, false);

        $pdf->Image(public_path('static/pdf/Telephone icon.jpeg'), 56, 290, 4, 4, 'jpeg', '', true, false);
        $pdf->Image(public_path('static/pdf/2.jpeg'), 60, 291, 20, 2, 'jpeg', '', true, false);

        $pdf->Image(public_path('static/pdf/fax icon.jpeg'), 87, 290, 4, 4, 'jpeg', '', true, false);
        $pdf->Image(public_path('static/pdf/3.jpeg'), 91, 291, 25, 2.5, 'jpeg', '', true, false);

        $pdf->Image(public_path('static/pdf/web icon.jpeg'), 118, 290, 4, 4, 'jpeg', '', true, false);
        $pdf->Image(public_path('static/pdf/4.jpeg'), 122, 290, 35, 3.5, 'jpeg', '', true, false);

        $pdf->Image(public_path('static/pdf/facebook icon.jpeg'), 161, 290, 4, 4, 'jpeg', '', true, false);
        $pdf->Image(public_path('static/pdf/twitter icon.jpeg'), 165, 290, 4, 4, 'jpeg', '', true, false);
        $pdf->Image(public_path('static/pdf/instagram icon.jpeg'), 169, 290, 4, 4, 'jpeg', '', true, false);
        $pdf->Image(public_path('static/pdf/snapchat icon.jpeg'), 173, 290, 4, 4, 'jpeg', '', true, false);
        $pdf->Image(public_path('static/pdf/linked icon.jpeg'), 177, 290, 4, 4, 'jpeg', '', true, false);

        $pdf->Image(public_path('static/pdf/5.jpeg'), 182, 290.5, 22, 3, 'jpeg', '', true, false);

        $pdf->Image(public_path('static/pdf/line 1.jpeg'), 8, 285, 65, 3, 'jpeg', '', true, false);
        $pdf->Image(public_path('static/pdf/line 2.jpeg'), 73, 285, 65, 3, 'jpeg', '', true, false);
        $pdf->Image(public_path('static/pdf/line 3.jpeg'), 138, 285, 65, 3, 'jpeg', '', true, false);
        $pdf->SetDirectionality('rtl');
        $pdf->Output(public_path('pdfs/Reservation_' . $time . '.pdf'));
        return Response::download(public_path('pdfs/Reservation_' . $time . '.pdf'), 'Reservation.pdf')->deleteFileAfterSend(true);
    }
}
