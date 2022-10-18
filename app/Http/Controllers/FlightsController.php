<?php

namespace App\Http\Controllers;

use App\Http\Requests\FlightRequest;
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
        return view('flights/add', compact('hotels'));
    }

    public function store(FlightRequest $request)
    {
        while (true) {
            $flight_id = md5(rand());
            $flight = Flight::where('flight_id', $flight_id)->first();
            if (!$flight) {
                break;
            }
        }
        Flight::create([
            'flight_id' => $flight_id,
            'start_date' => Carbon::createFromFormat('Y-m-d', $request->start_date),
            'end_date' => Carbon::createFromFormat('Y-m-d', $request->end_date),
            'airports' => $request->airports,
            'hotels' => $request->hotels,
            'activities' => $request->activities,
            'notes' => $request->notes,
        ]);
        return redirect(route('flight.showAll'))->with('success', 'Flight created Successfully with id : ' .  $flight_id);
    }

    public function edit($flightId)
    {
        $flight = Flight::where('deleted_at', null)->where('flight_id', $flightId)->first();
        if (!$flight) {
            return redirect()->back()->with('error', 'Something Went Wrong');
        }

        $hotels = Hotel::all();
        return view('flights/edit', compact('flight', 'hotels'));
    }

    public function update(FlightRequest $request)
    {
        $flight = flight::where('deleted_at', null)->where('flight_id', $request->flight_id);
        if (!$flight->first()) {
            return redirect()->back()->with('error', 'Something Went Wrong');
        }
        $flight->update([
            'start_date' => Carbon::createFromFormat('Y-m-d', $request->start_date) ?? $flight->first()->start_date,
            'end_date' => Carbon::createFromFormat('Y-m-d', $request->end_date) ?? $flight->first()->end_date,
            'airports' => $request->airports ?? $flight->first()->airports,
            'hotels' => $request->hotels ?? $flight->first()->hotels,
            'activities' => $request->activities ?? $flight->first()->activities,
            'notes' => $request->notes ?? $flight->first()->notes,
        ]);
        return redirect()->back()->with('success', ' Flight with id ' . $request->flight_id . ' updated Successfully');
    }

    public function delete($flightId)
    {
        $flight = Flight::where('flight_id', $flightId);
        if (!$flight) {
            return redirect()->back()->with('error', 'Something Went Wrong');
        }
        $flight->update(['deleted_at' => now()]);
        return redirect(route('flight.showAll'))->with('success', 'Flight with id ' . $flightId . ' Deleted Successfully');
    }

    public function filter(Request $request)
    {
        // $pagination = $request->pagination ?? PAGINATION;
        // if (!$request->data) { // if There is no searching data return all hotels
        //     $hotels = Hotel::where('deleted_at', null)->paginate($pagination, ['*'], 'page', $request->page ?? 1);
        //     $data = '';
        // } else {
        //     $data = $request->data;
        //     $countryCode = $cityId = '';

        //     // Get Country Code From its Name
        //     $country = Country::where('name', 'like', '%' . $request->data . '%')->first();
        //     if ($country) $countryCode = $country->code;

        //     // Get City id From its Name
        //     $city = City::where('name', 'like', '%' . $request->data . '%')->first();
        //     if ($city) $cityId = $city->id;
        //     // Get Hotels
        //     $hotels = Hotel::where('country', 'like', '%' . $countryCode != "" ? $countryCode : "1322" . '%')
        //         ->orWhere('city', 'like', '%' . $cityId != "" ? $cityId : "dummy" . '%')
        //         ->orWhere('name', 'like', '%' . $request->data . '%')
        //         ->orWhere('url', 'like', '%' . $request->data . '%')
        //         ->paginate($pagination, ['*'], 'page', $request->page ?? 1);
        // }
        // // Representing the Country Name and City Name for Each Hotel
        // foreach ($hotels as $hotel) {
        //     $hotel->countryName = Country::where('code', $hotel->country)->first()->name ?? '';
        //     $hotel->city = City::where('id', $hotel->city)->first()->name ?? '';
        //     $hotel->rooms = count(json_decode($hotel->rooms, TRUE));
        // }
        return view('flights/show');
    }
}

