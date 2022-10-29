<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CitiesController extends Controller
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
    public function getCities(Request $request)
    {
        $cities = City::where('country_code', $request->countryCode)->orderBy('name', 'ASC')->get();
        return response()->json([
            'cities' => $cities
        ]);
    }
}
