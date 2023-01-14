<?php

namespace App\Http\Controllers;

use App\Http\Requests\ActivityRequest;
use App\Models\Activity;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Notifications\Action;

class ActivitiesController extends Controller
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
        $activities = Activity::where('deleted_at', null)->paginate($pagination);
        
        foreach ($activities as $activity) {
            $activity->countryName = Country::where('code', $activity->country)->first()->name ?? '';
        } 
        
        return view('activities/show', compact('activities'));
    }

    public function add()
    {
        $countries = Country::all();
        return view('activities/add', compact('countries'));
    }

    public function store(ActivityRequest $request)
    {
        $imageName = '';
        if ($request->file('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/activities'), $imageName);
        }
        Activity::create([
            'name' => $request->name,
            'country' => $request->country,
            'image' => $imageName,
        ]);
        return redirect(route('activity.showAll'))->with('success', __('view.activityCreated'));
    }

    public function edit($activityId)
    {
        $activity = Activity::where('deleted_at', null)->where('id', $activityId)->first();
        if (!$activity) {
            return redirect()->back()->with('error', __('view.wrong'));
        }

        $countries = Country::all();
        return view('activities/edit', compact('activity', 'countries'));
    }

    public function update(ActivityRequest $request)
    {
        $activity = Activity::where('deleted_at', null)->where('id', $request->id);
        if (!$activity->first()) {
            return redirect()->back()->with('error', __('view.wrong'));
        }
        $imageName = '';
        if ($request->file('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/activities'), $imageName);
        }
        $activity->update([
            'name' => $request->name ?? $activity->first()->name,
            'country' => $request->country ?? $activity->first()->country,
            'image' => ($imageName != '' ?  $imageName : $activity->first()->image),
        ]);
        return redirect()->back()->with('success', __('view.activityUpdated'));
    }

    public function delete($activityId)
    {
        $activity = Activity::where('id', $activityId);
        if (!$activity) {
            return redirect()->back()->with('error', __('view.wrong'));
        }
        $activity->update(['deleted_at' => now()]);
        return redirect(route('activity.showAll'))->with('success', __('view.activityDeleted'));
    }

    public function filter(Request $request)
    {
        $pagination = $request->pagination ?? PAGINATION;
        if (!$request->data) { // if There is no searching data return all hotels
            $activities = Activity::where('deleted_at', null)->paginate($pagination, ['*'], 'page', $request->page ?? 1);
            $data = '';
        } else {
            $data = $request->data;
            $countryCode = '';
            
            

            // Get Country Code From its Name
            $country = Country::where('name', 'like', '%' . $data . '%')->first();
            if ($country) $countryCode = $country->code;

            $activities = Activity::where(function($query) use ($data){
                     $query->where('deleted_at', null);
                     $query->where('name', 'like', '%' . $data . '%');
                })
                ->orWhere(function($query) use ($data, $countryCode){
                     $query->where('deleted_at', null);
                     $query->where('country', 'like', '%' . ($countryCode != "" ? $countryCode : "1322").'%');
                })
                ->paginate($pagination, ['*'], 'page', $request->page ?? 1);
        }
        
         foreach ($activities as $activity) {
            $activity->countryName = Country::where('code', $activity->country)->first()->name ?? '';
        } 
        // return $activities;
        return view('activities/show', compact('activities', 'data', 'pagination'));
    }
}
