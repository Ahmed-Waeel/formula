<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Traits\CanUploadImage;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class SettingController extends Controller
{
    use CanUploadImage;

    public function index()
    {
        $lang = LaravelLocalization::getCurrentLocale();
        $settings = Setting::all(['key', 'value']);

        $en_hotels = $en_international_flights = $en_internal_flights = $en_transportations = $en_activities = [];
        $ar_hotels = $ar_international_flights = $ar_internal_flights = $ar_transportations = $ar_activities = [];

        $website_url = $linkedin = $facebook = $instagram = $snapchat = $twitter = [];

        $ar_logo = $en_logo = [];
        $ar_title = $en_title = [];
        $ar_notes = $en_notes = [];
        $ar_deposite = $en_deposite = [];
        $ar_price = $en_price = [];
        foreach ($settings as $record) {
            if (strpos($record->key, 'en_') === 0) {
                if (strpos($record->key, 'hotels')) $en_hotels[] = $record;
                if (strpos($record->key, 'international_flights')) $en_international_flights[] = $record;
                if (strpos($record->key, 'internal_flights')) $en_internal_flights[] = $record;
                if (strpos($record->key, 'transportations')) $en_transportations[] = $record;
                if (strpos($record->key, 'activities')) $en_activities[] = $record;

                if (strpos($record->key, 'title')) $en_title = $record;
                if (strpos($record->key, 'notes')) $en_notes = $record;
                if (strpos($record->key, 'price')) $en_price = $record;
                if (strpos($record->key, 'deposite')) $en_deposite = $record;
            }
            if (strpos($record->key, 'ar_') === 0) {
                if (strpos($record->key, 'hotels')) $ar_hotels[] = $record;
                if (strpos($record->key, 'international_flights')) $ar_international_flights[] = $record;
                if (strpos($record->key, 'internal_flights')) $ar_internal_flights[] = $record;
                if (strpos($record->key, 'transportations')) $ar_transportations[] = $record;
                if (strpos($record->key, 'activities')) $ar_activities[] = $record;

                if (strpos($record->key, 'title')) $ar_title = $record;
                if (strpos($record->key, 'notes')) $ar_notes = $record;
                if (strpos($record->key, 'price')) $ar_price = $record;
                if (strpos($record->key, 'deposite')) $ar_deposite = $record;
            }

            if (strpos($record->key, 'ar_logo')) $ar_logo = $record;
            if (strpos($record->key, 'en_logo')) $en_logo = $record;


            if (strpos($record->key, 'website_url')) $website_url = $record;
            if (strpos($record->key, 'linkedin')) $linkedin = $record;
            if (strpos($record->key, 'facebook')) $facebook = $record;
            if (strpos($record->key, 'instagram')) $instagram = $record;
            if (strpos($record->key, 'snapchat')) $snapchat = $record;
            if (strpos($record->key, 'twitter')) $twitter = $record;
        }

        // return [
        //     // $settings
        //     'en_hotels' => $en_hotels,
        //     'en_international_flights' => $en_international_flights,
        //     'en_internal_flights' => $en_internal_flights,
        //     'en_transportations' => $en_transportations,
        //     'en_activities' => $en_activities,

        //     'ar_hotels' => $ar_hotels,
        //     'ar_international_flights' => $ar_international_flights,
        //     'ar_internal_flights' => $ar_internal_flights,
        //     'ar_transportations' => $ar_transportations,
        //     'ar_activities' => $ar_activities,

        //     'ar_logo' => $ar_logo,
        //     'en_logo' => $en_logo,

        //     'ar_title' => $ar_title,
        //     'en_title' => $en_title,

        //     'ar_notes' => $ar_notes,
        //     'en_notes' => $en_notes,

        //     'ar_deposite' => $ar_deposite,
        //     'en_deposite' => $en_deposite,

        //     'ar_price' => $ar_price,
        //     'en_price' => $en_price,

        //     'website_url' => $website_url,
        //     'linkedin' => $linkedin,
        //     'facebook' => $facebook,
        //     'instagram' => $instagram,
        //     'snapchat' => $snapchat,
        //     'twitter' => $twitter
        // ];
        return view('settings', compact(
            'lang',
            'en_hotels',
            'ar_hotels',

            'en_international_flights',
            'ar_international_flights',

            'en_internal_flights',
            'ar_internal_flights',

            'en_transportations',
            'ar_transportations',

            'en_activities',
            'ar_activities',

            'ar_logo',
            'en_logo',

            'ar_title',
            'en_title',

            'ar_notes',
            'en_notes',

            'ar_deposite',
            'en_deposite',

            'ar_price',
            'en_price',

            'website_url',
            'linkedin',
            'facebook',
            'instagram',
            'snapchat',
            'twitter'
        ));
    }

    public function update(Request $request)
    {
        foreach ($request->all() as $key => $value) {
            if ($request->hasFile($key)) {
                $path = $this->uploadImage($request, $key, public_path('pdf'));
                Setting::where('key', $key)->update(['value' => $path]);
            } else {
                Setting::where('key', $key)->update(['value' => trim($value)]);
            }
        }

        return redirect()->back()->with('success',  __('view.settingsSaved'));
    }
}
