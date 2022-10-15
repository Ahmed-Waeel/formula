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
        if (!$request->data) {
            $hotels = Hotel::where('deleted_at', null)->paginate($pagination, ['*'], 'page', $request->page ?? 1);
            $data = '';
        } else {
            $data = $request->data;
            $hotels = Hotel::where('name', 'like', '%' . $request->data . '%')
                ->orWhere('url', 'like', '%' . $request->data . '%')
                ->paginate($pagination, ['*'], 'page', $request->page ?? 1);

            foreach ($hotels as $hotel) {
                $hotel->countryName = Country::where('code', $hotel->country)->first()->name ?? '';
                $hotel->city = City::where('id', $hotel->city)->first()->name ?? '';
            }
        }
        return view('hotels/show', compact('hotels', 'pagination', 'data'));
    }
}

// ->orWhere('country', 'like', '%' . $countryCode . '%')
//             ->orWhere('city', 'like', '%' . $cityId . '%')


// $pagination = $request->pagination ?? $pagination;
//         if (!$request->data && !$data) {
//             $hotels = Hotel::where('deleted_at', null)->paginate($pagination)->page;
//             $data = '';
//         } elseif ($request->data || $data) {
//             $data = $request->data ?? $data;
//             $countryCode = $cityId = '';
//             $country = Country::where('name', 'like', '%' . $request->data . '%')->first();
//             if ($country) $countryCode = $country->code;

//             $city = City::where('name', 'like', '%' . $request->data . '%')->first();
//             if ($city) $cityId = $city->id;

//             $hotels = Hotel::where('name', 'like', '%' . $request->data . '%')
//                 ->orWhere('url', 'like', '%' . $request->data . '%')
//             ->paginate($pagination);

//             foreach ($hotels as $hotel) {
//                 $hotel->countryName = Country::where('code', $hotel->country)->first()->name ?? '';
//                 $hotel->city = City::where('id', $hotel->city)->first()->name ?? '';
//             }
//         }