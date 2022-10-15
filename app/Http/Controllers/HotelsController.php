<?php

namespace App\Http\Controllers;

use App\Http\Requests\HotelRequest;
use App\Models\City;
use App\Models\Country;
use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HotelsController extends Controller
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
        $hotels = Hotel::where('deleted_at', null)->paginate($pagination);
        foreach ($hotels as $hotel) {
            $hotel->countryName = Country::where('code', $hotel->country)->first()->name ?? '';
            $hotel->city = City::where('id', $hotel->city)->first()->name ?? '';
            $hotel->rooms = count(json_decode($hotel->rooms, TRUE));
        }
        return view('hotels/show', compact('hotels', 'pagination'));
    }

    public function add()
    {
        $countries = Country::all();
        return view('hotels/add', compact('countries'));
    }
 
    public function store(HotelRequest $request)
    {
        Hotel::create([
            'name' => $request->name,
            'url' => $request->url,
            'country' => $request->country,
            'city' => $request->city,
            'rooms' => $request->rooms,
        ]);
        return redirect(route('hotel.showAll'))->with('success', $request->name . ' Hotel Saved Successfully');
    }

    public function edit($hotelId)
    {
        $hotel = Hotel::where('deleted_at', null)->where('id', $hotelId)->first();
        if (!$hotel) {
            return redirect()->back()->with('error', 'Something Went Wrong');
        }
        $countries = Country::all();
        $cities = City::where('country_code', $hotel->country)->get();
        return view('hotels/edit', compact('hotel', 'countries', 'cities'));
    }

    public function update(HotelRequest $request)
    {
        $hotel = Hotel::where('deleted_at', null)->where('id', $request->id);
        if (!$hotel->first()) {
            return redirect()->back()->with('error', 'Something Went Wrong');
        }
        $hotel->update([
            'name' => $request->name ?? $hotel->first()->name,
            'url' => $request->url ?? $hotel->first()->url,
            'country' => $request->country ?? $hotel->first()->country,
            'city' => $request->city ?? $hotel->first()->city,
            'rooms' => $request->rooms ?? $hotel->first()->rooms,
        ]);
        return redirect()->back()->with('success', $request->name . ' Hotel Saved Successfully');
    }

    public function delete($hotelId)
    {
        $hotel = Hotel::where('id', $hotelId);
        if (!$hotel) {
            return redirect()->back()->with('error', 'Something Went Wrong');
        }
        $HotelName = $hotel->first()->name;
        $hotel->update(['deleted_at' => now()]);
        return redirect(route('hotel.showAll'))->with('success', $HotelName . ' Hotel Deleted Successfully');
    }

    public function filter(Request $request)
    {
        $pagination = $request->pagination ?? PAGINATION;
        if (!$request->data) { // if There is no searching data return all hotels
            $hotels = Hotel::where('deleted_at', null)->paginate($pagination, ['*'], 'page', $request->page ?? 1);
            $data = '';
        } else {
            $data = $request->data;
            $countryCode = $cityId = '';

            // Get Country Code From its Name
            $country = Country::where('name', 'like', '%' . $request->data . '%')->first();
            if ($country) $countryCode = $country->code;

            // Get City id From its Name
            $city = City::where('name', 'like', '%' . $request->data . '%')->first();
            if ($city) $cityId = $city->id;
            // Get Hotels
            $hotels = Hotel::where('country', 'like', '%' . $countryCode != "" ? $countryCode : "1322" . '%')
            ->orWhere('city', 'like', '%' . $cityId != "" ? $cityId : "dummy" . '%')
            ->orWhere('name', 'like', '%' . $request->data . '%')
                ->orWhere('url', 'like', '%' . $request->data . '%')
                ->paginate($pagination, ['*'], 'page', $request->page ?? 1);

            // Representong the Contry Name and City Name for Each Hotel
            foreach ($hotels as $hotel) {
                $hotel->countryName = Country::where('code', $hotel->country)->first()->name ?? '';
                $hotel->city = City::where('id', $hotel->city)->first()->name ?? '';
                $hotel->rooms = count(json_decode($hotel->rooms, TRUE));
            }
        }
        return view('hotels/show', compact('hotels', 'pagination', 'data'));
    }
}