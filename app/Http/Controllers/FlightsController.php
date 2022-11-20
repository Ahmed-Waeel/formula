<?php

namespace App\Http\Controllers;

use App\Http\Requests\FlightRequest;
use App\Models\Activity;
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
        return view('flights/add', compact('hotels', 'activities'));
    }

    public function store(FlightRequest $request)
    {
        // return json_encode($request->options);
        if (!$request->start_date) return redirect()->back()->with('error', __('validation.startDateValidation'));
        if (!$request->end_date) return redirect()->back()->with('error', __('validation.endDateValidation'));
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
            'options' => $request->options,
            'notes' => $request->notes,
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
        $activities = Activity::where('deleted_at', null)->get();
        return view('flights/edit', compact('flight', 'hotels', 'activities'));
    }

    public function update(FlightRequest $request)
    {
        $flight = Flight::where('deleted_at', null)->where('flight_id', $request->flight_id);
        if (!$flight->first()) {
            return redirect()->back()->with('error', __('view.wrong'));
        }
        $flight->update([
            'start_date' => Carbon::createFromFormat('Y-m-d', $request->start_date) ?? $flight->first()->start_date,
            'end_date' => Carbon::createFromFormat('Y-m-d', $request->end_date) ?? $flight->first()->end_date,
            'options' => $request->options ?? $flight->first()->options,
            'notes' => $request->notes ?? $flight->first()->notes,
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
            
            $flights = Flight::where('flight_id', $request->data)
                ->paginate($pagination, ['*'], 'page', $request->page ?? 1);
        }
        return view('flights/show', compact('flights', 'data', 'pagination'));
    }
}

