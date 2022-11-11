<?php

namespace App\Http\Controllers;

use App\Http\Requests\ActivityRequest;
use App\Models\Activity;
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
        return view('activities/show', compact('activities'));
    }

    public function add()
    {
        return view('activities/add');
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

        return view('activities/edit', compact('activity'));
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

            $activities = Activity::where('flight_id', $request->data)
                ->paginate($pagination, ['*'], 'page', $request->page ?? 1);
        }
        return view('activities/show', compact('activities', 'data', 'pagination'));
    }
}
