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
        $hotels = Hotel::where('deleted_at', null)->paginate($pagination, ['*'], 'page', $_GET['page'] ?? 1);
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
        $rooms = json_decode($request->rooms, TRUE);
        for ($i = 1; $i < count($_FILES['rooms_image']['size']); $i++) {
            $extension = explode('/', $_FILES['rooms_image']['type'][$i]);
            $name = time() * rand(1, 10) .  '.' . (count($extension) > 1 ? $extension[1] : '.png');
            $rooms[$i - 1]['image'] = $name;
            move_uploaded_file($_FILES['rooms_image']['tmp_name'][$i], public_path('/uploads/rooms') . '/' . $name);
        }
        $rooms = json_encode($rooms);
        Hotel::create([
            'name' => $request->name,
            'country' => $request->country,
            'city' => $request->city,
            'rooms' => $rooms,
        ]);
        return redirect(route('hotel.showAll'))->with('success', __('view.hotelCreated', ['hotel' => $request->name]));
    }

    public function edit($hotelId)
    {
        $hotel = Hotel::where('deleted_at', null)->where('id', $hotelId)->first();
        if (!$hotel) {
            return redirect()->back()->with('error', __('view.wrong'));
        }
        $countries = Country::all();
        $cities = City::where('country_code', $hotel->country)->get();
        return view('hotels/edit', compact('hotel', 'countries', 'cities'));
    }

    public function update(HotelRequest $request)
    {
        $hotel = Hotel::where('deleted_at', null)->where('id', $request->id);
        if (!$hotel->first()) {
            return redirect()->back()->with('error', __('view.wrong'));
        }
        $rooms = json_decode($request->rooms, true);
        $old_rooms = json_decode($hotel->first()->rooms, true);
        for ($i = 1; $i < count($_FILES['rooms_image']['size']); $i++) {
            if ($_FILES['rooms_image']['size'][$i]) {
                $name = time() * rand(1, 10) .  '.' . explode('/', $_FILES['rooms_image']['type'][$i])[1];
                $rooms[$i - 1]['image'] = $name;
                move_uploaded_file($_FILES['rooms_image']['tmp_name'][$i], public_path('/uploads/rooms') . '/' . $name);
            } else if ($old_rooms[$i - 1]['image'] ?? null) {
                $name = $old_rooms[$i - 1]['image'];
                $rooms[$i - 1]['image'] = $name;
            }
        }
        $rooms = json_encode($rooms);

        $hotel->update([
            'name' => $request->name ?? $hotel->first()->name,
            'country' => $request->country ?? $hotel->first()->country,
            'city' => $request->city ?? $hotel->first()->city,
            'rooms' => $rooms ?? $hotel->first()->rooms,
        ]);
        return redirect()->back()->with('success', __('view.hotelUpdated'));
    }

    public function delete($hotelId)
    {
        $hotel = Hotel::where('id', $hotelId);
        if (!$hotel) {
            return redirect()->back()->with('error', __('view.wrong'));
        }
        $hotel->update(['deleted_at' => now()]);
        return redirect(route('hotel.showAll'))->with('success', __('view.hotelDeleted'));
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
            $hotels = Hotel::where(function($query) use ($countryCode){
                     $query->where('deleted_at', null);
                     $query->where('country', 'like', '%' . $countryCode != "" ? $countryCode : "1322" . '%');
                })
                ->orWhere(function($query) use ($cityId){
                     $query->where('deleted_at', null);
                     $query->where('city', 'like', '%' . $cityId != "" ? $cityId : "dummy" . '%');
                })
                ->orWhere(function($query) use ($data){
                     $query->where('deleted_at', null);
                     $query->where('name', 'like', '%' . $data . '%');
                })
                ->paginate($pagination, ['*'], 'page', $request->page ?? 1);
        }
        // Representing the Country Name and City Name for Each Hotel
        foreach ($hotels as $hotel) {
            $hotel->countryName = Country::where('code', $hotel->country)->first()->name ?? '';
            $hotel->city = City::where('id', $hotel->city)->first()->name ?? '';
            $hotel->rooms = count(json_decode($hotel->rooms, TRUE));
        } 
        return view('hotels/show', compact('hotels', 'pagination', 'data'));
    }
}