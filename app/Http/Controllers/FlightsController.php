<?php

namespace App\Http\Controllers;

use App\Http\Requests\FlightRequest;
use App\Models\Activity;
use App\Models\Country;
use App\Models\Flight;
use App\Models\Hotel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FlightsController extends Controller
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
        $flights = Flight::where('deleted_at', null)->paginate($pagination);
        return view('flights/show', compact('flights'));
    }

    public function add()
    {
        $hotels = Hotel::where('deleted_at', null)->get();
        $activities = Activity::where('deleted_at', null)->get();
        $countries = Country::all();

        return view('flights/add', compact('hotels', 'activities', 'countries'));
    }

    public function store(FlightRequest $request)
    {
        if (!$request->start_date) return redirect()->back()->withInput()->with('error', __('validation.startDateValidation'));
        if (!$request->end_date) return redirect()->back()->withInput()->with('error', __('validation.endDateValidation'));
        if (!$request->price || !preg_match("/^[0-9]*$/", $request->price)) return redirect()->back()->withInput()->with('error', __('validation.priceError'));
        if ($request->deposite && !preg_match("/^[0-9]*$/", $request->deposite)) return redirect()->back()->withInput()->with('error', __('validation.depositeError'));
        if (!$request->num_passengers) return redirect()->back()->withInput()->with('error', __('validation.numPassengersError'));

        while (true) {
            $flight_id = substr(md5(rand()), 0, 15);
            $flight = Flight::where('flight_id', $flight_id)->first();
            if (!$flight) {
                break;
            }
        }
        Flight::create([
            'flight_id' => $flight_id,
            'start_date' => Carbon::createFromFormat('Y-m-d', $request->start_date),
            'end_date' => Carbon::createFromFormat('Y-m-d', $request->end_date),
            'international_flights_cost' => $request->international_flights_cost ?? 0,
            'price' => $request->price ?? 0,
            'deposite' => $request->deposite ?? 0,
            'num_passengers' => $request->num_passengers,
            'options' => $request->options ?? '[]',
            'flight_to' => $request->flight_to ?? "",
            'notes' => $request->notes ?? "",
        ]);
        return redirect(route('flight.showAll'))->with('success', __('view.flightCreated', ['id' => $flight_id]));
    }

    public function edit($flightId)
    {
        $flight = Flight::where('deleted_at', null)->where('flight_id', $flightId)->first();
        if (!$flight) {
            return redirect()->back()->with('error', __('view.wrong'));
        }

        $hotels = Hotel::where('deleted_at', null)->get();
        $countries = Country::all();
        $activities = Activity::where('deleted_at', null)->get();
        return view('flights/edit', compact('flight', 'hotels', 'activities', 'countries'));
    }

    public function update(FlightRequest $request)
    {
        if (!$request->start_date) return redirect()->back()->withInput()->with('error', __('validation.startDateValidation'));
        if (!$request->end_date) return redirect()->back()->withInput()->with('error', __('validation.endDateValidation'));
        if (!$request->price || !preg_match("/^[0-9]*$/", $request->price)) return redirect()->back()->withInput()->with('error', __('validation.priceError'));
        if ($request->deposite && !preg_match("/^[0-9]*$/", $request->deposite)) return redirect()->back()->withInput()->with('error', __('validation.depositeError'));
        if ($request->deposite && $request->deposite > $request->price) return redirect()->back()->withInput()->with('error', __('validation.depositeLargerThanPriceError'));
        if (!$request->num_passengers) return redirect()->back()->withInput()->with('error', __('validation.numPassengersError'));

        $flight = Flight::where('deleted_at', null)->where('flight_id', $request->flight_id);
        if (!$flight->first()) {
            return redirect()->back()->with('error', __('view.wrong'));
        }
        $flight->update(['start_date' => Carbon::createFromFormat('Y-m-d', $request->start_date),
            'end_date' => Carbon::createFromFormat('Y-m-d', $request->end_date),
            'international_flights_cost' => $request->international_flights_cost ?? 0,
            'price' => $request->price ?? $flight->first()->price,
            'deposite' => $request->deposite ?? 0,
            'num_passengers' => $request->num_passengers ?? $flight->first()->num_passengers,
            'options' => $request->options ?? $flight->first()->options,
            'flight_to' => $request->flight_to ?? "",
            'notes' => $request->notes ?? "",
        ]);
        return redirect()->back()->with('success', __('view.flightUpdated'));
    }

    public function delete($flightId)
    {
        $flight = Flight::where('flight_id', $flightId);
        if (!$flight) {
            return redirect()->back()->with('error', __('view.wrong'));
        }
        $flight->update(['deleted_at' => now()]);
        
        return redirect(route('flight.showAll'))->with('success', __('view.flightDeleted'));
    }

    public function filter(Request $request)
    {
        $pagination = $request->pagination ?? PAGINATION;
        if (!$request->data) { // if There is no searching data return all hotels
            $flights = Flight::where('deleted_at', null)->paginate($pagination, ['*'], 'page', $request->page ?? 1);
            $data = '';
        } else {
            $data = $request->data;
            
            $flights = Flight::where(function($query) use ($data){
                     $query->where('deleted_at', null);
                     $query->where('flight_id', "like",  "%".$data. "%");
                })
                ->paginate($pagination, ['*'], 'page', $request->page ?? 1);
        }
        return view('flights/show', compact('flights', 'data', 'pagination'));
    }
}

